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
                            <input type="text" class="form-control" name="name" id="profile_name" value="{{ Auth::user()->name }}" aria-describedby="name_error">
                            @if($errors->profile->has('name'))
                                <p id="name_error" class="form-text text-danger">
                                    {{ $errors->profile->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="profile_email">{{ __('home.profile_email') }}</label>
                            <input type="email" class="form-control" name="email" id="profile_email" value="{{ Auth::user()->email }}" aria-describedby="email_error">
                            @if($errors->profile->has('email'))
                                <p id="email_error" class="form-text text-danger">
                                    {{ $errors->profile->first('email') }}
                                </p>
                            @endif
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
                            <input type="password" class="form-control" name="old_password" id="profile_old_password" aria-describedby="old_password_error">
                            @if($errors->change_password->has('old_password'))
                                <p id="old_password_error" class="form-text text-danger">
                                    {{ $errors->change_password->first('old_password') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="profile_new_password">{{ __('home.new_password') }}</label>
                            <input type="password" class="form-control" name="new_password" id="profile_new_password" aria-describedby="new_password_error">
                            @if($errors->change_password->has('new_password'))
                                <p id="new_password_error" class="form-text text-danger">
                                    {{ $errors->change_password->first('new_password') }}
                                </p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('home.apply_btn') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
