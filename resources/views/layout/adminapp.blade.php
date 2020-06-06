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
</head>

<body>
    <main>
        <div class="wrapper">
            <nav class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <img src="/image/untar.png" alt="">
                </div>
                <div class="sidebar-admin d-flex">
                    {{-- <div class="image">
                        <img src="/image/default.png" class="rounded-circle" alt="">
                    </div> --}}
                    <div class="name">
                        <h4>Hello, {{ Auth::user()->name }}</h4>
                        <p class="small"> {!! str_replace(str_split('[""]'), '', Auth::user()->getRoleNames() ) !!}</p>
                    </div>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="{{ route('fakultas.index') }}">Fakultas</a>
                    </li>
                    <li>
                        <a href="{{ route('prodi.index') }}">Program Studi</a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                    </li>



                    <li>
                        <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Data Alumni</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu3">
                            <li>
                                <a href="{{ route('sektor.index') }}">Sektor Perusahaan</a>
                            </li>
                            <li>
                                <a href="{{ route('perusahaan.index') }}">Perusahaan</a>
                            </li>
                            <li>
                                <a href="{{ route('jabatan.index') }}">Jabatan</a>
                            </li>
                            <li>
                                <a href="{{ route('alumni.index') }}">Alumni</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Kuesioner</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu1">
                            <li>
                                <a href="{{ route('kuesioner.index') }}">Data Kuesioner</a>
                            </li>
                            <li>
                                <a href="{{ route('opsi.create') }}">Opsi Kuesioner</a>
                            </li>
                            <li>
                                <a href="{{ route('pertanyaan.create') }}">Pertanyaan Kuesioner</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Laporan</a>
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
                        </ul>
                    </li>

                    @can ('role-edit')
                    <li>
                        <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle blue">Users & Roles</a>
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
                        <a class="red" href="{{ route('logout') }}"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>


            </nav>
            <div class="content">
                <div class="main">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    @yield ('js')
</body>

</html>
