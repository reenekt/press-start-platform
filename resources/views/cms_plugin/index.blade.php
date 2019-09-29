@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-12">
            <a href="{{ route('cms-plugins.upload') }}" class="btn btn-primary">Загрузить</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Vendor</th>
                        <th scope="col">Package</th>
                        <th scope="col">Версия</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($plugins as $plugin)
                    <tr>
                        <td>{{ $plugin->vendor }}</td>
                        <td>{{ $plugin->package }}</td>
                        <td>{{ $plugin->version }}</td>
                        <td>
                            <a class="btn btn-primary" {{--target="_blank"--}} href="{{ route('cms-plugins.show', ['cms_plugin' => $plugin->id]) }}">Установить</a>
                            <a class="btn btn-light" target="_blank" href="{{ route('cms-plugins.download', ['cms_plugin' => $plugin->id]) }}">Скачать (zip)</a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @if(count($plugins) == 0)
                    <tr>
                        <td colspan="5" class="text-center">Нет данных</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
