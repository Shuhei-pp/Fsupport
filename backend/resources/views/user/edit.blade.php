@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">ユーザー編集 {{ $user[0]->email }}</div>
      <div class="card-body">
        <form method="POST" action="#">
        @csrf

          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">権限</label>
            <div class="col-md-6">
              <select name="area_id" class="form-control" >
                <?php foreach($admins as $admin) { ?>
                  <?php if($user[0]->admin == $admin->id) { ?>
                    <option value="{{ $user_id }}" selected="selected">{{ $admin->rank }}</option>
                  <?php }else { ?>
                    <option value="{{ $user_id }}">{{ $admin->rank }}</option>
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