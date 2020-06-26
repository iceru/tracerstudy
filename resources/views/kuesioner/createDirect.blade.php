@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>

    <h4>Kuesioner Alumni</h4>
    <hr>
        <form action="{{ route('kuesioner.storeDirect') }}" method="POST" style="width: 100%">
            @csrf

            @foreach ($pertanyaanDirect as $key => $item)

            <div class="card my-3">
                <div class="card-header">
                    <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan_da }}</label>
                </div>
                <div class="card-body">
                    <input type="hidden" name="jawaban[{{ $key }}][id_pertanyaan_da]" value="{{ $item->id }}">
                    <input type="text" class="form-control" name="jawaban[{{ $key }}][jawaban]" id="">
                    <input type="hidden" name="jawaban[{{ $key }}][id_alumni]" value="{{ request()->route('id') }}">
                </div>
            </div>
            @endforeach


            <div class="form-group">
                <button type="submit" class="button-red">Submit</button>
            </div>
        </form>
</div>
@endsection
