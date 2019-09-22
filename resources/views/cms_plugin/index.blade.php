@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-12">
            <a href="{{ route('cms-plugins.create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Package</th>
                        <th scope="col">Название</th>
                        <th scope="col">Версия</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($plugins as $plugin)
                    <tr>
                        <th scope="row">{{ $plugin->id }}</th>
                        <td>{{ $plugin->vendor }}</td>
                        <td>{{ $plugin->package }}</td>
                        <td>{{ $plugin->short_name }}</td>
                        <td><span class="badge badge-warning">TODO</span></td>
                        <td>
                            <a class="btn btn-light" target="_blank" href="{{ route('cms-plugins.download', ['cms_plugin' => $plugin->id]) }}">Скачать</a>
                            {{--<a class="btn btn-primary" href="{{ route('cms-plugins.show', ['cms_plugin' => $plugin->id]) }}">Подробнее</a>--}}
                            {{--<a class="btn btn-info" href="{{ route('cms-plugins.edit', ['cms_plugin' => $plugin->id]) }}">Редактировать</a>--}}
                            {{--<form action="{{ route('cms-plugins.destroy', ['cms_plugin' => $plugin->id]) }}" method="post">--}}
                                {{--@method('delete')--}}
                                {{--@csrf--}}
                                {{--<button class="btn btn-danger" type="submit">Удалить</button>--}}
                            {{--</form>--}}
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @if(count($plugins) == 0)
                    <tr>
                        <td colspan="6" class="text-center">Нет данных</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
