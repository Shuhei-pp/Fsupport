<template>

  <div>
    <div class="container">
      <div class="card">
        <div class="card-header">Fsupportとは</div>
        <div class="card-body">
          <p>Fsupportとは釣り人を環境、釣果の2つの面からの情報でサポートしていくというアプリケーションです。</p>
          <p>エリアページでは多くの釣りに関する環境を指数化したFI(Fishing Index)、</p>
          <p>釣果検索ページでは、これまでの釣れた魚の種類を見ることができ、コメントで詳しい釣り方を聞くこともできます。</p>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <router-link v-bind:to="{name: 'frecord.search'}">
        <button class="btn btn-primary" style="width:100%">釣果検索ページへ</button>
      </router-link>
    </div>

    <div class="container mt-5">
      <h3 class="mb-2">エリア一覧</h3>
      <table class="mx-auto table table-info">
        <thead>
          <tr>
            <th scope="col">都道府県</th>
            <th scope="col">エリア名</th>
          </tr>
        </thead>
        <tbody v-for="(bigarea, index) in bigareas" :key="index">
          <tr v-for="(area, index) in areas" :key="index">
            <th scope="row" v-if="area.bigarea_id == bigarea.bigarea_id">{{ bigarea.bigarea_name }}</th>

            <td v-if="area.bigarea_id == bigarea.bigarea_id">
              <router-link v-bind:to="{name: 'area.show', params: {areaId: area.id}}">
                {{ area.area_name }}
              </router-link>
            </td>

          </tr>
        </tbody>
      </table>
      <a href="/area/new/edit"><button class="btn btn-primary">エリア追加を行う</button></a>
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
                  <label>ひとこと</label>
                  <p>{{ frecord.content }}</p>
                </div>
                <div class="col-md-auto">
                  <p>魚種:{{ frecord.fish_name }}</p>
                </div>
                <div class="col-md-auto">
                  <p>釣った数:{{ frecord.fish_amount }}</p>
                </div>
              </div>
            </router-link>
            <div class="row pt-2 ">
              <div class="col-md-auto">
                <img v-if="frecord.profile_image_name" class="media-object" width="50px" height="50px" :src="'/storage/profile_image/'+frecord.profile_image_name">
                <img v-if="!frecord.profile_image_name" class="media-object" width="50px" height="50px" :src="'/storage/default_profile.jpg'">
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
