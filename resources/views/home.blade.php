@extends('layouts.app')

@section('title', __('home.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('home.profile_title') }}</div>

                <div class="card-body">
                    <form action="{{ route('users.update_profile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="profile_name">{{ __('home.profile_name') }}</label>
                            <input type="text" class="form-control" name="name" id="profile_name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="profile_email">{{ __('home.profile_email') }}</label>
                            <input type="email" class="form-control" name="email" id="profile_email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="profile_role">{{ __('home.profile_role') }}</label>
                            <input type="text" readonly class="form-control" id="profile_role" value="{{ Auth::user()->role->name }}">
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
                    <form action="{{ route('users.change_password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="profile_old_password">{{ __('home.old_password') }}</label>
                            <input type="password" class="form-control" name="old_password" id="profile_old_password">
                        </div>
                        <div class="form-group">
                            <label for="profile_new_password">{{ __('home.new_password') }}</label>
                            <input type="password" class="form-control" name="new_password" id="profile_new_password">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('home.apply_btn') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
