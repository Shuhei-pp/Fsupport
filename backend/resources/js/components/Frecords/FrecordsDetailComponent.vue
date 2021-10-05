<template>
  <div class="container">
    <div class="media-left">
      <img class="media-object" width="150px" :src="'/storage/result_images/'+frecord[0].image_name">
    </div>
    <div class="media-body">
      <div class="container">
        <p>エリア: {{ frecord[0].area_name }}</p>
        <p>日時: {{ frecord[0].datetime }}</p>
        <p>ユーザー名: 匿名さん</p>
        <hr>
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
        frecord: [],
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