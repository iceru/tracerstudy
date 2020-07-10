@extends('layout.adminapp')

@section('title')
Pertanyaan
@endsection

@section('content')
<div class="wrap-input">
    <div class="input-title col-md-10">
        <h2>Hasil Kuesioner</h2>
        <hr>
    </div>

    {{-- <div class="clear pl-3">
        <a href="{{request()->url()}}" class="button-red">Clear Filter</a>
    </div> --}}
    {{--
    <div class="opsi2 d-flex pl-3">
        <div class="fakultas pr-4">
            <div onclick="ddFakultas()" class="wrdd" tabindex="1">
              <span>{{ $fklName }}</span>
              <ul class="dd-item" id="ddfakultas">
                @foreach ($fakultas as $item)
                <li><a href="{{request()->fullUrlWithQuery(['fakultas'=> $item->nama_fakultas])}}">{{ $item->nama_fakultas }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="prodi pr-4">
            <div onclick="ddProdi()" class="wrdd" tabindex="1">
              <span>{{ $prdName }}</span>
              <ul class="dd-item" id="ddprodi">
                @foreach ($prodi as $item)
                <li><a href="{{request()->fullUrlWithQuery(['prodi'=> $item->nama_prodi])}}">{{ $item->nama_prodi }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="lulusan">
            <div onclick="ddLulusan()" class="wrdd" tabindex="1">
              <span>Tahun Kelulusan</span>
              <ul class="dd-item" id="ddlulusan">
                @foreach ($lulusan as $item)
                <li><a href="{{request()->fullUrlWithQuery(['lulusan'=> $item->lulusan])}}">{{ $item->lulusan }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>
    </div> --}}

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
                        @if ($opsi->jawaban->count() == 0 )
                        <p class="data-percentage"> 0 </p>
                        @else
                        <p class="data-percentage"> {{ round(($opsi->jawaban->count() * 100) / $item->jawaban->count(), 2) }} %</p>
                        @endif

                    </li>
                    @endforeach

                </ul>
                @if ($item->jenis_pertanyaan == 'direct-answer')
                @foreach ($item->jawaban->groupby('id_opsi') as $key => $jawaban)
                    <li class="list-group-item d-flex justify-content-between">
                        <label>
                        {{ $key }}
                        </label>
                        @if (count($jawaban) == 0 )
                        <p class="data-percentage"> 0 </p>
                        @else
                        <p class="data-percentage">{{ count($jawaban) }}</p>
                        @endif

                    </li>
                    @endforeach
                @else
                @endif

            </div>
        </div>
        @endforeach


        @foreach ($pertanyaanDa as $keyDa => $item)
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <label for="">{{ $keyDa + $key + 2}}. {{ $item->nama_pertanyaan_da }} </label> <p class="data-percentage"> {{ $item->jawaban->count() }} </p>
            </div>
            <div class="card-body">
                @foreach ($item->jawaban->groupby('jawaban') as $keyJawaban => $jawaban)
                    <li class="list-group-item d-flex justify-content-between">
                        <label>
                        {{ $keyJawaban }}
                        </label>
                        <p class="data-percentage">{{ count($jawaban) }}</p>
                    </li>
                @endforeach
            </div>
        </div>
        @endforeach

        @foreach ($pertanyaanMa as $keyMa => $item)
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <label for="">{{ $keyMa + $keyDa + $key + 3 }}. {{ $item->nama_pertanyaan_ma }} </label> <p class="data-percentage"> {{ $item->jawaban->count() }} </p>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($item->opsiMa as $opsi)
                    <li class="list-group-item d-flex justify-content-between">
                        <label for="opsi{{ $opsi->id }}">
                        <p>{{ $opsi->nama_opsi_ma }}</p>
                        </label>
                        @if ($opsi->jawaban->count() == 0 )
                        <p class="data-percentage"> 0 </p>
                        @else
                        <p class="data-percentage"> {{ round(($opsi->jawaban->count() * 100) / $item->jawaban->count(), 2) }} %</p>
                        @endif
                    </li>
                    @endforeach

                </ul>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('js')
<script>
    function ddProdi() {
    document.getElementById("ddprodi").classList.toggle("showdd");
  }
  </script>

<script>
    function ddFakultas() {
    document.getElementById("ddfakultas").classList.toggle("showdd");
  }
  </script>

<script>
    function ddLulusan() {
    document.getElementById("ddlulusan").classList.toggle("showdd");
  }
</script>
@endsection
