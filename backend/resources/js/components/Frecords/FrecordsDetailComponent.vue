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
            <p>魚種:{{ frecord.fish_name}}</p>
            <p>釣った数:{{ frecord.fish_amount }}</p>
          </div>
          <div class="col-md-auto">
            <label>ひとこと</label>
            <p>{{ frecord.content }}</p>
          </div>
        </div>
        <!--コメント-->
        <hr>
        <h2>コメント</h2>
        <div class="" v-for="(comment, index) in comments" :key="index">
          <div class="row pt-2 ">
            <div class="col-md-auto">
              <img v-if="comment.profile_image_name" class="media-object" width="50px" height="50px" :src="'/storage/profile_image/'+comment.profile_image_name">
              <img v-if="!comment.profile_image_name" class="media-object" width="50px" height="50px" :src="'/storage/default_profile.jpg'">
            </div>
            <div class="col col-md-auto">
              <p v-if="comment.name">ユーザー名:{{ comment.name }}</p>
              <p v-if="!comment.name">ユーザー名: 匿名さん</p>
            </div>
          </div>
          <div class="row pt-2 ">
            <div class="col-md-auto">
              {{ comment.comment_text }}
            </div>
          </div>
          <hr>
        </div>

        <!-- コメント投稿 -->
        <div class="mt-3 border p-3">
          <form @submit.prevent="preparateForm">
            <p>コメントを書く:</p>
            <textarea v-model="comment.text" placeholder="" style="resize:none;width:100%;height:100px;"></textarea>
            <p v-if="errors.length" class="text-danger">        
              {{errors[0]}}
            </p>
            <button type="submit" class="btn btn-primary">送信</button>
          </form>
        </div>

      </div>


    </div>
  </div>
</template>

<script>
  export default {
    props: {
      frecordId: Number
    },
    data: function(){
      return {
        errors: [],
        frecord: {},
        comment: {},
        comments: []
      }
    },
    methods: {
      getFrecord(){
        axios.get('/api/frecord/'+this.frecordId)
          .then((res) => {
            this.frecord = res.data;
            this.comment.frecord_id = this.frecordId;
          });
        axios.get('/api/comment/'+this.frecordId)
          .then((res) => {
            this.comments = res.data;
          });
      },
      submitComment(){
        axios.post('/api/comment/post',this.comment)
        .then((res) => {
          location.reload();
        });
      },
      getUser(){
        axios.get('/api/current_user')
        .then((res) => {
          this.comment.user_id = res.data.id;
        });
      },
      preparateForm(){
        this.errors = [];
        if(!this.comment.user_id){
          this.errors.push('コメントを書く場合はログインしてください。');
        }else{
          if(this.comment.text)
            this.submitComment();

          if(!this.comment.text)
            this.errors.push('テキストを何も書かずにコメントすることはできません。')
        }
      }
    },
    mounted() {
      this.getFrecord();
      this.getUser();

    }
  }
</script>