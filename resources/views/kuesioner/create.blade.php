@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
        <form action="{{ route('kuesioner.store') }}" method="post">
            @csrf

            @foreach ($pertanyaan as $key => $item)

            <div class="card my-3">
                <div class="card-header">
                    <label for="">{{ $key + 1 }}. {{ $item->nama_pertanyaan }}</label>
                </div>
                <div class="card-body">
                    @error('responses.'. $key . '.id_opsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if ( $item->jenis_pertanyaan == 'direct-answer' )
                    <input type="text" name="responses[{{ $key }}][id_opsi]" class="form-control">
                    <input type="hidden" name="responses[{{ $key }}][id_pertanyaan]" value="{{ $item->id }}">
                    <input type="hidden" name="responses[{{ $key }}][id_alumni]" value="{{$history->id_alumni}}">

                    @elseif ( $item->jenis_pertanyaan == 'multiple-choice')
                    <ul class="list-group">
                        @foreach ($item->opsi as $opsi)
                        <label for="opsi{{ $opsi->id }}">
                        <li class="list-group-item">
                            <input type="radio" class="mr-2" name="responses[{{ $key }}][id_opsi]"
                            {{ old('responses.'. $key . '.id_opsi') == $opsi->id ? 'checked' : ''}}
                            id="opsi{{ $opsi->id }}" value="{{ $opsi->id }}">
                            {{ $opsi->nama_opsi }}
                            <input type="hidden" name="responses[{{ $key }}][id_pertanyaan]" value="{{ $item->id }}">
                        </li>
                        </label>
                        <input type="hidden" name="responses[{{ $key }}][id_alumni]" value="{{$history->id_alumni}}">
                        @endforeach
                    </ul>


                    @else
                    <ul class="list-group">
                        @foreach ($item->opsi as $opsi)
                        <label for="opsi{{ $opsi->id }}">
                        <li class="list-group-item">
                            <input type="checkbox" class="mr-2" name="responses[{{ $key }}][id_opsi][]"
                            id="opsi{{ $opsi->id }}" value="{{ $opsi->id }}">
                            {{ $opsi->nama_opsi }}
                            <input type="hidden" name="responses[{{ $key }}][id_pertanyaan]" value="{{ $item->id }}">
                        </li>
                        </label>
                        <input type="hidden" name="responses[{{ $key }}][id_alumni]" value="{{$history->id_alumni}}">
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
