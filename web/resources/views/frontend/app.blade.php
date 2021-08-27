<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="storage-url" content="{{ url('storage/') }}">
    <base href="{{url('/')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- google fonts icon -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title')</title>
    @stack('style')
  </head>
  <body>
        <div id="app">
            <header class="mb-3">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{route('frontend.home')}}">Shopinvest</a>
                        </div>
                        <div class="account-cart d-flex align-items-center">
                            <div class="account ">
                                @if (!Auth::check())
                                    <a href="{{route('login.index')}}" class=" d-flex align-items-center">
                                        <span>Login</span>
                                        <span class="material-icons ps-1">login</span>
                                    </a>
                                @else
                                    <a href="{{route('user.logout')}}" class=" d-flex align-items-center">
                                        <span class="pe-1">{{Auth::user()->name}}</span>
                                        <span class="material-icons">logout</span>
                                    </a>
                                @endif
                            </div>
                            <div class="minicart">
                                <div class=" d-flex align-items-center">
                                    <span>My cart</span>
                                    <span class="material-icons ps-1">shopping_basket</span>
                                </div>
                                @include('frontend.includes.minicart')

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <ul id="movieList"></ul>
                @yield('content')
            </div>
            <footer class="text-center">
                Copyright &copy; {{date('Y')}} Shopinvest
            </footer>
        </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://borismoore.github.io/jquery-tmpl/jquery.tmpl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        window.listProducts = {!!json_encode($viewProducts)!!};
    </script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    @stack('script')
  </body>
</html>
