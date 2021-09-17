@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <caption>このエリアの天気</caption>
        <thead class="table-dark">
          <tr>
            <th>data</th>
            <?php for($i=0;$i<8;$i++) {?>
              <th>{{ $info->times[$i] }}</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>weather</th>
            <?php for($i=0;$i<8;$i++) {?>
              <td>{{ $info->weather[$i] }}</td>
            <?php } ?>
          </tr>
          <tr>
            <th>temp</th>
            <?php for($i=0;$i<8;$i++) {?>
              <td>{{ $info->temp[$i] }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>tide</th>
            <?php foreach($info->tide as $tide) {?>
              <td>{{ $tide }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>FI</th>
            <?php foreach($info->fi as $fi) {?>
              <td>{{ $fi }}</td>
            <?php }?>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
  <div class="container">
    <div class="py-3">
      <canvas id="myChart" class=""></canvas>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.onload = function(){
      const labels = @json($info->times);
      const data = {
        labels: labels,
        datasets: [{
          label: 'Fi(釣果指数)',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: @json($info->fi),
        }]
      };
      const config = {
      type: 'line',
      data: data,
      options: {}
      };
      var myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
    }
  </script>
@endsection
