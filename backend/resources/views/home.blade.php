@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card">
    <div class="card-header">Fishing Indexとは</div>
    <div class="card-body">
      <p>Fishing Indexとは釣果指数のことで風速、潮の動き、日の出、日没等のデータをもとに”釣れる”を指数化したものです。</p>
      <p>管理人は北陸地方出身なのでこれからそこら辺を中心にエリアを広げていく予定です。</p>
      <p>FIは季節、日の出没、風速、潮の満干、空全体の雲の割合の5つから100点満点で計算を行っています。</div></p>
    </div>
  </div>
</div>

<div class="container pt-5">
  <div class="card">
    <div class="card-header">エリア一覧</div>
    <div class="card-body">
      <div class="col-6">

        <?php foreach($bigareas as $bigarea) { ?>
          <h5>{{ $bigarea->bigarea_name }}</h5>

          <ul class="list-unstyled">
            <?php foreach($areas as $area) { ?>
              <?php if($bigarea->bigarea_id == $area->bigarea_id) { ?>
                <li><a href={{ route('area.show', ['area_id' => $area->id]); }}>{{ $area->area_name }}</a></li>
              <?php } ?>
            <?php } ?>
          </ul>

        <?php } ?>

<<<<<<< HEAD
        <?php if (Auth::check() && Auth::user()->admin){ ?>{{--管理者かどうか--}}
          <a href={{ route('area_edit') }}><button class="btn btn-primary">エリア追加を行う</button></a>
        <?php } ?>
      </div>
    </div>
=======
    <?php if (Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER'))){ ?>{{--管理者かどうか--}}
      <a href={{ route('area_edit') }}><button class="btn btn-primary">エリア追加を行う</button></a>
    <?php } ?>
>>>>>>> b7e4900586e8f77ba5b36736596c6fb506eff4b4
  </div>
</div>

@endsection