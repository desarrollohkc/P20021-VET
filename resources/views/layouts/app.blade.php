<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PosteAuditor') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        {{-- Chart JS--}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        {{-- End Chart JS--}}
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">

            @include('layouts.header')

            <main class="my-4">
                <div class="container">
                    @include('flash-message')
                </div>

                @yield('content')
            </main>
        </div>
    </body>
</html>
<script>
    $('.custom-file-input').on('change',function(){
        var fileName = document.getElementById("csv_url").files[0].name;
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
