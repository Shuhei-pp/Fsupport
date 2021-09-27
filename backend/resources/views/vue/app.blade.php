@extends('layouts.app')

@section('content')
  <example-component></example-component>
@endsection

@section('script')
  <!-- script-->
  <script src="{{ mix('/js/app.js') }}"></script>
@endsection
