@extends('layout.adminapp')

@section('content')
<div class="canvas" style="width: 60%; margin: auto;">
    <canvas id="canvas" height="200px" width="400px"></canvas>
</div>


<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Bidang Pertanyaan</th>
            <th>Hasil Kuesioner</th>
            <th>Total Alumni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kepuasan as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_pertanyaan }}</td>
            <td>
                <ul>
                @foreach ($item->opsi as $opsi)
                    <li>{{ $opsi->nama_opsi }}</li>
                @endforeach
                </ul>
            </td>
            <td>
                <ul>
                @foreach ($item->opsi as $opsi)
                    <li>{{ $opsi->jawaban->count() }}</li>
                @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
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
                  labels:[@foreach($kepuasan as $k => $item)
                                '{{ substr($item->nama_pertanyaan, 63, 12)}}',
                            @endforeach ],
                  datasets: [{@foreach($kepuasan as $k => $item)
                      barPercentage: 1,
                      label: 'Waktu Mendapatkan Pekerjaan (dalam Bulan)',
                      data: [
                                @foreach($item->opsi as $k => $opsi)
                                    '{{ $opsi->jawaban->count() }}',
                                @endforeach
                            ],
                      borderWidth: 1,
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    @endforeach}]
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

