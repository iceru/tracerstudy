@extends('layout.app')

@section('content')
<div class="sektor-alumni">
    <form action="{{ route('perusahaan.storealumni')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" aria-describedby="helpId">
        </div>

          <div class="form-group">
              <label for="alamat">Alamat Perusahaan</label>
              <input type="text" id="address-input" name="alamat_perusahaan" class="form-control map-input">
              <input type="hidden" name="latitude" id="address-latitude" value="-6.2295712" />
              <input type="hidden" name="longitude" id="address-longitude" value="106.7594779" />
          </div>

          <div id="address-map-container" style="width:100%;height:200px; ">
              <div style="width: 100%; height: 100%" id="address-map"></div>
          </div>

        <div class="form-group">
            <label for="kontak_perusahaan">Kontak Perusahaan</label>
            <input type="text" class="form-control" name="kontak_perusahaan" id="kontak_perusahaan" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="id_sektor">Sektor Perusahaan</label>
            <select class="form-control" name="id_sektor" id="id_sektor">
                @foreach ($sektor as $item)
                <option value="{{ $item->id }}">{{ $item->nama_sektor }}</option>
                @endforeach
            </select>
            <a href="{{ route('sektor.createAlumni') }}">Tidak menemukan sektor perusahaan?</a>
        </div>
        <button type="submit" class="button-red">Submit</>
    </form>
</div>

@endsection

@section('js')
    @parent
    <script src="/js/mapInput.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&libraries=places&callback=initialize" async defer></script>
@stop
