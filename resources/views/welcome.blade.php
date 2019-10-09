<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <section class="landing-top">
                <div class="top-container d-flex justify-content-center align-content-center">
                    <div class="row d-flex justify-content-center align-content-center py-3">
                        <div class="col-12 col-md-5 text-white">
                            <h1 class="landing-top-header">Начните работу с <b>Press Start</b></h1>
                            <p class="landing-top-text">
                                <b>Press Start CMS</b> - простая и минималистичная CMS, которая подходит как для простого блога, так и для создания более сложных сайтов.
                            </p>
                            <p class="landing-top-text">
                                <b>Press Start Platform</b> - облачный сервис для владельцев Press Start CMS и разработчиков плагинов и тем.
                            </p>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="name"
                                                   class="col-form-label text-md-right"><b>{{ __('Имя') }}</b></label>

                                            <div>
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ old('name') }}" required
                                                       autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email"
                                                   class="col-form-label text-md-right"><b>{{ __('E-Mail') }}</b></label>

                                            <div>
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password"
                                                   class="col-form-label text-md-right"><b>{{ __('Пароль') }}</b></label>

                                            <div>
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm"
                                                   class="col-form-label text-md-right"><b>{{ __('Подтвердите пароль') }}</b></label>

                                            <div>
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    {{ __('Зарегистрироваться') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-4" style="min-height: 400px;">
                <div class="container">
                    <div class="row shadow p-3">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills position-sticky" style="top: 1rem;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="nav-info-for-user-tab" data-toggle="pill" href="#nav-info-for-user" role="tab" aria-controls="nav-info-for-user" aria-selected="true">
                                    Для пользователя
                                </a>
                                <a class="nav-link" id="nav-info-for-developer-tab" data-toggle="pill" href="#nav-info-for-developer" role="tab" aria-controls="nav-info-for-developer" aria-selected="false">
                                    Для разработчика
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="nav-info-for-user" role="tabpanel" aria-labelledby="nav-info-for-user-tab">
                                    <p>
                                        <b>PressStart CMS</b> позволяет легко и быстро создать простой блог, а при помощи
                                        плагинов можно создать интернет-магазин или сайт для компании.
                                    </p>
                                    <img src="{{ asset('images/landing-press-start-cms-1.png') }}" class="img-fluid img-thumbnail" alt="PressStart CMS">
                                    <br>
                                    <br>
                                    <p>
                                        <b>PressStart Platform</b> позволяет подключить ваши работающие
                                        PressStart CMS системы и управлять плагинами и темами в них. Вы сможете установить,
                                        обновить или удалить плагин за пару кликов. Так же вы всегда сможете видеть
                                        состояние работы вашего CMS приложения.
                                    </p>
                                    <img src="{{ asset('images/landing-press-start-cms-2.png') }}" class="img-fluid img-thumbnail" alt="PressStart Platform">
                                </div>
                                <div class="tab-pane fade" id="nav-info-for-developer" role="tabpanel" aria-labelledby="nav-info-for-developer-tab">
                                    <b>PressStart Platform</b> позволяет разработчикам загружать и обновлять плаины и темы для PressStart CMS.
                                    <br>
                                    <p>
                                        Для этого нужно лишь указать в вашем профиле название вендора - название компании или псевдоним разработчика,
                                        под которым будут выпускаться его разработки. После указания имени вендора можно сразу загрузить ваш плагин в систему
                                        и он будет доступен широкой публике.
                                    </p>
                                    <img src="{{ asset('images/landing-press-start-cms-3.png') }}" class="img-fluid img-thumbnail" alt="PressStart Platform for developers">
                                    <br>
                                    <br>
                                    <p>
                                        <b>PressStart CMS</b> предоставляет удобный API для разработчиков плагинов и тем,
                                        упрощая взаимодействие с базой данных и другими компонентами системы.
                                    </p>
                                    <img src="{{ asset('images/landing-press-start-cms-4.png') }}" class="img-fluid img-thumbnail" alt="PressStart CMS API">
                                    <br>
                                    <br>
                                    <p>
                                        Продробности в <a href="#">документации</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="mt-3">
                <div class="container-fluid py-3 bg-dark text-white">
                    <div class="row d-flex justify-content-center align-content-center">
                        <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                            <div>
                                PressStart development team © 2019
                            </div>
                        </div>
                        <div class="col-12 col-md-8 d-flex justify-content-end pr-4 align-content-center">
                            <a href="#" class="mr-3">
                                <span class="text-primary mdi mdi-36px mdi-vk"></span>
                            </a>
                            <a href="#">
                                <span class="text-secondary mdi mdi-36px mdi-instagram instagram-gradient"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
