@extends('layout.adminapp')

@section('content')
<div class="chartJabatan">
    <canvas id="canvas" height="340px" width="900px"></canvas>

    <h3>List Jabatan Alumni</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Jabatan</th>
                <th>Total Alumni</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jabatan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_jabatan }}</td>
                <td>{{ $item->countJabatan }}</td>
                <td><a href="{{ route('laporan.showJabatan', $item->id) }}">Detail Alumni</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script>
    var url = "{{url('chart-jabatan')}}";
    var namaJabatan = new Array();
    var countJabatan = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            namaJabatan.push(data.nama_jabatan);
            countJabatan.push(data.countJabatan);
        });
        var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:namaJabatan,
                  datasets: [{
                      barPercentage: 1,
                      label: 'Jabatan Alumni',
                      data: countJabatan,
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
