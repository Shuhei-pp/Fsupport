@extends('layouts.app')

@section('content')

  <?php foreach($area_info as $info) { ?>
    <a href="/area/{{ $info->id }}">{{ $info->area_name }}</a></br>
  <?php } ?>
@endsection