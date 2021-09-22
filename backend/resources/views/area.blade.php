@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <caption>このエリアの天気</caption>
        <thead class="table-dark">
          <tr>
            <th>data</th>
            <?php for($i=0;$i<8;$i++) {?>
              <th>{{ $info->times[$i] }}</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>weather</th>
            <?php for($i=0;$i<8;$i++) {?>
              <td>{{ $info->weather[$i] }}</td>
            <?php } ?>
          </tr>
          <tr>
            <th>temp</th>
            <?php for($i=0;$i<8;$i++) {?>
              <td>{{ $info->temp[$i] }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>tide</th>
            <?php foreach($info->tide as $tide) {?>
              <td>{{ $tide }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>FI</th>
            <?php foreach($info->fi as $fi) {?>
              <td>{{ $fi }}</td>
            <?php }?>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="container">
    <div class="py-3">
      <canvas id="chart" class=""></canvas>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <div class="card-header">釣果登録</div>

      <div class="card-body">
        <form method="POST" action="{{ route('create.fresult') }}" enctype="multipart/form-data">
            @csrf

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">釣果内容</label>

            <div class="col-md-6">
              <input class="form-control" name="content">

              <?php if($errors->has('content')) {?>
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('content') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">写真</label>

            <div class="col-md-6">
              <input class="form-control-file" name="picture" type="file">

              <?php if ($errors->has('result_picture')) {?>
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('picture') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">釣った時間</label>

            <div class="col-md-6">
              <input class="form-control" name="time" type="datetime-local">

              <?php if ($errors->has('time')) {?>
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('time') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">釣ったエリア</label>
            <div class="col-md-6">
              <select name="area_id" class="form-control" >
                <?php foreach($areas as $area) { ?>
                  <?php if($area->id == $area_id) { ?>
                    <option value="{{ $area->id }}" selected="selected">{{ $area->area_name }}</option>
                  <?php }else { ?>
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                  <?php } ?>

                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary">
                追加
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.onload = function(){
      const labels = @json($info->times);
      const data = {
        labels: labels,
        datasets: [{
          label: 'Fi(釣果指数)',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: @json($info->fi),
        }]
      };
      const config = {
      type: 'line',
      data: data,
      options: {}
      };
      var myChart = new Chart(
        document.getElementById('chart'),
        config
      );
    }
  </script>
@endsection
