@extends('layouts.base')

@section('title', __('auth.auth_form_title'))

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="text-danger">{{ __('exceptions.403') }}</h1>
            </div>
        </div>
    </div>
@endsection
