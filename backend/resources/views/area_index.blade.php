<head>
@include('common.head')
</head>

<body>
  @include('common.header')
  <table border="1px">
    <tr>
      <th>data</th>
      <?php 
      foreach($weather_info->list as $weather_list)
        echo "<th>".$weather_list->dt_txt."</th>";
      ?>
    </tr>
    <tr>
      <td>weather</td>
      <?php 
      foreach($weather_info->list as $weather_list)
        echo "<td>".$weather_list->weather[0]->main."</td>";
      ?>
    </tr>
    <tr>
      <td>temp</td>
      <?php 
      foreach($weather_info->list as $weather_list)
        echo "<td>".$weather_list->main->temp."</td>";
      ?>
    </tr>
  </table>
  @include('common.footer')
</body>