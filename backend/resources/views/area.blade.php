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
    <div>
      <canvas id="myChart"></canvas>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.onload = function(){
      const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      ];
      const data = {
      labels: labels,
      datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: [0, 10, 5, 2, 20, 30, 45],
      }]
      };
      const config = {
      type: 'line',
      data: data,
      options: {}
      };
      console.log (66);
      var myChart = new Chart(
          document.getElementById('myChart'),
          config
      );
    }
  </script>
@endsection
