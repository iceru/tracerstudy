@extends('layout.adminapp')

@section('content')
<div class="chartJabatan">
    <div class="wrap-input">
        <a style="color: blue" href="{{ route('laporan.jabatan') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Kembali</a>
        <h3>Data Alumni berdasarkan Jabatan</h3>
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
                @foreach ($data as $item)
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
                  labels:[@foreach($data as $k => $item)
                            '{{ $item->nama_jabatan }}',
                            @endforeach ],
                  datasets: [{
                      barPercentage: 1,
                      label: 'Jabatan Alumni',
                      data: [@foreach($data as $k => $item)
                            '{{ $item->countJabatan }}',
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
