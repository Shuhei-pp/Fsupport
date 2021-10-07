@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="container">
      <div class="text-center"><h1>マイページ</h1></div>
    </div>
    <div class="col-md-8">

      <div class="card mb-5">
        <div class="card-header">釣果登録</div>

        <div class="card-body">
          <form method="POST" enctype='multipart/form-data' action={{ route('create.fresult') }}>
          @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">釣果内容</label>

              <div class="col-md-6">
                <input class="form-control" name="content">
                <?php if($errors->has('content')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                  </span>
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">写真</label>

              <div class="col-md-6">
                <input class="form-control-file" name="picture" type="file" accept="image/jpeg, image/png, image/jpg">
                <?php if ($errors->has('picture')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('picture') }}</strong>
                  </span>
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣った時間</label>

              <div class="col-md-6">
                <input class="form-control" name="date" type="date">
                @if ($errors->has('date'))
                  <div class="text-danger" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                  </div>
                @endif
                <input class="form-control mt-3" name="time" type="time">
                <?php if ($errors->has('time')) {?>
                  <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('time') }}</strong>
                  </span>
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣ったエリア</label>
              <div class="col-md-6">
                <select name="area_id" class="form-control">
                  <?php foreach($areas as $area) {?>
                    <option value="{{ $area->id }}">
                      {{ $area->area_name }}
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">釣った魚</label>
              <div class="col-md-6">
                <select name="fish_id" class="form-control">
                  <?php foreach($fishes as $fish) {?>
                    <option value="{{ $fish->fish_id }}">
                      {{ $fish->fish_name }}
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">数量</label>
              <div class="col-md-6">
                <select name="fish_amount" class="form-control">
                  <?php for($i=1;$i<30;$i++) {?>
                    <option value="{{ $i }}">
                      {{ $i }}
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  追加
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card mb-5">
        <div class="card-header">
          マイプロフィール
        </div>
        <div class="card-body">
          <div class="media">
            <div class="media-left">
              <img class="media-object" width="150px" src="{{ asset('storage/profile_image/'.$user->profile_image_name) }}">
            </div>
            <div class="media-body">
              <div class="container">
                <p>ニックネーム:</p>
                @if($user->name)
                  <p>{{ $user->name }}</p>
                @else
                  <p>まだ設定されていません</p>
                @endif
                <p>ひとこと:</p>
                @if($user->profile_text)
                  <p>{{ $user->profile_text}}</p>
                @else
                  <p>一言はありません</p>
                @endif
              </div>
            </div>
          </div>
          <div class="media mt-3">
            <a href="{{ route('user.editprofile',['user_id' => Auth::id()])}}">
              <button class="btn btn-primary">プロフィール編集</button>
            </a>
          </div>
        </div>
      </div>

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