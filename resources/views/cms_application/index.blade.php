@extends('layouts.app')

@section('content')
    <v-container
            fluid
    >
        <v-btn href="{{ route('cms-applications.create') }}" color="primary">
            Создать
        </v-btn>
        <v-row
                align="start"
                justify="center"
        >
            <v-col
                    cols="12"
            >
                <v-simple-table>
                    <template v-slot:default>
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
                                    <a target="_blank" href="{{ $app->url }}">
                                        {{ $app->url }}
                                    </a>
                                </td>
                                <td>
                                    <cms-app-status url="{{ $app->url }}" app-key="{{ $app->app_key }}" dusk="cms-app-status"></cms-app-status>
                                </td>
                                <td>
                                    <v-btn small color="primary" class="my-1" href="{{ route('cms-applications.show', ['cms_application' => $app->id]) }}">Подробнее</v-btn>
                                    <v-btn small color="info" class="my-1" href="{{ route('cms-applications.edit', ['cms_application' => $app->id]) }}">Редактировать</v-btn>
                                    <form action="{{ route('cms-applications.destroy', ['cms_application' => $app->id]) }}" class="d-inline-block" method="post">
                                        @method('delete')
                                        @csrf
                                        <v-btn small color="error" class="my-1" type="submit">Удалить</v-btn>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($apps) == 0)
                            <tr>
                                <td colspan="5" class="text-center">Нет данных</td>
                            </tr>
                        @endif
                        </tbody>
                    </template>
                </v-simple-table>
            </v-col>
        </v-row>
    </v-container>

{{--<div class="container">--}}
    {{--<div class="row py-2">--}}
        {{--<div class="col-12">--}}
            {{--<a href="{{ route('cms-applications.create') }}" class="btn btn-primary">Добавить</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-12">--}}
            {{--<table class="table table-striped">--}}
                {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th scope="col">#</th>--}}
                        {{--<th scope="col">Название</th>--}}
                        {{--<th scope="col">URL</th>--}}
                        {{--<th scope="col">Статус</th>--}}
                        {{--<th scope="col">Действия</th>--}}
                    {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($apps as $app)--}}
                    {{--<tr>--}}
                        {{--<th scope="row">{{ $app->id }}</th>--}}
                        {{--<td>{{ $app->name }}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{ $app->url }}">--}}
                                {{--{{ $app->url }}--}}
                            {{--</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<cms-app-status url="{{ $app->url }}" app-key="{{ $app->app_key }}" dusk="cms-app-status"></cms-app-status>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<a class="btn btn-primary" href="{{ route('cms-applications.show', ['cms_application' => $app->id]) }}">Подробнее</a>--}}
                            {{--<a class="btn btn-info" href="{{ route('cms-applications.edit', ['cms_application' => $app->id]) }}">Редактировать</a>--}}
                            {{--<form action="{{ route('cms-applications.destroy', ['cms_application' => $app->id]) }}" method="post">--}}
                                {{--@method('delete')--}}
                                {{--@csrf--}}
                                {{--<button class="btn btn-danger" type="submit">Удалить</button>--}}
                            {{--</form>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
                {{--@if(count($apps) == 0)--}}
                    {{--<tr>--}}
                        {{--<td colspan="5" class="text-center">Нет данных</td>--}}
                    {{--</tr>--}}
                {{--@endif--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
