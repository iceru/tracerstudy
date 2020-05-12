@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
    <div class="alumni-left">
        <form action="alumni/store/{id}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Nomor Induk Mahasiswa</label>
              <select class="form-control" name="NIM" id="NIM">
                <option>NIM</option>
                @foreach ($mahasiswa as $item)
                <option value="{{ $item->NIM }}">{{ $item->NIM }} - {{ $item->nama_mhs }}</option>
                @endforeach
              </select>
              <small id="helpId">Lupa NIM? Cari dengan Nama</small>
            </div>

            <div class="form-group ">
                <label for="" >Email Aktif</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="form-group ">
                <label for="">No. Handphone Aktif</label>
                <input class="form-control" type="text" name="no_hp" id="no_hp">
            </div>

            <div class="form-group ">
                <button type="submit" class="button-red">Submit</button>
            </div>
        </form>
    </div>
    <div class="alumni-right">
        <h4>Selamat Datang di Laman Tracer Study Universitas Tarumanagara</h3>
        <p>Terima kasih sudah mengunjungi laman ini dan turut berpartisipasi dalam melakukan pengisian data anda.</p>
    </div>
</div>

@endsection
