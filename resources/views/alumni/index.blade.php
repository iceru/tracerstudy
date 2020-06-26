@extends('layout.adminapp')

@section('title')
Opsi
@endsection

@section('content')
<div class="wrap-input">

    <div class="input-title">
        <h2>Data Alumni</h2>
        <hr>
    </div>

    <div class="dua d-flex justify-content-between">
        <div class="button-create">
            <a href="{{ route('alumni.input') }}" class="button-red">Create Data Alumni</a>
        </div>

        <div class="clear">
            @if(request()->fullurl() != request()->url())
            <a href="{{request()->url()}}" class="button-red">Clear Filter</a>
            @endif
        </div>
    </div>


    <div class="opsi d-flex">
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

    </div>



    <div class="output-data">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alumni</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th>Nomor Handphone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnis as $alumni)
                <tr>
                    <td scope="row">{{ ($alumnis ->currentpage()-1) * $alumnis ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $alumni->mahasiswa->nama_mhs }}</td>
                    <td>{{ $alumni->NIM }}</td>
                    <td>{{ $alumni->mahasiswa->prodi->nama_prodi }}</td>
                    <td>{{ $alumni->mahasiswa->prodi->fakultas->nama_fakultas }}</td>
                    <td>{{ $alumni->no_hp}}</td>
                    <td>{{ $alumni->email}}</td>
                    <td id="action">
                        <a href="{{ route('alumni.edit', $alumni->id) }}"><i class="fas fa-edit    "></i>  Edit </a>
                        <form action="{{ route('alumni.destroy', $alumni->id )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{ $alumnis->links() }}

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
