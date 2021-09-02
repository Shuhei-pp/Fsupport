<a href="/area/950-2102,jp">Shinkawa</a>


<?php
  foreach($weather_info->list as $weather_list){
    echo $weather_list->main->temp."</br>";
  }
?>