<template>
  <div class="container">

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
  export default {}
</script>