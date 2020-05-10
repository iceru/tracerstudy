@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
    <div class="alumni-left">
        <form action="store/{id}" method="post">
            @csrf
            <input type="text" class="form-control" name="id_alumni" value="{{ request()->route('id')}}" hidden>

            <div class="form-group">
                <label for="">Pekerjaan</label>
                <select class="form-control" name="id_jabatan" id="id_jabatan">
                <option>Pekerjaan</option>
                @foreach ($jabatan as $item)
                <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                @endforeach
                </select>
                <small id="helpId" >Tidak menemukan pekerjaan?</small>
            </div>

            <div class="form-group">
                <label for="">Perusahaan</label>
                <select class="form-control" name="id_perusahaan" id="id_perusahaan">
                    <option>Perusahaan</option>
                    @foreach ($perusahaan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_perusahaan }}</option>
                    @endforeach
                </select>
                <small id="helpId">Tidak menemukan perusahaan?</small>
            </div>

            <div class="form-group">
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
