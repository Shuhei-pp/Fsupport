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
              <th>FI(Max:100)</th>
              <td v-for="fi in info.fi">{{ fi }}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="container">

      <div class="form-check">
        <input class="form-check-input" @click="changeGraph" type="checkbox" id="check_wind">
        <label class="form-check-label">
          風速
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" @click="changeGraph" type="checkbox" id="check_temp">
        <label class="form-check-label">
          気温
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" @click="changeGraph" type="checkbox" id="check_tide">
        <label class="form-check-label">
          潮の高さ
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" @click="changeGraph" type="checkbox" id="check_fi" checked>
        <label class="form-check-label">
          FI
        </label>
      </div>

      <div class="py-3">
        <canvas id="chart" class=""></canvas>
      </div>
    </div>

    <div class="container">
      <div class="card">
        <div class="card-header">釣果登録</div>

        <div class="card-body">
          <p>マイページで釣果を登録することができます。</p>
          <!--<a :href="route('gotomypage')"> 本番用 -->
          <a href="/user/gotomypage">
            <button class ="btn btn-primary">マイページへ</button>
          </a>
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
        chartdata: [],

      }
    },
    methods: {
      changeGraph() {
        this.chartdata = [];
        if(document.getElementById("check_wind").checked){
          this.chartdata.push(
            {
              label: '風速',
              backgroundColor: 'rgba(0, 0, 0, 0)',
              borderColor: 'rgb(255, 99, 0)',
              data: this.info.wind
            }
          ); 
        }
        if(document.getElementById("check_temp").checked){
          this.chartdata.push(
            {
              label: '気温',
              backgroundColor: 'rgba(0, 0, 0, 0)',
              borderColor: 'rgb(100, 230, 132)',
              data: this.info.temp
            }
          ); 
        }
        if(document.getElementById("check_tide").checked){
          this.chartdata.push(
            {
              label: '潮の高さ',
              backgroundColor: 'rgba(0, 0, 0, 0)',
              borderColor: 'rgb(0, 99, 132)',
              data: this.info.tide
            }
          ); 
        }
        if(document.getElementById("check_fi").checked){
          this.chartdata.push(
            {
              label: 'FI',
              backgroundColor: 'rgba(0, 0, 0, 0)',
              borderColor: 'rgb(255, 99, 132)',
              data: this.info.fi
            }
          ); 
        }
        
        this.getChart();
      },
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
          this.chartdata.push({
            label: 'FI(釣果指数)',
            backgroundColor: 'rgba(255, 99, 132,0)',
            borderColor: 'rgb(255, 99, 132)',
            data: this.info.fi
          });
          this.getChart();
        });
      },
      //グラフ作成
      getChart(){
        const labels = this.info.times;
        var data = {
          labels: labels,
          datasets: this.chartdata
        };
        var config = {
          type: 'line',
          data: data,
          options: {}
        };
        var chart = new Chart(
          document.getElementById('chart'),
          config
        );
      },
    },
    mounted() {
      this.getArea();
    }
  }
</script>