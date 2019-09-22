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
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
@endsection
