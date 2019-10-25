@extends('layouts.app')

@section('content')
    <v-container
            {{--class="fill-height"--}}
            fluid
    >
        <v-row
                align="start"
                justify="center"
        >
            <v-col
                    cols="12"
                    md="6"
            >
                <v-card>
                    <v-toolbar
                            color="primary"
                            dark
                    >
                        <v-spacer></v-spacer>
                        <v-toolbar-title>Профиль</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <form id="loginForm" action="{{ url()->current() }}" method="post">
                            <v-card-text>
                                @csrf

                                <v-text-field
                                        value="{{ $user->name }}"
                                        label="Имя пользователя"
                                        name="name"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        @error('name')
                                            error
                                            :rules="[(value)=>{return '{{ $message }}'}]"
                                        @enderror
                                ></v-text-field>

                                <v-text-field
                                        value="{{ $user->email }}"
                                        label="E-mail"
                                        name="email"
                                        prepend-icon="mdi-at"
                                        type="text"
                                        @error('email')
                                            error
                                            :rules="[(value)=>{return '{{ $message }}'}]"
                                        @enderror
                                ></v-text-field>

                                <v-text-field
                                        value="{{ $user->vendor_name }}"
                                        id="vendor_name"
                                        label="Имя вендора"
                                        name="vendor_name"
                                        prepend-icon="mdi-puzzle-outline"
                                        type="text"
                                        @error('vendor_name')
                                            error
                                            :rules="[(value)=>{return '{{ $message }}'}]"
                                        @enderror
                                        :persistent-hint="true"
                                        hint="Можно указать название компании / команды разработчиков. По этому имени можно будет найти плагины, которые вы загрузили"
                                ></v-text-field>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" color="primary">Сохранить</v-btn>
                            </v-card-actions>
                        </form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body">--}}
                        {{--<h3 class="card-title">--}}
                            {{--Профиль--}}
                        {{--</h3>--}}
                        {{--<div class="card-text">--}}
                            {{--<form action="{{ url()->current() }}" method="post">--}}
                                {{--@csrf--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="name">--}}
                                        {{--Имя пользователя--}}
                                    {{--</label>--}}
                                    {{--<input class="form-control" value="{{ $user->name }}" type="text" name="name" id="name">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="email">--}}
                                        {{--e-mail--}}
                                    {{--</label>--}}
                                    {{--<input class="form-control" value="{{ $user->email }}" type="email" name="email" id="email">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="vendor_name">--}}
                                        {{--Имя вендора--}}
                                    {{--</label>--}}
                                    {{--<input class="form-control" value="{{ $user->vendor_name }}" type="text" name="vendor_name" id="vendor_name">--}}
                                    {{--<small class="form-text text-muted">--}}
                                        {{--Можно указать название компании / команды разработчиков. По этому имени можно будет--}}
                                        {{--найти плагины, которые вы загрузили--}}
                                    {{--</small>--}}
                                {{--</div>--}}
                                {{--<button class="btn btn-primary">Сохранить</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
