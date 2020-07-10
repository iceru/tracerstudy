@extends('layout.app')

@section('content')
<div class="alumni">
    <div class="alumni-title">
        <h1>Tracer Study Universitas Tarumanagara</h1>
    </div>
    <div class="alumni-left">
        <form action="alumni/store/{id}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nomor Induk Mahasiswa</label>
                <select class="form-control" data-live-search="true" name="NIM" id="NIM">
                    <option>NIM</option>
                    @foreach ($mahasiswa as $item)
                    <option data-tokens="{{ $item->nama_mhs }}" value="{{ $item->NIM }}">{{ $item->NIM }} - {{ $item->nama_mhs }}</option>
                    @endforeach
                </select>
                <small id="helpId"> <button type="button" class="btn"
                    data-toggle="modal" data-target="#alumniinput">Tidak menemukan Nama/NIM?</button>
                </small>
            </div>

            <div class="form-group ">
                <label for="" >Email Aktif</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="form-group ">
                <label for="">No. Handphone Aktif</label>
                <input class="form-control" type="text" name="no_hp" id="no_hp">
            </div>

            <div class="form-group ">
                <button type="submit" class="button-red">Selanjutnya</button>
            </div>
        </form>

        <div class="modal fade" id="alumniinput" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Alumni</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('mahasiswa.storealumni')}}" method="post">
                          @csrf
                          <div class="form-group">
                              <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                              <input type="text" class="form-control" name="NIM" id="NIM" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                              <label for="nama">Nama Anda</label>
                              <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                              <label for="tgl_yudisium">Tanggal Yudisium / Lulus</label>
                              <input type="text" name="tgl_yudisium" id="idTourDateDetails" class="form-control clsDatePicker">
                          </div>

                          <div class="form-group">
                              <label for="ipk">IPK</label>
                              <input type="text" class="form-control" name="ipk" id="ipk" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                              <label for="">Program Studi</label>
                              <select class="form-control" name="id_prodi" id="id_prodi">
                                  @foreach ($prodi as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                  @endforeach
                              </select>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="button-red">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="alumni-right">
        <h4>Selamat Datang di Laman Tracer Study Universitas Tarumanagara</h3>
        <p>Terima kasih sudah mengunjungi laman ini dan turut berpartisipasi dalam melakukan pengisian data anda.</p>
    </div>
</div>
@endsection

@section('js')
@endsection
