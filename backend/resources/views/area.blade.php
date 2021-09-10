<head>
@include('common.head')
</head>

<body>
  @include('common.header')
  <table border="1px">
    <tr>
      <th>data</th>
      <?php 
      for($i=3;$i<11;$i++)
        echo "<th>".$weather_info->list[$i]->dt_txt."</th>";
      ?>
    </tr>
    <tr>
      <td>weather</td>
      <?php 
      for($i=3;$i<11;$i++)
        echo "<td>".$weather_info->list[$i]->weather[0]->main."</td>";
      ?>
    </tr>
    <tr>
      <td>temp</td>
      <?php
      for($i=0;$i<8;$i++)
        echo "<td>".$weather_info->list[$i]->main->temp."</td>";
      ?>
    </tr>
    <tr>
      <td>tide</td>
      <?php
        foreach($tide_heights as $tide_height)
          echo "<td>".$tide_height."</td>";
      ?>
    </tr>
  </table>
  @include('common.footer')
</body>