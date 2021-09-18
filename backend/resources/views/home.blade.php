@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-6 mx-auto">
    <?php foreach($bigareas as $bigarea) { ?>
      <h5>{{ $bigarea->bigarea_name }}</h5>
      <ul class="list-unstyled">
        <?php foreach($areas as $area) { ?>
          <?php if($bigarea->bigarea_id == $area->bigarea_id) { ?>
            <li><a href="/area/{{ $area->id }}">{{ $area->area_name }}</a></li>
          <?php } ?>
        <?php } ?>
      </ul>
    <?php } ?>

    <?php if (Auth::check() && Auth::user()->admin){ ?>{{--管理者かどうか--}}
      <a href="home/edit"><button class="btn btn-primary">エリア追加を行う</button></a>
    <?php } ?>
  </div>
</div>

@endsection