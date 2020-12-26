<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="/image/untarputih.png" alt="">
    </div>
    <div class="sidebar-admin d-flex">
        {{-- <div class="image">
            <img src="/image/default.png" class="rounded-circle" alt="">
        </div> --}}
        <div class="name">
            <h5>Navigation</h5>
        </div>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="/"><i class="fas fa-home fa-fw"></i> &nbsp; Dashboards</a>
        </li>
        <li>
            <a href="{{ route('fakultas.index') }}"><i class="fas fa-university fa-fw"></i> &nbsp; Fakultas</a>
        </li>
        <li>
            <a href="{{ route('prodi.index') }}"><i class="fas fa-school fa-fw"></i> &nbsp; Program Studi</a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.index') }}"><i class="fa fa-user fa-fw" aria-hidden="true"></i> &nbsp; Lulusan</a>
        </li>



        <li>
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle"><i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i> &nbsp; Data Alumni</a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                <li>
                    <a href="{{ route('sektor.index') }}"><i class="fa fa-building fa-fw" aria-hidden="true"></i> &nbsp; Sektor Perusahaan</a>
                </li>
                <li>
                    <a href="{{ route('perusahaan.index') }}"><i class="fas fa-building fa-fw"></i> &nbsp; Perusahaan</a>
                </li>
                <li>
                    <a href="{{ route('jabatan.index') }}"><i class="fa fa-briefcase fa-fw" aria-hidden="true"></i> &nbsp; Jabatan</a>
                </li>
                <li>
                    <a href="{{ route('alumni.index') }}"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Tracing Alumni</a>
                </li>
                <li>
                    <a href="{{ route('pekerjaan.index') }}"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Pekerjaan Alumni</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle"><i class="fas fa-poll fa-fw"></i> &nbsp; Kuesioner</a>
            <ul class="collapse list-unstyled" id="pageSubmenu1">
                <li>
                    <a href="{{ route('kuesioner.index') }}"><i class="fas fa-poll-h fa-fw"></i> &nbsp; Data Kuesioner</a>
                </li>
                @can('data-create')
                <li>
                    <a href="{{ route('pertanyaan.create') }}"> <i class="fas fa-question-circle fa-fw"></i> &nbsp; Pertanyaan</a>
                </li>
                <li>
                    <a href="{{ route('opsi.create') }}"> <i class="fa fa-check-square fa-fw" aria-hidden="true"></i> &nbsp; Opsi Pertanyaan</a>
                </li>
                @endcan
            </ul>
        </li>
        {{-- <li>
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle"><i class="fa fa-file fa-fw" aria-hidden="true"></i> &nbsp; Laporan</a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li>
                    <a href="{{ route('jarak.haversine') }}">Laporan Jarak QS Stars</a>
                </li>
                <li>
                    <a href="{{ route('kuesioner.hasil') }}">Hasil Kuesioner</a>
                </li>
                <li>
                    <a href="{{ route('laporan.jabatan') }}">Jabatan dan Perusahaan Alumni</a>
                </li>

                <li>
                    <a href="{{ route('laporan.indexChartBidang') }}">Laporan Alumni Berdasarkan Kesesuaian Bidang Pekerjaan</a>
                </li>

                <li>
                    <a href="{{ route('laporan.indexChartWaktuPekerjaan') }}">Laporan Alumni Berdasarkan Waktu Mendapatkan Pekerjaan</a>
                </li>

                <li>
                    <a href="{{ route('laporan.tahunKelulusan') }}">Laporan Alumni Berdasarkan Tahun Kelulusan</a>
                </li>

                <li>
                    <a href="">Laporan Tingkat Kepuasan Alumni Terhadap Program Studi.</a>
                </li>
            </ul>
        </li> --}}

        <li><a href="{{ route('laporan.index') }}"><i class="fa fa-file fa-fw" aria-hidden="true"></i> &nbsp; Laporan Tracer Study</a></li>

        @can ('role-edit')
        <li>
            <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle blue"><i class="fas fa-users fa-fw"></i> &nbsp; Users & Roles</a>
            <ul class="collapse list-unstyled" id="pageSubmenu4">
                <li>
                    <a href="{{ route('users.index') }}">Users</a>
                </li>
                @can('role-create')
                <li>
                    <a href="{{ route('roles.index') }}">Roles</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @cannot ('role-edit')
        <li>
            <a class="blue" href="{{ route('users.index') }}"><i class="fas fa-users fa-fw"></i> &nbsp; Users</a>
        </li>
        @endcannot

        <li>
            <a class="red" href="{{ route('alumni.create') }}"><i class="fas fa-globe fa-fw"></i> &nbsp; Page Tracer Study</a>
        </li>

        <li>
            <a class="red" href="{{ route('logout') }}"  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-fw"></i> &nbsp;
             {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>


</nav>
