@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">エリア追加</div>
                <div class="card-body">
                    <form method="POST" action="/area/edit" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">エリア名</label>

                            <div class="col-md-6">
                                <input for="area_name" class="form-control" name="area_name">

                                <?php if ($errors->has('area_name')) {?>
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('area_name') }}</strong>
                                    </span>
                                <?php }?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">都道府県</label>

                            <div class="col-md-6">
                                <select name="prefecture" class="form-control">
                                  <?php foreach($bigareas as $bigarea) { ?>
                                    <option value="{{ $bigarea->bigarea_id }}">{{ $bigarea->bigarea_name }}</option>
                                  <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">港の住所</label>

                            <div class="col-md-6">
                                <input　class="form-control" name="area_zip" placeholder="999-9999">

                                @error('area_zip')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">港コード(tide736を参照)</label>

                            <div class="col-md-6">
                                <input　class="form-control" name="harbor_code">

                                @error('harbor_code')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
</div>
@endsection
