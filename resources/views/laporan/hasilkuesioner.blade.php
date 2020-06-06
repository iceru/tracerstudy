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
            <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan }} </label> <p class="data-percentage"> {{ $item->jawaban->count() }} </p>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($item->opsi as $opsi)
                <li class="list-group-item d-flex justify-content-between">
                    <label for="opsi{{ $opsi->id }}">
                    <p>{{ $opsi->nama_opsi }}</p>
                    </label>
                    <p class="data-percentage"> {{ round(($opsi->jawaban->count() * 100) / $item->jawaban->count(), 2) }} %</p>
                </li>
                @endforeach

            </ul>
            @if ($item->jenis_pertanyaan == 'direct-answer')
            @foreach ($item->jawaban->groupby('id_opsi') as $key => $jawaban)
                <li class="list-group-item d-flex justify-content-between">
                    <label>
                    {{ $key }}
                    </label>
                    <p class="data-percentage">{{ count($jawaban) }}</p>
                </li>
                @endforeach
            @else
            @endif

        </div>
    </div>
    @endforeach


</div>
@endsection
