@include('common.head')
<body>
@include('common.header')
<?php
  foreach($area_info as $info){
    echo '<a href="/area/'.$info->id.'">'.$info->area_name.'</a></br>';
  }
?>
@include('common.footer')
</body>