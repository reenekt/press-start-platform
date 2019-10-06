@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h3 class="card-title">
                        CMS приложения
                    </h3>
                    <div class="card-text">
                        Подключено к платформе: {{ $apps->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Плагины
                    </h3>
                    <div class="card-text">
                        Создано: {{ $plugins->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
