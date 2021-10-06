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
                    <a href=" {{ route('fish.edit',['fish_id' => $fish->fish_id]) }} ">
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
        </div>
      </div>
    </div>
  </div>
</div>

@endsection