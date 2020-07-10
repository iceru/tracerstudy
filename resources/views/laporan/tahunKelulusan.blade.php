@extends('layout.adminapp')

@section('title')
    Laporan Tracer Study
@endsection

@section('content')

<div class="wrap-input">
    <p><a class="redtext" href="{{ route('home') }}">Dashboard</a> / <a class="redtext" href="{{ route('laporan.index') }}">Daftar Laporan</a> / Laporan Alumni berdasarkan Waktu Lulus</p>
    <h3>Laporan Alumni berdasarkan Waktu untuk Lulus</h3>
    <hr>
    <div class="canvas" style="width: 60%; margin: auto;">
        <canvas id="canvas" height="200px" width="400px"></canvas>
    </div>

    <div class="opsi d-flex">
        <div class="fakultas pr-4">
            <div onclick="ddFakultas()" class="wrdd" tabindex="1">
              <span>{{ $fakultasNama }}</span>
              <ul class="dd-item" id="ddfakultas">
                @foreach ($fakultas as $item)
                <li><a href="{{request()->fullUrlWithQuery(['fakultas'=> $item->nama_fakultas])}}">{{ $item->nama_fakultas }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="prodi pr-4">
            <div onclick="ddProdi()" class="wrdd" tabindex="1">
              <span>{{ $prdName }}</span>
              <ul class="dd-item" id="ddprodi">
                @foreach ($prodi as $item)
                <li><a href="{{request()->fullUrlWithQuery(['prodi'=> $item->nama_prodi])}}">{{ $item->nama_prodi }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="lulusan pr-4">
            <div onclick="ddLulusan()" class="wrdd" tabindex="1">
              <span>{{ $llsName }}</span>
              <ul class="dd-item" id="ddlulusan">
                @foreach ($lulusan as $item)
                <li><a href="{{request()->fullUrlWithQuery(['lulusan'=> $item->lulusan])}}">{{ $item->lulusan }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <a style="margin: 20px 0" href="{{request()->url()}}" class="button-red">Clear Filter</a>

    </div>
    <table class="table tablesorter" id="myTable">
        <thead>
            <tr>
                <th>No <i class="fas fa-sort    "></i></th>
                <th>Waktu Alumni untuk Lulus <i class="fas fa-sort    "></i></th>
                <th>Total Alumni <i class="fas fa-sort    "></i></th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->tahunKelulusan - 0.5 }} - {{ $item->tahunKelulusan  }} Tahun</td>
                <td>{{ $item->hitungKelulusan  }}</td>
                <td><a href="{{ route('laporan.detailKelulusan', $item->tahunKelulusan) }}">Detail</a> </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <h5>Data Tidak Valid</h5>
    <table class="table">
        <tbody>
            @foreach ($tidakValid as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>Lebih dari 7 Tahun</td>
                <td>{{ $item->hitungKelulusan  }}</td>
                <td><a href="{{ route('laporan.detailKelulusan', $item->tahunKelulusan) }}">Detail</a> </td>
            </tr>
            @endforeach

        </tbody>
        <tbody>
            @foreach ($tidakValid2 as $item)
                <td scope="row">{{ $loop->iteration + 1 }}</td>
                <td>Kurang dari 3,5 Tahun</td>
                <td>{{ $item->hitungKelulusan  }}</td>
                <td><a href="{{ route('laporan.detailKelulusan', $item->tahunKelulusan) }}">Detail</a> </td>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')

<script>
    var url = "{{url('chart-tahun-kelulusan')}}";
    var tahunKelulusan = new Array();
    var hitungKelulusan = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            tahunKelulusan.push(data.tahunKelulusan);
            hitungKelulusan.push(data.hitungKelulusan);
        });
        var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:[@foreach($data as $k => $item)
                            '{{ $item->tahunKelulusan }} Tahun',
                            @endforeach ],
                  datasets: [{
                      barPercentage: 1,
                      label: 'Tahun Kelulusan Alumni',
                      data: [@foreach($data as $k => $item)
                            '{{ $item->hitungKelulusan }}',
                            @endforeach ],
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
