@extends('layout.adminapp')

@section('content')
<div class="chartJabatan">
    <canvas id="canvas" height="280" width="600"></canvas>
    <h3>List Perusahaan Alumni</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th>Jumlah Alumni</th>
                <th>Detail Alumni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perusahaan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->alamat_perusahaan }}</td>
                <td>{{ $item->countPerusahaan }}</td>
                <td><a href="{{ route('laporan.showPerusahaan', $item->id) }}">Detail Alumni</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script>
    var url = "{{url('chart-perusahaan')}}";
    var chartPerusahaan = new Array();
    var countPerusahaan = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            chartPerusahaan.push(data.nama_perusahaan);
            countPerusahaan.push(data.countPerusahaan);
        });
        var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:chartPerusahaan,
                  datasets: [{
                    barPercentage: 1,
                    label: 'Perusahaan Alumni',
                    data: countPerusahaan,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
      });
    });
    </script>
@endsection
