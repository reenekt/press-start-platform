@extends('layouts.app')

@section('content')
    <v-container
            fluid
    >
        <v-row
                align="start"
                justify="center"
        >
            <v-col
                    cols="12"
            >
                <h1>{{ $app->name }}</h1>
                <h4><a href="{{ $app->url }}">{{ $app->url }}</a></h4>
                <h5>
                    <cms-app-status url="{{ $app->url }}" app-key="{{ $app->app_key }}"></cms-app-status>
                </h5>
            </v-col>
        </v-row>
        <v-row
                align="start"
                justify="start"
        >
            <v-col
                    cols="12"
            >
                <v-expansion-panels>
                    <v-expansion-panel>
                        <v-expansion-panel-header>
                            Плагины
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <cms-app-plugin-list cms-app-url="{{ $app->url }}" app-key="{{ $app->app_key }}"></cms-app-plugin-list>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                        <v-expansion-panel-header>
                            Темы
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <work-in-progress></work-in-progress>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-col>
        </v-row>
    </v-container>

{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-12">--}}
            {{--<h1>{{ $app->name }}</h1>--}}
            {{--<h4><a href="{{ $app->url }}">{{ $app->url }}</a></h4>--}}
            {{--<h5>--}}
                {{--<cms-app-status url="{{ $app->url }}" app-key="{{ $app->app_key }}"></cms-app-status>--}}
            {{--</h5>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="row">--}}
        {{--<div class="col-12">--}}
            {{--<div class="accordion" id="accordionExample">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header" id="plugins">--}}
                        {{--<h2 class="mb-0">--}}
                            {{--<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#plugins_content" aria-expanded="true" aria-controls="plugins_content">--}}
                                {{--Плагины--}}
                            {{--</button>--}}
                        {{--</h2>--}}
                    {{--</div>--}}

                    {{--<div id="plugins_content" class="collapse show" aria-labelledby="plugins" data-parent="#accordionExample">--}}
                        {{--<div class="card-body">--}}
                            {{--<cms-app-plugin-list cms-app-url="{{ $app->url }}" app-key="{{ $app->app_key }}"></cms-app-plugin-list>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="card">--}}
                    {{--<div class="card-header" id="themes">--}}
                        {{--<h2 class="mb-0">--}}
                            {{--<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#themes_content" aria-expanded="false" aria-controls="themes_content">--}}
                                {{--Темы--}}
                            {{--</button>--}}
                        {{--</h2>--}}
                    {{--</div>--}}
                    {{--<div id="themes_content" class="collapse" aria-labelledby="themes" data-parent="#accordionExample">--}}
                        {{--<div class="card-body">--}}
                            {{--<work-in-progress></work-in-progress>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
