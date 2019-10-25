@extends('layouts.app-centered-content')

@section('content')
    <v-card class="elevation-12">
        <v-toolbar
                color="primary"
                dark
        >
            <v-spacer></v-spacer>
            <v-toolbar-title>Регистрация</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <form id="loginForm" action="{{ route('register') }}" method="post">
            <v-card-text>
                @csrf

                <v-text-field
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
                        label="E-mail"
                        name="email"
                        prepend-icon="mdi-account"
                        type="text"
                        @error('email')
                        error
                        :rules="[(value)=>{return '{{ $message }}'}]"
                        @enderror
                ></v-text-field>

                <v-text-field
                        id="password"
                        label="Пароль"
                        name="password"
                        prepend-icon="mdi-lock"
                        type="password"
                        @error('password')
                        error
                        :rules="[(value)=>{return '{{ $message }}'}]"
                        @enderror
                ></v-text-field>

                <v-text-field
                        id="password"
                        label="Подтвердите пароль"
                        name="password_confirmation"
                        prepend-icon="mdi-lock"
                        type="password"
                ></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn text small href="{{ route('login') }}">У меня уже есть аккаунт</v-btn>
                <v-spacer></v-spacer>
                <v-btn type="submit" color="primary">Зарегистрировать</v-btn>
            </v-card-actions>
        </form>
    </v-card>

{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Register') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('register') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

                                {{--@error('name')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

                                {{--@error('email')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

                                {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Register') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
