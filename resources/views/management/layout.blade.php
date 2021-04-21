<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        @push('scripts')
        <script src="/packages/plat/frontend-vuejs/js/vue.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vuetify.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/axios.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vue-moment.min.js"></script>
        @endpush
        @stack('scripts')
        
        <link href="/packages/plat/frontend-vuejs/css/vuetify.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"/>
        <script src="https://unpkg.com/http-vue-loader"></script>
        

        <title>@yield('title')</title>

        <style>
            * {
                font-family: "Roboto";
            }
        </style>

        @yield('head')
    </head>

    <body>
        @yield('body')
    </body>
</html>