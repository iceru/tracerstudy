@extends('layout.adminapp')

@section('title')
    Dashboard Admin - Tracer Study Universitas Tarumanagara
@endsection

@section('content')
<h2>Dashboard Tracer Study Universitas Tarumanagara</h2>
<div class="headerdash">
    <div class="leftdash">
        <div class="topdash1">
            <div class="d-flex justify-content-between align-items-center">
                <p>Total Alumni</p>
                <i class="fas fa-user-graduate fa-lg"></i>
            </div>
            <h4>{{ $countAlumni }}</h4>
        </div>
        <div class="topdash2">
            <div class="d-flex justify-content-between align-items-center">
                <p>Total Perusahaan</p>
                <i class="fa fa-building fa-lg" aria-hidden="true"></i>
            </div>
            <h4>{{ $countPerusahaan }}</h4>
        </div>
        <div class="topdash3">
            <div class="d-flex justify-content-between align-items-center">
                <p>Total Data Kelulusan Mahasiswa</p>
                <i class="fas fa-university fa-lg"></i>
            </div>
            <h4>{{ $countMhs }}</h4>
        </div>
        <div class="topdash3">
            <div class="d-flex justify-content-between align-items-center">
                <p>Total Kuesioner yang dilakukan</p>
                <i class="fas fa-poll fa-lg"></i>
            </div>
            <h4>{{ $countKuesioner }}</h4>
        </div>
    </div>
</div>

<div class="middledash">
    <div class="leftdash2">
        <h4>Jumlah Lulusan berdasarkan Program Studi</h4>
        <canvas id="canvasMhs" height="150px" width="auto"></canvas>
    </div>
    <div class="rightdash">
        <h4>Jumlah Alumni Terdata berdasarkan Program Studi</h4>
        <canvas id="canvasProdi" height="150px" width="auto"></canvas>
    </div>
</div>

<div class="middledash">
    <div class="leftdash2">
        <h4>Data Alumni berdasarkan Jabatan</h4>
        <canvas id="canvasJabatan" height="150px" width="auto"></canvas>
    </div>

    <div class="rightdash">
        <h4>Data Alumni berdasarkan Perusahaan</h4>
        <canvas id="canvasPerusahaan" height="150px" width="auto"></canvas>
    </div>
</div>
@endsection

@section('js')

<script>
    var urldata = "{{url('chart-jabatan')}}";
    var namaJabatan = new Array();
    var countJabatan = new Array();
    $(document).ready(function(){
      $.get(urldata, function(response){
        response.forEach(function(data){
            namaJabatan.push(data.nama_jabatan);
            countJabatan.push(data.countJabatan);
        });
        var ctx = document.getElementById("canvasJabatan").getContext('2d');
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
                        'rgba(153, 130, 225, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
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
        var ctx = document.getElementById("canvasPerusahaan").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                  labels:chartPerusahaan,
                  datasets: [{
                    barPercentage: 1,
                    label: 'Perusahaan Alumni',
                    data: countPerusahaan,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 200, 132, 0.2)',
                        'rgba(144, 40, 235, 0.2)',
                        'rgba(255, 26, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                  }]
              },
              options: {
                  scales: {
                      xAxes: [{
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

<script>
    var urlProdi = "{{url('alumni-chart')}}";
    var chartProdi = new Array();
    var countProdi = new Array();
    $(document).ready(function(){
      $.get(urlProdi, function(response){
        response.forEach(function(data){
            chartProdi.push(data.nama_prodi);
            countProdi.push(data.countProdi);
        });
        var ctx = document.getElementById("canvasProdi").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:chartProdi,
                  datasets: [{
                    barPercentage: 1,
                    label: 'Program Studi',
                    data: countProdi,
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

<script>
    var urlMhs = "{{url('mahasiswa-chart')}}";
    var chartMhs = new Array();
    var countMhs = new Array();
    $(document).ready(function(){
      $.get(urlMhs, function(response){
        response.forEach(function(data){
            chartMhs.push(data.nama_prodi);
            countMhs.push(data.countProdi);
        });
        var ctx = document.getElementById("canvasMhs").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                  labels: chartMhs,
                  datasets: [{
                    barPercentage: 1,
                    label: 'Lulusan',
                    data: countMhs,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                  }]
              },
              options: {
                  scales: {
                      xAxes: [{
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
