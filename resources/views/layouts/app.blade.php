<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Bunk's") }}</title>

    <!-- Scripts -->


    <!-- Fonts -->


    <!-- Styles -->

    <link rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}" media="screen,projection" />
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">--}}
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}" >
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css') }}">




    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.css')}}">
    <style>
        nav ul.right-side{

            float: right;
        }
       /* .right-side{
            text-align: right !important;
        }*/
    </style>
    @yield('css')
</head>
<body>
{{-- style="float: right; text-align: right; list-style: none" --}}
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', "Bunk's") }}
                </a>
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>--}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{--<ul class="navbar-nav mr-auto">

                    </ul>--}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav right-side">{{--mr-auto--}}
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">{{-- aria-haspopup="true" aria-expanded="false" v-pre--}}
                                    <b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</b>
                                </a>

                                <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
{{--<script src="{{asset('materialize/js/materialize.min.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/admin.js')}}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
    @if(Illuminate\Support\Facades\Session::has('success'))
    toastr.success("{{Illuminate\Support\Facades\Session::get('success')}}");
    @endif

    @if(Illuminate\Support\Facades\Session::has('info'))
    toastr.info("{{Illuminate\Support\Facades\Session::get('info')}}");
    @endif

</script>
    @yield('scripts')
</body>
</html>
