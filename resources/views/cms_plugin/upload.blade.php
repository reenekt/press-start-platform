@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Upload plugin</div>

                <div class="card-body">
                    <plugin-zip-uploader submit-url="{{ route('cms-plugins.store') }}"></plugin-zip-uploader>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
