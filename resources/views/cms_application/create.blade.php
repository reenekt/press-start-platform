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
                            <span>Добавление CMS приложения</span>
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
@endsection
