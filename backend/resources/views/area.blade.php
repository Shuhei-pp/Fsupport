@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <caption>このエリアの天気</caption>
        <thead class="table-dark">
          <tr>
            <th>data</th>
            <?php for($i=3;$i<11;$i++) {?>
              <th>{{ $weather_info->list[$i]->dt_txt }}</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>weather</th>
            <?php for($i=3;$i<11;$i++) {?>
              <td>{{ $weather_info->list[$i]->weather[0]->main }}</td>
            <?php } ?>
          </tr>
          <tr>
            <th>temp</th>
            <?php for($i=0;$i<8;$i++) {?>
              <td>{{ $weather_info->list[$i]->main->temp }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>tide</th>
            <?php foreach($tide_heights as $tide_height) {?>
              <td>{{ $tide_height }}</td>
            <?php }?>
          </tr>
          <tr>
            <th>fi</th>
            <?php foreach($fi as $fi) {?>
              <td>{{ $fi }}</td>
            <?php } ?>
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
