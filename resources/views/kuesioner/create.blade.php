@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
        <form action="/kuesioner/{{ $history->id }}" method="post">
            @csrf
            @foreach ($pertanyaan as $key => $item)
            <div class="card my-3">
                <div class="card-header">
                    <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan }}</label>
                </div>
                <div class="card-body">
                    @error('responses.'. $key . '.opsi_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if ( $item->jenis_pertanyaan == 'direct-answer' )
                    <input type="text" name="responses[{{ $key }}][opsi_id]" class="form-control">
                    <input type="hidden" name="responses[{{ $key }}][pertanyaan_id]" value="{{ $item->id }}">

                    @elseif ( $item->jenis_pertanyaan == 'multiple-choice')
                    <ul class="list-group">
                        @foreach ($item->opsi as $opsi)
                        <label for="opsi{{ $opsi->id }}">
                        <li class="list-group-item">
                            <input type="radio" class="mr-2" name="responses[{{ $key }}][opsi_id]"
                            {{ old('responses.'. $key . '.opsi_id') == $opsi->id ? 'checked' : ''}}
                            id="opsi{{ $opsi->id }}" value="{{ $opsi->id }}">
                            {{ $opsi->nama_opsi }}
                            <input type="hidden" name="responses[{{ $key }}][pertanyaan_id]" value="{{ $item->id }}">
                        </li>
                        </label>
                        @endforeach
                    </ul>

                    @else
                    <ul class="list-group">
                        @foreach ($item->opsi as $opsi)
                        <label for="opsi{{ $opsi->id }}">
                        <li class="list-group-item">
                            <input type="checkbox" class="mr-2" name="responses[{{ $key }}][opsi_id][]"
                            id="opsi{{ $opsi->id }}" value="{{ $opsi->id }}">
                            {{ $opsi->nama_opsi }}
                            <input type="hidden" name="responses[{{ $key }}][pertanyaan_id]" value="{{ $item->id }}">
                        </li>
                        </label>
                        @endforeach
                    </ul>

                    @endif

                </div>
            </div>
            @endforeach


            <div class="form-group">
                <button type="submit" class="button-red">Submit</button>
            </div>
        </form>
</div>
@endsection
