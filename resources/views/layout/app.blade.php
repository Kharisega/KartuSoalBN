<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/dash.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dash.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-dark" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-dark text-light">Kartu Soal</div>
                <hr>
                <div class="list-group list-group-flush">
                    @if(Auth::user()->roles[0]['name'] == 'admin')
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Dashboard</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('guru.index') }}">Data Guru</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('mapel.index') }}">Data Mata Pelajaran</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('kelas.index') }}">Data Kelas</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('jurusan.index') }}">Data Kompetensi Keahlian</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('kode.index') }}">Data Kompetensi Dasar</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('kognitif.index') }}">Data Aspek Kognitif</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Log Out</a>
                    @elseif(Auth::user()->roles[0]['name'] == 'guru')
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Dashboard</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Profil Guru</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{ route('kartu.index') }}">Kartu Soal</a>
                        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Log Out</a>
                    @endif
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
