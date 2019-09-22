@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-12">
            <a href="{{ route('cms-applications.create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">URL</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($apps as $app)
                    <tr>
                        <th scope="row">{{ $app->id }}</th>
                        <td>{{ $app->name }}</td>
                        <td>
                            <a href="{{ $app->url }}">
                                {{ $app->url }}
                            </a>
                        </td>
                        <td>
                            <cms-app-status url="{{ $app->url }}"></cms-app-status>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('cms-applications.show', ['cms_application' => $app->id]) }}">Подробнее</a>
                            <a class="btn btn-info" href="{{ route('cms-applications.edit', ['cms_application' => $app->id]) }}">Редактировать</a>
                            <form action="{{ route('cms-applications.destroy', ['cms_application' => $app->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @if(count($apps) == 0)
                    <tr>
                        <td colspan="4" class="text-center">Нет данных</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
