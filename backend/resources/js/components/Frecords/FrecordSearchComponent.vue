<template>
  <div class="container">

    <div class="p-3">
      <h2>釣果絞り込みページ</h2>
      <div class="p-2 bg-white border rounded">
        <div class="row">
          <div class="col-md-auto">
            <p>魚種で絞り込み</p>
            <div class="" v-for="fish in fishes" :key="fish.id">
              <input type="checkbox" class="">{{ fish.fish_name }}
            </div>
          </div>

          <div class="col-md-auto">
            <p>エリアで絞り込み</p>
            <div class="" v-for="area in areas" :key="area.id">
              <input type="checkbox" class="">{{ area.area_name }}
            </div>
          </div>
        </div>
        <div class="row">
          <input type="radio" name="period" checked>1週間以内
          <input type="radio" name="period">2週間以内
          <input type="radio" name="period">3週間以内
          <input type="radio" name="period">全ての期間
        </div>
        </div>
    </div>

    <div class="card">
      <div class="card-header">
        釣果検索結果
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-auto">
            <img class="media-object" width="150px" src="'/storage/result_images/'+frecord.image_name">
          </div>
          <div class="col-md-auto">
            <p>エリア:</p>
            <p>日時:</p>
          </div>
          <div class="col-md-auto">
            <label>ひとこと</label>
            <p>frecord.content</p>
          </div>
          <div class="col-md-auto">
            <p>魚種:frecord.fish_name }}</p>
          </div>
          <div class="col-md-auto">
            <p>釣った数:frecord.fish_amount }}</p>
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
        fishes: [],
        areas: []
      }
    },
    methods: {
      getOptions(){
        axios.get('/api/search/option')
          .then((res) => {
            this.fishes = res.data.fish;
            this.areas = res.data.areas;
          });
      }
    },
    mounted() {
      this.getOptions();
    }
  }
</script>