<?php
  foreach($area_info as $info){
    echo '<a href="/area/'.$info->area_zip.'">'.$info->area_name.'</a></br>';
  }
?>