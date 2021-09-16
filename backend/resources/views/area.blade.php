@extends('layouts.app')

@section('content')
  <table border="1px">
    <tr>
      <th>data</th>
      <?php for($i=3;$i<11;$i++) {?>
        <th>{{ $weather_info->list[$i]->dt_txt }}</th>
      <?php } ?>
    </tr>
    <tr>
      <td>weather</td>
      <?php for($i=3;$i<11;$i++) {?>
        <td>{{ $weather_info->list[$i]->weather[0]->main }}</td>
      <?php } ?>
    </tr>
    <tr>
      <td>temp</td>
      <?php for($i=0;$i<8;$i++) {?>
        <td>{{ $weather_info->list[$i]->main->temp }}</td>
      <?php }?>
    </tr>
    <tr>
      <td>tide</td>
      <?php foreach($tide_heights as $tide_height) {?>
        <td>{{ $tide_height }}</td>
      <?php }?>
    </tr>
    <tr>
      <td>fi</td>
      <?php foreach($fi as $fi) {?>
        <td>{{ $fi }}</td>
      <?php } ?>
    </tr>
  </table>
@endsection