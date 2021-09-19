@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                      <div class="card-header">エラーページ</div>
                      <div class="card-body">
                        <p>管理者用ページです。</p>
                        <p>管理者であればログインを行ってください。</p>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 offset-md-4">
                              <a href="/">
                                  <button class="btn btn-primary">ホームへ</button>
                              </a>
                          </div>
                      </div>  
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection