<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Allow requests to either http and https sites (for accessing http served cms applications) -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @if(env('APP_ENV') !== 'local')
        <script src="{{ secure_asset('js/app.min.js') }}" defer></script>
    @else
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @if(env('APP_ENV') !== 'local')
        <link href="{{ secure_asset('css/app.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @endif

    <!-- Manifest and favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ secure_asset('apple-icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ secure_asset('apple-icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ secure_asset('apple-icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ secure_asset('apple-icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ secure_asset('apple-icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ secure_asset('apple-icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ secure_asset('apple-icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ secure_asset('apple-icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('apple-icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ secure_asset('android-icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="144x144"  href="{{ secure_asset('android-icons/android-icon-144x144.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"  href="{{ secure_asset('android-icons/android-icon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="72x72"  href="{{ secure_asset('android-icons/android-icon-72x72.png') }}">
    <link rel="icon" type="image/png" sizes="48x48"  href="{{ secure_asset('android-icons/android-icon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="36x36"  href="{{ secure_asset('android-icons/android-icon-36x36.png') }}">
    <link rel="manifest" href="{{ secure_asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ secure_asset('ms-icons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<noscript>
    This application uses JavaScript. Please enable JavaScript in your browser's settings
</noscript>
<div id="app">
    <app app-name="{{ config('app.name', 'Laravel') }}">
        <template v-slot:sidebar>
            <v-list dense>
                <v-list-item href="{{ route('dashboard') }}">
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item href="{{ route('cms-applications.index') }}">
                    <v-list-item-action>
                        <v-icon>mdi-view-agenda</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>CMS приложения</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-group
                        prepend-icon="mdi-view-grid-plus" {{-- view-grid-plus  ||  shopping_outline --}}
                        :value="false"
                >
                    <template v-slot:activator>
                        <v-list-item-title>Marketplace</v-list-item-title>
                    </template>

                    <v-list-item href="{{ route('cms-plugins.index') }}">
                        <v-list-item-action>
                            <v-icon>mdi-shape-polygon-plus</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Плагины</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item href="{{ route('work-in-progress') }}">
                        <v-list-item-action>
                            <v-icon>mdi-buffer</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Темы</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>

            </v-list>
        </template>

        <template v-slot:content>
            @yield('content')
        </template>

        <template #app_top_right_menu="slotProps">
            <v-menu
                    left
                    bottom
            >
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-icon>mdi-account-circle</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item
                            href="{{ route('profile') }}"
                    >
                        <v-list-item-title>Профиль</v-list-item-title>
                    </v-list-item>
                    <v-list-item
                            @click="slotProps.logoutSubmit"
                    >
                        <v-list-item-title>Выход</v-list-item-title>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </v-list-item>
                </v-list>
            </v-menu>
        </template>
    </app>
</div>

<script>
    // Check that service workers are supported
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .catch(function (error) {
                // registration failed :(
                console.group('ServiceWorker registration failed: ');
                console.log(error)
                console.groupEnd()
            });
        });
    }
</script>

</body>
</html>
