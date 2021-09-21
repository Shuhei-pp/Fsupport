@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="text-center"><h1>マイページ</h1></div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">釣果一覧</div>
        <div class="card-body">
          <div class="media">
            <a class="media-left" href="#">
                <img class="media-object" src="{{ $posts[1]->image_name }}">
            </a>
            <div class="media-body">
                <h4 class="media-heading">商品1</h4>
                <p>{{ $posts[1]->content }}</p>
            </div>
          </div>
          <hr />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection