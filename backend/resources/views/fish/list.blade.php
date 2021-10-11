@extends('layouts.app')

@section('content')

<div class="container">
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">魚テーブルList</div>

      <div class="table-responsive">
        <div class="card-body">
          <table class=table>
            <tbody>
              <thead>
                <th>
                  魚ID
                </th>
                <th>
                  魚の名前
                </th>
                <th>
                  編集
                </th>
                <th>
                  削除
                </th>
              </thead>
              <?php  foreach($fishes as $fish) {?>
                <tr>
                  <td>{{ $fish->fish_id }}</td>
                  <td>{{ $fish->fish_name }}</td>
                  <td>
                    <a href=" {{ route('fish.edit',[ 'fish_id' => $fish->fish_id ]) }}">
                      <button class="btn btn-success">編集</button>
                    <a>
                  </td>
                  <td>
                    <button class="btn btn-danger delete_button" value="{{ $fish->fish_id }}">削除</button>
                    <a href=" {{ route('fish.delete',['fish_id' => $fish->fish_id]) }}">
                      <button id="{{ $fish->fish_id }}" style="display:none;"></button>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="container">
            <a href={{ route('fish.create') }}>
              <button class="btn btn-primary">魚追加</button>
            </a>
          </div>
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
    if(window.confirm("本当に削除しても大丈夫ですか？")){
      $fish_id = "#"+this.value;
      $($fish_id).click();
    }
  });
</script>
@endsection