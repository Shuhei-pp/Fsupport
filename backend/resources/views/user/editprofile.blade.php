@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        プロフィール編集
      </div>
      <div class="card-body">
        <form method="POST" action="{{-- route('')--}}" enctype="multipart/form-data">
          @csrf

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">ニックネーム</label>
            <div class="col-md-6">
              <input class="form-control" name='name'>
              <?php if($errors->has('name')) {?>
                <span class="text-danger" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">ひとこと</label>
            <div class="col-md-6">
              <input class="form-control" name='text'>
              <?php if($errors->has('text')) {?>
                <span class="text-danger" role="alert">
                  <strong>{{ $errors->first('text') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">写真</label>

            <div class="col-md-6">
              <input class="form-control-file" name="picture" type="file">
              <?php if ($errors->has('picture')) {?>
                <span class="text-danger" role="alert">
                  <strong>{{ $errors->first('picture') }}</strong>
                </span>
              <?php } ?>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
@endsection