<template>
  <div>
    <div class="container">
      <h3>{{ areaname }}エリア</h3>
      <div class="table-responsive">
        <table class="table table-bordered">
          <caption>このエリアの天気</caption>
          <thead class="table-dark">
            <tr>
              <th>日付</th>
              <th v-for="time in info.times">{{ time }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>天気</th>
              <td v-for="weather in info.weather">{{ weather }}</td>
            </tr>
            <tr>
              <th>気温(°c)</th>
              <td v-for="temp in info.temp">{{ temp }}</td>
            </tr>
            <tr>
              <th>風速(m/s)</th>
              <td v-for="wind in info.wind">{{ wind }}</td>
            </tr>
            <tr>
              <th>空における雲の割合(%)</th>
              <td v-for="cloud in info.clouds">{{ cloud }}</td>
            </tr>
            <tr>
            <tr>
              <th>潮の高さ(cm)</th>
              <td v-for="tide in info.tide">{{ tide }}</td>
            </tr>
            <tr>
              <th>FI</th>
              <td v-for="fi in info.fi">{{ fi }}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
<!--
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
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                  </span>
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">写真</label>

              <div class="col-md-6">
                <input class="form-control-file" name="picture" type="file">

                <?php if ($errors->has('picture')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('picture') }}</strong>
                  </span>
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣った時間</label>

              <div class="col-md-6">
                <input class="form-control" name="date" type="date">

                @if ($errors->has('date'))
                  <div class="text-danger" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                  </div>
                @endif

                <input class="form-control mt-3" name="time" type="time">

                <?php if ($errors->has('time')) {?>
                  <span class="text-danger" role="alert">
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
    </div>-->

  </div>
</template>

<script>
  export default {
    props: {
      areaId: String
    },
    data: function () {
      return {
        areaname: null,
        times: [],
        weathers: [],
        info: {}      

      }
    },
    methods: {
      getArea() {
        $.ajax({
          type: 'get',
          url: '/api/area/'+ this.areaId,
          datatype: 'json'
        })
        .then((res) =>{
          this.areaname = res.area_name;
          this.info = res.info
        });
      }
    },
    mounted() {
      this.getArea();
    }
  }
</script>