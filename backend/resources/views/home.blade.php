@extends('layouts.app')

@section('content')
<?php
  foreach($area_info as $info){
    echo '<a href="/area/'.$info->id.'">'.$info->area_name.'</a></br>';
  }
?>
@endsection