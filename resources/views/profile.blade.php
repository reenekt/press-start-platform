@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Профиль
                        </h3>
                        <div class="card-text">
                            <form action="{{ url()->current() }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">
                                        Имя пользователя
                                    </label>
                                    <input class="form-control" value="{{ $user->name }}" type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        e-mail
                                    </label>
                                    <input class="form-control" value="{{ $user->email }}" type="email" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_name">
                                        Имя вендора
                                    </label>
                                    <input class="form-control" value="{{ $user->vendor_name }}" type="text" name="vendor_name" id="vendor_name">
                                    <small class="form-text text-muted">
                                        Можно указать название компании / команды разработчиков. По этому имени можно будет
                                        найти плагины, которые вы загрузили
                                    </small>
                                </div>
                                <button class="btn btn-primary">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
