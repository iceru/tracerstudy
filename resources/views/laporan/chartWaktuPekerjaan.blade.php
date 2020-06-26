@extends('layout.adminapp')

@section('content')
<div class="chartJabatan">
    <div class="canvas d-flex justify-content-center text-center" style="width: 70%; margin: auto">
        <canvas id="canvas"  height="340px" width="900px"></canvas>
    </div>

    <h3>List Waktu Mencari Pekerjaan Alumni</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Lama Waktu Mencari Pekerjaan</th>
                <th>Total Alumni</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waktu as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->jawaban  }} Bulan</td>
                <td>{{ $item->countBidang }}</td>
                <td><a href="{{ route('laporan.showWaktuPekerjaan', $item->jawaban) }}">Detail Alumni</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script>
    var url = "{{url('chart-waktuPekerjaan')}}";
    var namaOpsi = new Array();
    var countBidang = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            namaOpsi.push(data.jawaban);
            countBidang.push(data.countBidang);
        });
        var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:namaOpsi,
                  datasets: [{
                      barPercentage: 1,
                      label: 'Waktu Mendapatkan Pekerjaan (dalam Bulan)',
                      data: countBidang,
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
