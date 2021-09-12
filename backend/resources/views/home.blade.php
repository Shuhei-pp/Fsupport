@include('common.head')
<body>
@include('common.header')
<a href="/area/950-2102,jp">Shinkawa</a>
<?php
  foreach($area_info as $info){
    echo '<a href="/area/'.$info->id.'">'.$info->area_name.'</a></br>';
  }
?>
@include('common.footer')
</body>