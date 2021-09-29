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

    <div class="container">
      <div class="py-3">
        <canvas id="chart" class=""></canvas>
      </div>
    </div>

    <div class="container">
      <div class="card">
        <div class="card-header">釣果登録</div>

        <div class="card-body">
          <form v-on:submit.prevent="submit" enctype="multipart/form-data">

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">釣果内容</label>

              <div class="col-md-6">
                <input class="form-control" name="content" v-model="frecord.content">
<!--
                <?php if($errors->has('content')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                  </span>
                <?php } ?>-->
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">写真</label>

              <div class="col-md-6">
                <input class="form-control-file" name="picture" type="file" @change="onImageUploaded">
<!--
                <?php if ($errors->has('picture')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('picture') }}</strong>
                  </span>
                <?php } ?>-->
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣った時間</label>

              <div class="col-md-6">
                <input class="form-control" name="date" type="date" v-model="frecord.date">
<!--
                @if ($errors->has('date'))
                  <div class="text-danger" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                  </div>
                @endif
-->
                <input class="form-control mt-3" name="time" type="time" v-model="frecord.time">
<!--
                <?php if ($errors->has('time')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('time') }}</strong>
                  </span>
                <?php } ?>-->
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣ったエリア</label>
              <div class="col-md-6">
                <select name="area_id" class="form-control" v-model="frecord.area_id">
                  <option v-for="area in areas">
                    {{ area.area_name }}
                  </option>
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
        info: {},
        areas: [],
        //form送信用の空のfrecord
        frecord: {}
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
          this.info = res.info;
          this.areas = res.areas;
          this.getChart();
        });
      },
      //グラフ作成
      getChart(){
        const labels = this.info.times;
        const data = {
          labels: labels,
          datasets: [{
            label: 'FI(釣果指数)',
            backgroundColor: 'rgba(255, 99, 132,0)',
            borderColor: 'rgb(255, 99, 132)',
            data: this.info.fi
          }]
        };
        const config = {
          type: 'line',
          data: data,
          options: {}
        };
        var chart = new Chart(
          document.getElementById('chart'),
          config
        );
      },
      //form送信
      submit() {
        axios.post('/api/fresult/create', this.fresult)
          .then((res) => {
            this.$router.push({name: 'vue.home'});
          });
      },
      onImageUploaded(event) {
        //eventから画像データを取得
        const image = event.target.files[0];
        const reader = new FileReader;
        //imageをurlに
        reader.readAsDataURL(image);
        reader.onload = () => {
          this.frecord.image = reader.result;
        }
      }
    },
    mounted() {
      this.getArea();
    }
  }
</script>