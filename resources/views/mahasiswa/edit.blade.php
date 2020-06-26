@extends('layout.adminapp')

@section('title')
    Update Mahasiswa
@endsection

@section('content')
<div class="wrap-input">

    <div class="input-title">
        <h2>Update Data Mahasiswa</h2>
        <hr>
    </div>

    <div class="back-to-data py-3">
        <a href="{{ route('mahasiswa.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
    </div>

    <div class="input-form">
        <form action="{{ route('mahasiswa.update', $mahasiswa->NIM) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="id">ID Mahasiswa</label>
                <input type="text" class="form-control" name="NIM" id="NIM" value="{{ old('NIM', $mahasiswa->NIM) }}">
            </div>

            <div class="form-group">
                <label for="">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" value="{{ old('nama_mhs', $mahasiswa->nama_mhs) }}" >
            </div>

            <div class="form-group">
                <label for="tgl_yudisium">Tanggal Yudisium</label>
                <input type="text" class="form-control" name="tgl_yudisium" id="datepicker" readonly value="{{ old('tgl_yudisium', $mahasiswa->tgl_yudisium) }}">
            </div>

            <div class="form-group">
                <label for="ipk">IPK</label>
                <input type="text" class="form-control" name="ipk" id="ipk" value="{{ old('ipk', $mahasiswa->ipk) }}">
            </div>

            <div class="form-group">
                <label for="">Program Studi</label>
                <select class="form-control" name="id_prodi" id="id_prodi">
                    @foreach ($prodi as $prodi)
                    <option value="{{ $prodi->id }}" {!! old('nama_prodi', $mahasiswa->prodi->id) == $prodi->id ? 'selected="selected"' : '' !!} >{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
              </div>

            <button class="btn btn-warning" type="submit">Update</button>
            <button class="btn btn-secondary" href="{{ route('mahasiswa.index') }}">Cancel</button>
        </form>

    </div>
</div>
@endsection


@section('js')

<script>
$( function() {
  $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
  });
} );
</script>
@endsection
