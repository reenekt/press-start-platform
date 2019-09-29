@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>{{ $plugin->package }}</h1>
            <h4>{{ $plugin->vendor }}</h4>
            <h5>Последняя версия: {{ $plugin->version }}</h5>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($apps as $app)
                            <div class="col-4">
                                {{--<div class="card">--}}
                                    {{--<div class="card-body">--}}
                                        {{--<h5 class="card-title">{{ $app->name }}</h5>--}}
                                        {{--<h5 class="card-subtitle">--}}
                                            {{--<a href="{{ $app->url }}">{{ $app->url }}</a>--}}
                                        {{--</h5>--}}

                                        {{--<div>--}}
                                            {{--<p class="card-text">--}}
                                                {{--Плагин не установлен в CMS--}}
                                            {{--</p>--}}
                                            {{--<div class="mt-3 d-flex justify-content-center">--}}
                                                {{--<a href="#" class="btn btn-primary">Установить</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div>--}}
                                            {{--<p class="card-text">--}}
                                                {{--Текущая версия <span class="badge badge-pill badge-warning">0.0.1</span><br>--}}
                                                {{--Есть более новая версия <span class="badge badge-pill badge-success">0.0.2</span>--}}
                                            {{--</p>--}}
                                            {{--<div class="mt-3 d-flex justify-content-center">--}}
                                                {{--<a href="#" class="btn btn-primary">Обновить</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div>--}}
                                            {{--<p class="card-text">--}}
                                                {{--Установлена самая новая версия <span class="badge badge-pill badge-success">0.0.2</span>--}}
                                            {{--</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <install-plugin-card app-name="{{ $app->name }}"
                                                     app-url="{{ $app->url }}"
                                                     latest-version="{{ $plugin->version }}"
                                                     plugin-vendor="{{ $plugin->vendor }}"
                                                     plugin-package="{{ $plugin->package }}"
                                                     app-key="{{ $app->app_key }}"
                                ></install-plugin-card>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
