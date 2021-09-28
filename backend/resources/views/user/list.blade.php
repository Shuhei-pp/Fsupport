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
                  利用停止
                </th>
                <th>
                  利用ステータス
                </th>
              </thead>
              <?php  foreach($users as $user) {?>
                <tr>
                  <td>{{ $user->user_id }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->rank }}</td>
                  <td>
                    <a href=" {{ route('user.edit',['user_id' => $user->user_id]) }} ">
                      <button class="btn btn-success">編集</button>
                    <a>
                  </td>
                  <td>
                    <button class="btn btn-danger delete_button" value="{{ $user->user_id }}">利用停止</button>
                    <a href=" {{ route('user.delete',['user_id' => $user->user_id]) }}">
                      <button id="{{ $user->user_id }}" style="display:none;"></button>
                    </a>
                  </td>

                  <td>
                    @if($user->disabled_id)
                      {{ $user->disabled_status_name }}
                    @endif
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

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).on('click','.delete_button',function() {
    if(window.confirm("利用停止にしても大丈夫ですか？")){
      $user_id = "#"+this.value;
      $($user_id).click();
    }
  });
</script>
@endsection