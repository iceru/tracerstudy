@extends('layout.adminapp')

@section('title')
Pertanyaan
@endsection

@section('content')
<div class="input-title">
    <h2>Data Kuesioner</h2>
    <hr>
</div>
<div class="input-form">
    @foreach ($pertanyaan as $key => $item)
    <div class="card my-3">
        <div class="card-header">
            <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan }} (  <a href="{{ route('pertanyaan.edit', $item->id) }}"> Edit </a>)</label>
        </div>
        <div class="card-body">

            <ul class="list-group">
                @foreach ($item->opsi as $opsi)
                <li class="list-group-item">
                    <label for="opsi{{ $opsi->id }}">
                    {{ $opsi->nama_opsi }} ( <a href="{{ route('opsi.edit', $opsi->id) }}">Edit </a>)
                    </label>
                </li>
                @endforeach

            </ul>
            @if ($item->jenis_pertanyaan == 'direct-answer')
            <p>Jawaban Langsung</p>
            @else
            <div class="tambah-opsi mt-4">
                <a href="{{ route('opsi.create') }}" class="button-red"> Tambah Opsi</a>
            </div>
            @endif

        </div>
    </div>
    @endforeach


    <div class="form-group py-4">
        <a href="{{ route('pertanyaan.create') }}" class="button-red"> Tambah Pertanyaan</a>
    </div>
</div>
@endsection
