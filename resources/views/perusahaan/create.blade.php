@extends('layout.adminapp')

@section('title')
Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Perusahaan</h2>
    <hr>
</div>

<div class="back-to-data py-3">
    <a href="{{ route('perusahaan.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>

<div class="input-form">
    <form action="{{ route('perusahaan.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Perusahaan</label>
            <input type="text" id="address-input" name="alamat_perusahaan" class="form-control map-input">
            <input type="hidden" name="latitude" id="address-latitude" value="-6.2295712" />
            <input type="hidden" name="longitude" id="address-longitude" value="106.7594779" />
        </div>

        <div id="address-map-container" style="width:100%;height:400px; ">
            <div style="width: 100%; height: 100%" id="address-map"></div>
        </div>

        <div class="form-group">
            <label for="nama">Kontak Perusahaan</label>
            <input type="text" class="form-control" name="kontak_perusahaan" id="kontak_perusahaan">
        </div>

        <div class="form-group">
            <label for="">Sektor Perusahaan</label>
            <select class="form-control" name="id_sektor" id="id_sektor">
                @foreach ($sektor as $key => $sektor)
                <option value="{{ $sektor->id }}">{{ $sektor->nama_sektor }}</option>
                @endforeach
            </select>
          </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('js')
    @parent
    <script src="/js/mapInput.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&libraries=places&callback=initialize" async defer></script>
@stop
