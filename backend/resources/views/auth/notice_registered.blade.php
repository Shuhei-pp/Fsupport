

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($message)
                        <div class="card-header">登録失敗のお知らせ</div>
                        <div class="card-body">
                            {{$message}}
                        </div>
                    @endisset
                    @empty($message)
                        <div class="card-header">登録完了のお知らせ</div>
                        <div class="card-body">
                            <p>登録が完了しました！</p>
                            <p>引き続きFiをご利用ください。</p>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <a href="/">
                                    <button class="btn btn-primary">ホームへ</button>
                                </a>
                            </div>
                        </div>  
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection