@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>

    <h4>Kuesioner Alumni</h4>
    <hr>

        <form action="{{ route('kuesioner.storeMultiple') }}" method="POST" style="width: 100%">
            @csrf

            @foreach ($pertanyaan as $key => $item)
            <div class="card my-3">
                <div class="card-header">
                    <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan_ma }}</label>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($item->opsiMa as $opsiMa)
                        <label for="opsi{{ $opsiMa->id }}">
                        <li class="list-group-item">
                            <input type="checkbox" class="mr-2" name="id_opsi_ma[]"
                            id="opsi{{ $opsiMa->id }}" value="{{ $opsiMa->id }}">
                            {{ $opsiMa->nama_opsi_ma }}
                        </li>
                        </label>
                        <input type="hidden" name="id_alumni" value="{{ request()->route('id') }}">
                        <input type="hidden" name="id_pertanyaan_ma[]" value="{{ $item->id }}">
                        @endforeach
                    </ul>
                </div>
            </div>

            @endforeach






            <div class="form-group">
                <button type="submit" class="button-red">Submit</button>
            </div>
        </form>
</div>
@endsection
