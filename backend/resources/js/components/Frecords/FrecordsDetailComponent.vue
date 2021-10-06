<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div v-if="frecord.name">{{ frecord.name }}さんの釣果</div>
        <div v-if="!frecord.name">匿名さんの釣果</div>
      </div>
      <div class="card-body">
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      frecordId: String
    },
    data: function(){
      return {
        frecord: {},
      }
    },
    methods: {
      getFrecord(){
        axios.get('/api/frecord/'+this.frecordId)
          .then((res) => {
            this.frecord = res.data;
            console.log(this.frecord);
          });
      }
    },
    mounted() {
      this.getFrecord();
    }
  }
</script>