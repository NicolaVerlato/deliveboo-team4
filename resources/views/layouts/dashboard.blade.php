<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!--HEADER-->
    <nav class="navbar navbar-expand-md navbar-dark flex-md-nowrap p-2 brand_color">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/"><strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
        </a>
        <ul class="navbar-nav px-3 ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <strong>Logout</strong>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!--SIDEBAR Dashboard-->
    <div class="container-fluid">
        <div class="row">
            <nav class="left_menu col-md-2 d-none d-md-block sidebar py-4">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.home') }}">
                                <i class="fa-solid fa-house big_icon"></i>
                                Dashboard
                            </a>
                        </li>
                        @if (!isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.restaurants.create') }}">
                                    <i class="fa-solid fa-square-plus big_icon"></i>
                                    Crea ristorante
                                </a>
                            </li>
                        @endif

                        @if (isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.restaurants.index') }}">
                                    <i class="fa-solid fa-utensils big_icon"></i>
                                    Il mio ristorante
                                </a>
                            </li>
                        @endif
                            
                        @if (isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.dishes.index') }}">
                                    <i class="fa-solid fa-bowl-food big_icon"></i>
                                    Lista piatti
                                </a>
                            </li>
                        @endif
                        
                        @if (isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.dishes.create') }}">
                                    <i class="fa-solid fa-circle-plus big_icon"></i>
                                    Aggiungi piatto
                                </a>
                            </li>
                        @endif
                        @if (isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.stats.index') }}">
                                    <i class="fa-solid fa-chart-simple big_icon"></i>
                                    Statistiche
                                </a>
                            </li>
                        @endif
                        @if (isset($restaurantLink))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.chartjs.index') }}">
                                    <i class="fa-solid fa-chart-simple big_icon"></i>
                                    Grafico Statistiche
                                </a>
                            </li>
                        @endif
                    </ul>
                    
                </div>
            </nav>

            <!--MAIN-->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/create.js') }}"></script>
</body>
</html>