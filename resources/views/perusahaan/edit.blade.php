@extends('layout.adminapp')

@section('title')
    Update Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Perusahaan</h2>
    <hr>
</div>

<div class="back-to-data py-3">
    <a href="{{ route('perusahaan.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>

<div class="input-form">
    <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Perusahaan</label>
            <input type="text" class="form-control" name="id_perusahaan" id="id_perusahaan" value="{{ old('id_perusahaan', $perusahaan->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" >
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Perusahaan</label>
            <input type="text" id="address-input" name="alamat_perusahaan" value="{{ old('alamat_perusahaan', $perusahaan->alamat_perusahaan) }}"  class="form-control map-input">
            <input type="hidden" name="latitude" id="address-latitude" value="{{ old('latitude', $perusahaan->latitude) }}" />
            <input type="hidden" name="longitude" id="address-longitude" value="{{ old('longitude', $perusahaan->longitude) }}" />
        </div>

        <div id="address-map-container" style="width:100%;height:400px; margin-bottom: 30px">
            <div style="width: 100%; height: 100%;" id="address-map"></div>
        </div>


        <div class="form-group">
            <label for="">Kontak Perusahaan</label>
            <input type="text" class="form-control" name="kontak_perusahaan" id="kontak_perusahaan" value="{{ old('kontak_perusahaan', $perusahaan->kontak_perusahaan) }}" >
        </div>

        <div class="form-group">
            <label for="">Sektor Perusahaan</label>
            <select class="form-control" name="id_sektor" id="id_sektor">
                @foreach ($sektor as $sektor)
                <option  value="{{ $sektor->id }}" {!! old('nama_sektor', $perusahaan->sektor->id) == $sektor->id ? 'selected="selected"' : '' !!}> {{ $sektor->nama_sektor }}</option>
                @endforeach
            </select>
          </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('perusahaan.create') }}">Cancel</button>
    </form>

</div>
@endsection

@section('js')
    @parent
    <script src="/js/mapInput.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&libraries=places&callback=initialize" async defer></script>
@stop
