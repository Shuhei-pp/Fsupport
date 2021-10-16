<template>
  <div class="container">

    <div class="p-3">
      <h2>釣果絞り込みページ</h2>
      <form class="p-2 bg-white border rounded" name="search_form">
        <div class="row">
          <div class="col-md-auto p-3">
            <h4>魚種で絞り込み</h4>
            <div class="py-1" v-for="fish in fishes" :key="fish.id">
              <input type="checkbox" class="" v-bind:value="fish.fish_id" name="fish">{{ fish.fish_name }}
            </div>
          </div>

          <div class="col-md-auto p-3">
            <h4>エリアで絞り込み</h4>
            <div class="py-1" v-for="area in areas" :key="area.id">
              <input type="checkbox" class="" v-bind:value="area.id" name="area">{{ area.area_name }}
            </div>
          </div>
        </div>
        <div class="row p-2">
          <div class="col-md-auto">
            <input type="radio" name="period" value="1" checked>1週間以内
          </div>
          <div class="col-md-auto">
            <input type="radio" name="period" value="2">2週間以内
          </div>
          <div class="col-md-auto">
            <input type="radio" name="period" value="3">3週間以内
          </div>
          <div class="col-md-auto">
            <input type="radio" name="period" value="0">全ての期間
          </div>
        </div>
        <button type="button" class="btn btn-primary" v-on:click="searchFrecords">検索</button>
      </form>
    </div>

    <div class="card" id="search-result">
      <div class="card-header">
        釣果検索結果
      </div>
      <div class="card-body">
        <p>検索結果:{{ frecords.length }}件</p>
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
</template>

<script>
  export default {
    data: function() {
      return {
        fishes: [],
        areas: [],
        frecords: []
      }
    },
    methods: {
      getOptions(){
        axios.get('/api/search/option')
          .then((res) => {
            this.fishes = res.data.fish;
            this.areas = res.data.areas;
          });
      },
      searchFrecords(){
        var search_fish_ids = [];
        var search_area_ids = [];
        var occasion_number = 0;

        document.getElementById('search-result').style.display = 'block';

        //チェックボックス,ラジオボタンの状態を取得
        for(var i = 0; i < this.fishes.length; i++)
          if(document.search_form.fish[i].checked)
            search_fish_ids.push(document.search_form.fish[i].value);

        for(var i = 0; i < this.areas.length; i++)
          if(document.search_form.area[i].checked)
            search_area_ids.push(document.search_form.area[i].value);

        //idsに何も入っていないとエラーになるので0を入れておく
        if(search_fish_ids)
          search_fish_ids.push(0);

        if(search_area_ids)
          search_area_ids.push(0);

        occasion_number = document.search_form.period.value;

        axios.get('/api/search/frecords',{
          params: {
            fish_id: search_fish_ids,
            area_id: search_area_ids,
            occasion_number: document.search_form.period.value
          } 
        })
          .then((res) => {
            this.frecords = res.data;
          });
      }
    },
    mounted() {
      this.getOptions();
    }
  }
</script>