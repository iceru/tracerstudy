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
            @can('data-edit')
            <a href="{{ route('pertanyaan.edit', $item->id) }}"> <i class="fas fa-edit    "></i> Edit Pertanyaan</a>
            @endcan
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($item->opsi as $opsi)
                <li class="list-group-item d-flex justify-content-between">
                    <label for="opsi{{ $opsi->id }}">
                    {{ $opsi->nama_opsi }}
                    </label>
                    @can('data-edit')
                    <div id="action">
                        <a href="{{ route('opsi.edit', $opsi->id) }}"><i class="fas fa-edit    "></i> Edit Opsi</a>
                        <form action="{{ route('opsi.destroy', $opsi->id )}}" method="get">
                           @csrf
                           @method('DELETE')
                           <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                       </form>
                    </div>
                    @endcan

                </li>
                @endforeach

            </ul>
            @if ($item->jenis_pertanyaan == 'direct-answer')
            <p>Jawaban Langsung</p>
            @else
            @can('data-create')
            <div class="tambah-opsi mt-4">
                <a href="{{ route('opsi.create') }}" class="button-red"> Tambah Opsi</a>
            </div>
            @endcan
            @endif

        </div>
    </div>
    @endforeach

    @foreach ($pertanyaanDa as $keyDa => $item)
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <label for="">{{ $keyDa + $key + 2 }}. {{ $item->nama_pertanyaan_da }} </label>
            @can('data-edit')
            <a href="{{ route('pertanyaan.editDirect', $item->id) }}"> <i class="fas fa-edit    "></i> Edit Pertanyaan</a>
            @endcan
        </div>
        <div class="card-body">
            Jawaban Langsung
        </div>
    </div>
    @endforeach


    @foreach ($pertanyaanMa as $keyMa => $item)
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <label for="">{{ $keyMa + $keyDa + $key + 3 }}. {{ $item->nama_pertanyaan_ma }} </label>
            @can('data-edit')
            <a href="{{ route('pertanyaan.editMultiple', $item->id) }}"> <i class="fas fa-edit    "></i> Edit Pertanyaan</a>
            @endcan
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($item->opsiMa as $opsi)
                <li class="list-group-item d-flex justify-content-between">
                    <label for="opsi{{ $opsi->id }}">
                    {{ $opsi->nama_opsi_ma }}
                    </label>
                    @can('data-edit')
                    <div id="action">
                        <a href="{{ route('opsi.editMultiple', $opsi->id) }}"><i class="fas fa-edit    "></i> Edit Opsi</a>
                        <form action="{{ route('opsi.destroyMultiple', $opsi->id )}}" method="get">
                           @csrf
                           @method('DELETE')
                           <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                       </form>
                    </div>
                    @endcan

                </li>
                @endforeach

            </ul>

        </div>
    </div>
    @endforeach

    @can('data-create')
    <div class="form-group py-4">
        <a href="{{ route('pertanyaan.create') }}" class="button-red"> Tambah Pertanyaan</a>
    </div>
    @endcan
</div>
@endsection
