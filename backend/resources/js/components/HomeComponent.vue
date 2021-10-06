<template>

  <div>
    <div class="container">
      <div class="card">
        <div class="card-header">Fishing Indexとは</div>
        <div class="card-body">
          <p>Fishing Indexとは釣果指数のことで風速、潮の動き、日の出、日没等のデータをもとに”釣れる”を指数化したものです。</p>
          <p>管理人は北陸地方出身なのでこれからそこら辺を中心にエリアを広げていく予定です。</p>
          <p>FIは季節、日の出没、風速、潮の満干、空全体の雲の割合の5つから100点満点で計算を行っています。</p>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="col-6 mx-auto">
        <div v-for="(bigarea, index) in bigareas" :key="index">
          <h5>{{ bigarea.bigarea_name }}</h5>

          <ul class="list-unstyled" v-for="(area, index) in areas" :key="index">
            <li v-if="area.bigarea_id == bigarea.bigarea_id">
              <router-link v-bind:to="{name: 'area.show', params: {areaId: area.id}}">
              {{ area.area_name }}
              </router-link>
            </li>
          </ul>


        </div>
          <a href="/area/new/edit"><button class="btn btn-primary">エリア追加を行う</button></a>
      </div>
    </div>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          最近の釣果投稿
        </div>
        <div class="card-body">
          <div class="" v-for="(frecord, index) in frecords" :key="index">
            <router-link v-bind:to="{name: 'frecord.detail', params: {frecordId: frecord.frecord_id}}">
              <div class="row">
                <div class="col-md-auto">
                  <img class="media-object" width="150px" :src="'/storage/result_images/'+frecord.image_name">
                </div>
                <div class="col-md-auto">
                  <p>エリア:{{ frecord.area_name }}</p>
                  <p>日時:{{ frecord.datetime }}</p>
                </div>
                <div class="col-md-auto">
                  <label>コメント</label>
                  <p>{{ frecord.content }}</p>
                </div>
              </div>
            </router-link>
            <div class="row pt-2 ">
              <div class="col-md-auto">
                <img class="media-object" width="50px" height="50px" :src="'/storage/profile_image/'+frecord.profile_image_name">
              </div>
              <div class="col pt-2 col-md-auto">
                <p v-if="frecord.name">ユーザー名:{{ frecord.name }}</p>
                <p v-if="!frecord.name">ユーザー名: 匿名さん</p>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script>
  export default {  
    data: function() {
      return {
        bigareas: [],
        areas: [],
        frecords: []
      }
    },
    methods: {
      getAreas() {
        $.ajax({
          type: 'get',
          url: '/api',
          datetype: 'json'
        })
        .then((res) => {
          this.bigareas = res.bigareas;
          this.areas = res.areas;
        });
      },
      getFrecords() {
        axios.get('/api/home/frecord/list')
        .then((res) => {
          this.frecords = res.data;
        });
      }
    },
    mounted() {
      this.getAreas();
      this.getFrecords();
    }
  }
</script>
