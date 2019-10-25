@extends('layouts.app')

@section('content')
    <v-container class="fill-height">
        <v-row
                align="start"
                justify="center"
        >
            <v-col
                    cols="12"
                    md="8"
            >
                <form action="{{ route('cms-applications.store') }}" method="post">
                    @csrf

                    <v-card>

                        <v-card-title class="d-flex justify-center">
                            <span>Редактирование CMS приложения</span>
                        </v-card-title>

                        <v-card-text>
                            <v-text-field
                                    label="Название"
                                    name="name"
                                    prepend-icon="mdi-account"
                                    type="text"
                                    @error('name')
                                        error
                                        :rules="[(value)=>{return '{{ $message }}'}]"
                                    @enderror
                                    :persistent-hint="true"
                                    hint="Название приложения в вашем аккаунте на платформе. Можно назвать как угодно."
                                    value="{{ $app->name }}"
                            ></v-text-field>

                            <v-text-field
                                    label="URL приложения"
                                    name="url"
                                    prepend-icon="mdi-account"
                                    type="text"
                                    @error('url')
                                        error
                                        :rules="[(value)=>{return '{{ $message }}'}]"
                                    @enderror
                                    :persistent-hint="true"
                                    hint="URL (домен) приложения."
                                    value="{{ $app->url }}"
                            ></v-text-field>

                            <v-text-field
                                    label="Ключ приложения"
                                    name="app_key"
                                    prepend-icon="mdi-account"
                                    type="text"
                                    @error('app_key')
                                        error
                                        :rules="[(value)=>{return '{{ $message }}'}]"
                                    @enderror
                                    :persistent-hint="true"
                                    hint="Ключ должен совпадать с ключом, указанным в самой CMS. Ключ указывается в .env файле в параметре PLATFORM_APP_KEY"
                                    value="{{ $app->app_key }}"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-actions class="d-flex justify-center">
                            <v-btn type="submit" color="primary">Сохранить</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-col>
        </v-row>
    </v-container>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('cms-applications.update', ['cms_application' => $app]) }}" method="post">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Название</label>
                    <input value="{{ $app->name }}" type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Моя Лучшая CMS">
                    <small id="nameHelp" class="form-text text-muted">Название приложения в вашем аккаунте на платформе. Можно назвать как угодно.</small>
                </div>
                <div class="form-group">
                    <label for="url">URL приложения</label>
                    <input value="{{ $app->url }}" type="url" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="http://my-best-cms.net">
                    <small id="urlHelp" class="form-text text-muted">URL (домен) приложения.</small>
                </div>
                <div class="form-group">
                    <label for="app_key">Ключ приложения</label>
                    <input value="{{ $app->app_key }}" type="text" class="form-control" id="app_key" name="app_key" aria-describedby="app_keyHelp" placeholder="Любая последовательность символов">
                    <small id="app_keyHelp" class="form-text text-muted">
                        Ключ должен совпадать с ключом, указанным в самой CMS.
                        <button type="button" class="btn btn-sm btn-link" data-container="body" data-toggle="popover" data-placement="top"
                                data-content="Ключ указывается в .env файле в параметре PLATFORM_APP_KEY">
                            Подробнее
                        </button>
                    </small>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
@endsection
