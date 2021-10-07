@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
      <div class="card-header">魚追加</div>
          <div class="card-body">
              <form method="POST" action="{{ route('fish.create') }}">
                  @csrf

                  <div class="form-group row">
                      <label class="col-md-4 col-form-label text-md-right">魚名</label>

                      <div class="col-md-6">
                          <input class="form-control" name="fish_name">

                          <?php if ($errors->has('fish_name')) {?>
                              <span class="text-danger">
                                  <strong>{{ $errors->first('fish_name') }}</strong>
                              </span>
                          <?php }?>
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                      作成者:{{ Auth::user()->email }}
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              追加
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
</div>

@endsection