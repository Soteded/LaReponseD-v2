<?php
    use App\Profile;
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/e8767330e3.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/darkmode.css') }}" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('home-form').submit();">
                                        {{ __('Home') }}
                                    </a>
                                    <form id="home-form" action="{{ route('home') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (Auth::check())
        <?php
            $id = Auth::user()->id;
            $profile = Profile::where('id', $id)->first();
        ?>
        <div class="page-wrapper chiller-theme">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fas fa-bars"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">La RÃ©ponse D</a>
                    <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                        alt="User picture">
                    </div>
                    <div class="user-info">
                    <span class="user-name">
                        <span class="firstName">{{ $profile->firstName }}</span>
                        <span class="lastName">{{ $profile->lastName }}</span>
                    </span>
                    <span class="user-role"></span>
                    <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="">
                            <a href="{{ route('home') }}">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Home</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                            <i class="fas fa-user-friends"></i>
                            <span>Profile</span>
                            </a>
                            <div class="sidebar-submenu">
                            <ul>
                                <li>
                                @hasrole('Admin')
                                <a class="dropdown-item fas fa-user" href="{{ route('index') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('index-form').submit();">
                                    {{ __('All Profiles') }}
                                </a>
                                <form id="index-form" action="{{ route('index') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                                @endhasrole
                                </li>
                                <li>
                                <a class="dropdown-item" href="{{ url('profiles/'.Auth::id()) }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('show-form').submit();">
                                    {{ __('Profile') }}
                                </a>
                                <form id="show-form" action="{{ url('profiles/'.Auth::id()) }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                                </li>
                                <li>
                                <a class="dropdown-item" href="{{ route('edit') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('edit-form').submit();">
                                    {{ __('Edit Profile') }}
                                </a>
                                <form id="edit-form" action="{{ route('edit') }}" method="EDIT" style="display: none;">
                                    @csrf
                                </form>
                                </li>
                            </ul>
                            </div>
                        </li>
                        <li class="header-menu">
                            <span>Quizz</span>
                        </li>
                        <li class="">
                            <a href="{{ route('allQuizs') }}">
                            <i class="fas fa-question-circle"></i>
                            <span>Tous les quizz</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('/') }}">
                            <i class="fas fa-question-circle"></i>
                            <span>Categories</span>
                            </a>
                        </li>
                        <?php
                            $categories = DB::table('quiz')->select('theme')->distinct()->get();
                            $array = json_decode(json_encode($categories), true);
                            foreach ($array as $oui) {?>
                                <li class="">
                                    <a href="{{ url('/quiz/categorie/'.$oui['theme']) }}">
                                    <i class="fas fa-question-circle"></i>
                                    <span class="badge badge-pill badge-success notification">
                                        <?php
                                            $count = DB::table('quiz')->select(DB::raw('count(*) as count'))->groupBy('theme')->where('theme','LIKE',$oui['theme'])->get();
                                            $count = json_decode(json_encode($count), true);
                                            echo $count[0]["count"];
                                        ?>
                                    </span>
                                    <span>{{ $oui["theme"] }}</span>
                                    </a>
                                </li>
                            <?php
                            }
                        ?>
                        <li class="header-menu">
                            <span>Créer son quizz</span>
                        </li>
                        <li class="">
                            <a href="{{ route('createQuiz') }}">
                            <i class="fas fa-plus"></i>
                            <span>Ici</span>
                            </a>
                        </li>
                        <li class="header-menu">
                            <span>DarkMode</span>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fas fa-moon"></i>
                            <label class="switch">
                                <input id="dark-mode-toggle" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                <div class="sidebar-footer">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
            </nav>
            <!-- sidebar-wrapper  -->
            <main class="container py-4">
                @yield('content')
            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->
        @else
            <main class="container py-4">
                @yield('content')
            </main>
        @endif
    </div>
    </body>
</html>