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
          <?php foreach($posts as $post) {?>
            <div class="media">
              <div class="media-left" href="#">
                <img class="media-object" src="{{ asset('storage/result_images/'.$post->image_name) }}">
              </div>
              <div class="media-body">
                <div class="container">
                  <p>釣果:{{ $post->content }}</p>
                  <p>エリア:{{ $areas[$post->area_id]->area_name}}</p>
                  <p>日時:{{ $post->time}}</p>
                </div>
              </div>
            </div>
            <hr />
          <?php } ?>  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection