@extends('layout.adminapp')

@section('content')
<div class="wrap-input">
    <p><a class="redtext" href="{{ route('home') }}">Dahsboard</a> / <a class="redtext" href="{{ route('laporan.index') }}">Daftar Laporan</a> / Laporan Alumni dalam Kesesuaian Bidang Pekerjaan</p>
    <div class="chartJabatan">
        <canvas id="canvas" height="340px" width="900px"></canvas>

        <h3>Laporan Alumni dalam Kesesuaian Bidang Pekerjaan</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kesesuaian Bidang</th>
                    <th>Total Alumni</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bidang as $item)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_opsi  }}</td>
                    <td>{{ $item->countBidang }}</td>
                    <td><a href="{{ route('laporan.showBidang', $item->id) }}">Detail Alumni</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('js')
<script>
    var url = "{{url('chart-bidang')}}";
    var namaOpsi = new Array();
    var countBidang = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            namaOpsi.push(data.nama_opsi);
            countBidang.push(data.countBidang);
        });
        var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:namaOpsi,
                  datasets: [{
                      barPercentage: 1,
                      label: 'Kesesuaian Bidang Alumni',
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
