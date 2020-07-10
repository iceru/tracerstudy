@extends('layout.adminapp')

@section('title')
    Laporan Tracer Study
@endsection


@section('content')
<div class="wrap-input">
    <p><a class="redtext" href="{{ route('home') }}">Dashboard</a> / <a class="redtext" href="{{ route('laporan.index') }}">Daftar Laporan</a> / Laporan Kesesuaian Bidang Pekerjaan Alumni</p>
    <h3>Laporan Kesesuaian Bidang Pekerjaan Alumni</h3>
    <hr>
    <div class="chartJabatan">
        <div class="canvas1" style="width: 70%; margin: auto">
            <canvas id="canvas" height="340px" width="900px"></canvas>
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
                    <th>Kesesuaian Bidang <i class="fas fa-sort    "></i></th>
                    <th>Total Alumni <i class="fas fa-sort    "></i></th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
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
                  labels:[@foreach($data as $k => $item)
                            '{{ $item->nama_opsi }}',
                            @endforeach ],
                  datasets: [{
                      barPercentage: 1,
                      label: 'Kesesuaian Bidang Alumni',
                      data: [@foreach($data as $k => $item)
                            '{{ $item->countBidang }}',
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
