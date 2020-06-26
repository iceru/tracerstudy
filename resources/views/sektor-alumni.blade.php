@extends('layout.app')

@section('content')
<div class="sektor-alumni">
    <form action="{{ route('sektor.storeAlumni') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Sektor Perusahaan</label>
            <input type="text" class="form-control" name="nama_sektor" id="nama_sektor">
        </div>

        <button type="submit" class="button-red">Submit</button>
    </form>
</div>

@endsection
