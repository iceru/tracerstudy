@extends('layout.adminapp')

@section('title')
Mahasiswa
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        Upload Validation Error <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="wrap-input">

    <div class="input-title">
        <h2>Data Mahasiswa</h2>
        <hr>
    </div>

    <div class="dua d-flex justify-content-between">
        <div class="button-create">
            <a href="{{ route('mahasiswa.create') }}" class="button-red">Create Data Mahasiswa</a>
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
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal Yudisium</th>
                        <th>IPK</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $item)
                    <tr>
                        <td scope="row">{{ ($mahasiswa ->currentpage()-1) * $mahasiswa ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $item->NIM }}</td>
                        <td>{{ $item->nama_mhs }}</td>
                        <td>{{ $item->tgl_yudisium }}</td>
                        <td>{{ $item->ipk }}</td>
                        <td>{{ $item->prodi->nama_prodi }}</td>
                        <td>{{ $item->prodi->fakultas->nama_fakultas }}</td>
                        <td id="action">
                            <a href="{{ route('mahasiswa.edit', $item->NIM) }}"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $item->NIM )}}" method="get">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mahasiswa->links() }}
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

