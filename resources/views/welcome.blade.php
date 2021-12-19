<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        
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
         <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs"><button type="button" class="btn btn-primary">Docs</button></a>
                    <a href="https://laracasts.com"><button type="button" class="btn btn-secondary">Laracasts</button></a>
                    <a href="https://laravel-news.com"><button type="button" class="btn btn-success">News</a></button>
                    <a href="https://blog.laravel.com"><button type="button" class="btn btn-warning">Blog</a></button>
                    <a href="https://nova.laravel.com"><button type="button" class="btn btn-danger">Nova</a></button>
                    <a href="https://forge.laravel.com"><button type="button" class="btn btn-info">Forge</a></button>
                    <a href="https://vapor.laravel.com"><button type="button" class="btn btn-dark">Vapor</a></button>
                    <a href="https://github.com/laravel/laravel"><b-button variant="outline-primary">GitHub</a></b-button>
                </div>
            </div>
        </div>
    </body>
</html>
