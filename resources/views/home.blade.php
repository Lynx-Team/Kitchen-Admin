@extends('layouts.app')

@section('title', __('home.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('home.profile_title') }}</div>

                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="profile_name">{{ __('home.profile_name') }}</label>
                            <input type="text" class="form-control" id="profile_name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="profile_email">Email address</label>
                            <input type="email" class="form-control" id="profile_email" value="{{ Auth::user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('home.apply_btn') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('home.change_password_title') }}</div>
                <div class="card-body">
                    <form action="/">
                        @csrf
                        <div class="form-group">
                            <label for="profile_old_password">{{ __('home.old_password') }}</label>
                            <input type="password" class="form-control" id="profile_old_password">
                        </div>
                        <div class="form-group">
                            <label for="profile_new_password">{{ __('home.new_password') }}</label>
                            <input type="password" class="form-control" id="profile_new_password">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('home.apply_btn') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
