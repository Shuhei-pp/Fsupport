@extends('layouts.app')

@section('content')

<div class="container">
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">ユーザー編集</div>

      <div class="table-responsive">
        <div class="card-body">
          <table class=table>
            <tbody>
              <thead>
                <th>
                  ユーザーID
                </th>
                <th>
                  メールアドレス
                </th>
                <th>
                  admin
                </th>
                <th>
                  編集
                </th>
                <th>
                  削除
                </th>
              </thead>
              <?php  foreach($users as $user) {?>
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->rank }}</td>
                  <td>
                    <a href="#">
                      <button class="btn btn-success">編集</button>
                    <a>
                  </td>
                  <td>
                    <a href="#">
                      <button class="btn btn-danger">削除</button>
                    <a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection