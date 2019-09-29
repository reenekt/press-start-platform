@extends('layouts.app')

@section('content')
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
