<template>
  <div>
    <div class="container">
      <h3>{{ areaname }}エリア</h3><!--
      <div class="table-responsive">
        <table class="table table-bordered">
          <caption>このエリアの天気</caption>
          <thead class="table-dark">
            <tr>
              <th>日付</th>-->
                <th v-for="(time, index) in times" :key="index">{{ time }}</th>
              <!--
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>天気</th>
              <?php for($i=0;$i<8;$i++) {?>
                <td>{{ $info->weather[$i] }}</td>
              <?php } ?>
            </tr>
            <tr>
              <th>気温(°c)</th>
              <?php for($i=0;$i<8;$i++) {?>
                <td>{{ $info->temp[$i] }}</td>
              <?php }?>
            </tr>
            <tr>
              <th>風速(m/s)</th>
              <?php for($i=0;$i<8;$i++) {?>
                <td>{{ $info->wind[$i] }}</td>
              <?php }?>
            </tr>
            <tr>
              <th>空における雲の割合(%)</th>
              <?php foreach($info->clouds as $cloud) {?>
                <td>{{ $cloud }}</td>
              <?php }?>
            </tr>
            <tr>
            <tr>
              <th>潮の高さ(cm)</th>
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
      </div>-->
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
        times: []
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
          this.times = res.info.times;
        });
      }
    },
    mounted() {
      this.getArea();
    }
  }
</script>