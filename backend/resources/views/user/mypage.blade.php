@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="container">
      <div class="text-center"><h1>マイページ</h1></div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">釣果一覧</div>
        <div class="card-body">

          <!-- 釣果投稿がない場合 -->
          @if (count($posts)==0)
            <p>釣果がまだ登録されていません</p>
          @endif

          <?php foreach($posts as $post) {?>
            <div class="media">
              <div class="media-left" href="#">
                <img class="media-object" width="150px" src="{{ asset('storage/result_images/'.$post->image_name) }}">
              </div>
              <div class="media-body">
                <div class="container">
                  <p>釣果:{{ $post->content }}</p>
                  <p>エリア:{{ $post->area_name}}</p>
                  <p>日時:{{ $post->datetime}}</p>
                </div>
              </div>
            </div>
            <div class="container pt-1">
              <a href="{{ route('edit.fresult',['fresult_id' => $post->id]) }}">
                <button class="btn btn-success">釣果修正</button>
              </a>
              <button class="btn btn-danger delete_button" value="{{ $post->id }}">釣果削除</button>
              <a href="{{ route('delete.fresult',['fresult_id' => $post->id]) }}">
                <button id="{{ $post->id }}" style="display: none"></button> 
              </a>
            </div>
            <hr />
          <?php } ?>  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).on('click','.delete_button',function() {
    if(window.confirm("本当に削除しますか？")){
      $fresult_id = "#"+this.value;
      $($fresult_id).click();
    }
  });
</script>
@endsection