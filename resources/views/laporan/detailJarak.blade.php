@extends('layout.adminapp')

@section('content')
<div class="back">
    <a href="{{ route('jarak.haversine') }}"><i class="fas fa-arrow-left    "></i>  Kembali</a>
</div>

<h1>Detail Perusahaan Alumni</h1>
<hr>


<div id="map" style="height:450px; margin-top: 40px"></div>

@foreach ($jarak as $jarak)
<div class="detailalumni">
    <p><strong>Nama Alumni:</strong> : {{ $jarak->nama_mhs }}</p>
    <p><strong>Perusahaan</strong> : {{ $jarak->nama_perusahaan }}</p>
    <p><strong>Alamat Perusahaan:</strong>  :  {{ $jarak->alamat_perusahaan }}</p>
</div>
@endforeach

</body>

@endsection

@section('js')
<script>
    function initMap() {
        var myLatLng = {lat: {!! json_encode($jarak->latitude) !!}, lng: {!! json_encode($jarak->longitude) !!}};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Marker'
        });
    }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&callback=initMap">
  </script>
@endsection
