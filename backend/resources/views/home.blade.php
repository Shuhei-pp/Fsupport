wel
<?php
  foreach($weather_info->list as $weather_list){
    echo $weather_list->main->temp."</br>";
  }
?>