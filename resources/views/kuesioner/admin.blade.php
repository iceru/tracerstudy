@extends('layout.adminapp')

@section('title')
Pertanyaan
@endsection

@section('content')
<div class="input-title col-md-10">
    <h2>Data Kuesioner</h2>
    <hr>
</div>
<div class="input-form col-md-10">
    @foreach ($pertanyaan as $key => $item)
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan }} </label>
            <a href="{{ route('pertanyaan.edit', $item->id) }}"> <i class="fas fa-edit    "></i> Edit </a>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($item->opsi as $opsi)
                <li class="list-group-item d-flex justify-content-between">
                    <label for="opsi{{ $opsi->id }}">
                    {{ $opsi->nama_opsi }}
                    </label>
                    <div id="action">
                        <a href="{{ route('opsi.edit', $opsi->id) }}"><i class="fas fa-edit    "></i> Edit </a>
                        <form action="{{ route('opsi.destroy', $opsi->id )}}" method="get">
                           @csrf
                           @method('DELETE')
                           <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                       </form>
                    </div>

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
