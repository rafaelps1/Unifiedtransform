<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('css/welcome.css') }}">
    </head>
    <body id="gradient">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="m-b-md">
                    <!-- {{config('app.name')}} -->
                    <img src="appname.svg" width="500">
                </div>
                <!-- <p style="font-size: 25px;">@lang('Makes managing schools an amazing experience')</p> -->
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">@lang('Home')</a>
                        @else
                            <a href="{{ route('login') }}">@lang('Login')</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        <script src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
        <script src="{{ url('js/welcome.js') }}"></script>
    </body>
</html>
