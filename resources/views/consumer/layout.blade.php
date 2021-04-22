@inject('bar', 'Plat\Foundation\Frontend\Bar')
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @push('scripts')
        <script src="/packages/plat/frontend-vuejs/js/vue.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vuetify.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/axios.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vue-moment.min.js"></script>
    @endpush
    @stack('scripts')

    <link href="/packages/plat/frontend-vuejs/css/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    @yield('head')
</head>

<body>
    <v-app id="app">
        @section('app-bar')
            <v-app-bar app dark color="{{ $bar->getColor() }}">
                @foreach ($bar->getItems() as $side => $items)
                    @foreach ($items as $item)
                        <v-btn href="{{ $item['url'] }}" text>
                            @if (!empty($item['icon']))
                                <v-icon left>{{ $item['icon'] }}</v-icon>
                            @endif
                            {{ $item['title'] }}
                        </v-btn>
                    @endforeach

                    @if ($side != 'right')
                        <v-spacer></v-spacer>
                    @endif
                @endforeach

                @auth
                    <v-btn onclick="event.preventDefault();document.getElementById('logout-form').submit();" text>登出</v-btn>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
            </v-app-bar>
        @show
        <v-content>
            <v-container fluid>
                @yield('content')
            </v-container>
        </v-content>
        <v-footer>
            @yield('footer')
        </v-footer>
    </v-app>
    @yield('vuejs-components')
    @yield('vuejs-instance')
</body>

</html>
