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
                    md="4"
            >
                <v-card
                    color="blue darken-1"
                    dark
                >
                    <v-card-title>
                        CMS приложения
                    </v-card-title>
                    <v-card-text>
                        Подключено к платформе: {{ $apps->count() }}
                    </v-card-text>
                </v-card>
            </v-col>

            <v-col
                    cols="12"
                    md="4"
            >
                <v-card>
                    <v-card-title>
                        Плагины
                    </v-card-title>
                    <v-card-text>
                        Создано: {{ $plugins->count() }}
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
@endsection
