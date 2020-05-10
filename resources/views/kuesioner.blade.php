@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
    <div class="alumni-left">
        <form action="" method="post">
            @csrf
            @foreach ($pertanyaan as $item)
            <div class="form-group">
                <label for="">{{ $item->nama_pertanyaan }}</label>
                @foreach ($opsi as $item)
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="" id="" value="checkedValue">
                    {{ $item->nama_opsi }}
                </label>
                </div>
                @endforeach
            </div>
            @endforeach

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
