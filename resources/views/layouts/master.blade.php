<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Quickly Upload and Send Files">

        <link rel="icon" href="../../favicon.ico">

        <title>@yield('title')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('scripts.top')

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">

            <div class="container">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>


                    </button>
                    <a class="navbar-brand" href="#">{{ env('APP_TITLE') }}</a>

                </div>

                <div id="navbar" class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">
                        <li class="{{ (Request::url() == route('home.index') ? 'active' : null) }}"><a href="{{ route('home.index') }}">Home</a></li>
                    </ul>

                </div>

            </div>

        </nav>

        <div class="container">

            @yield('content')

        </div>

    </body>

    <script src="{{ asset('js/all.js') }}"></script>

    @include('layouts.flash')

    @yield('scripts.bottom')

</html>
