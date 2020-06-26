<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js" integrity="sha256-+Q/z/qVOexByW1Wpv81lTLvntnZQVYppIL1lBdhtIq0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <main>
        <div class="wrapper">
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
                        <a href="{{ route('mahasiswa.index') }}"><i class="fa fa-user fa-fw" aria-hidden="true"></i> &nbsp; Mahasiswa</a>
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
                                <a href="{{ route('alumni.index') }}"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Alumni</a>
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
                            <li>
                                <a href="{{ route('pertanyaan.create') }}"> <i class="fas fa-question-circle fa-fw"></i> &nbsp; Pertanyaan</a>
                            </li>
                            <li>
                                <a href="{{ route('opsi.create') }}"> <i class="fa fa-check-square fa-fw" aria-hidden="true"></i> &nbsp; Opsi Pertanyaan</a>
                            </li>
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
                        <a class="blue" href="{{ route('users.index') }}">Users</a>
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
            <div class="content">
                <nav class="navbar navbar-expand-sm navbar-dark">
                    <div class="name mr-auto d-flex align-items-center">
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <h5>Tracer Study Universitas Tarumanagara</h5>
                    </div>
                    <div class="admin-name">
                        <h5>{{ Auth::user()->name }} </h5>
                        <p>{!! str_replace(str_split('[""]'), '', Auth::user()->getRoleNames() ) !!}</p>
                    </div>
                </nav>
                <div class="main">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    @yield ('js')

    <script>
        $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('activesidebar');
        });

        });
    </script>

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



</body>


</html>
