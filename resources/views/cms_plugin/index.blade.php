@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-12">
            <a href="{{ route('cms-plugins.upload') }}" class="btn btn-primary">Загрузить</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="form-inline my-2" action="{{ url()->current() }}" method="get">
                <div class="form-group mx-2">
                    <label class="mr-2" for="filter">Поиск по</label>
                    <select class="form-control" name="filter" id="filter">
                        <option value="-1" disabled {{ !$filter ? 'selected' : '' }}>Выберите фильтр</option>
                        <option {{ $filter == 'vendor' ? 'selected' : '' }} value="vendor">Вендор</option>
                        <option {{ $filter == 'package' ? 'selected' : '' }} value="package">Пакет</option>
                    </select>
                </div>
                <div class="form-group mx-2">
                    <label class="mr-3" for="value">=</label>
                    <input value="{{ $filter_value }}" class="form-control" type="text" name="value" id="value">
                </div>
                <button class="btn btn-primary" type="submit">Поиск</button>
                <a href="{{ url()->current() }}" class="ml-2 btn btn-outline-info">Показать все</a>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Вендор</th>
                        <th scope="col">Пакет (плагин)</th>
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
                @endforeach
                </tbody>
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
