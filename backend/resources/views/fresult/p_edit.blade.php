@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">釣果編集</div>

      <div class="card-body">
        <form method="POST" action="{{ route('edit.fresult',['fresult_id' => $fresult->id]) }}" enctype="multipart/form-data">
            @csrf
          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">釣果内容</label>

            <div class="col-md-6">
              <input class="form-control" name="content" value="{{ $fresult->content }}">

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
              <input class="form-control-file" name="picture" type="file" >

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
              <input class="form-control" name="time" type="datetime-local" value="{{ $fresult->time }}">

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
              <select name="area_id" class="form-control" >
                <?php foreach($areas as $area) { ?>
                  <?php if($area->id == $fresult->area_id) { ?>
                    <option value="{{ $area->id }}" selected="selected">{{ $area->area_name }}</option>
                  <?php }else { ?>
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                  <?php } ?>

                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary">
                編集完了
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection