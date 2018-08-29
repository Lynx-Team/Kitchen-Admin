@extends('layouts.app')

@section('title', __('mail_setup.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('mail_setup.title') }}</div>
                <div class="card-body row justify-content-center">
                    <form action="{{ route('mail_setup.update') }}" method="POST" class="col-5">
                        @csrf
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.driver') }}</label>
                            <input type="text" class="form-control" name="driver" id="driver" value="{{ $driver }}" placeholder="{{ __('mail_setup.driver') }}" aria-describedby="driver_error">
                            @if($errors->has('driver'))
                                <p id="driver_error" class="form-text text-danger">
                                    {{ $errors->first('driver') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.host') }}</label>
                            <input type="text" class="form-control" name="host" id="host" value="{{ $host }}" placeholder="{{ __('mail_setup.host') }}" aria-describedby="host_error">
                            @if($errors->has('host'))
                                <p id="host_error" class="form-text text-danger">
                                    {{ $errors->first('host') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.port') }}</label>
                            <input type="text" class="form-control" name="port" id="port" value="{{ $port }}" placeholder="{{ __('mail_setup.port') }}" aria-describedby="port_error">
                            @if($errors->has('port'))
                                <p id="port_error" class="form-text text-danger">
                                    {{ $errors->first('port') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.username') }}</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{ $username }}" placeholder="{{ __('mail_setup.username') }}" aria-describedby="username_error">
                            @if($errors->has('username'))
                                <p id="username_error" class="form-text text-danger">
                                    {{ $errors->first('username') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.password') }}</label>
                            <input type="text" class="form-control" name="password" id="password" value="{{ $password }}" placeholder="{{ __('mail_setup.password') }}" aria-describedby="password_error">
                            @if($errors->has('password'))
                                <p id="password_error" class="form-text text-danger">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="">{{ __('mail_setup.encryption') }}</label>
                            <input type="text" class="form-control" name="encryption" id="encryption" value="{{ $encryption }}" placeholder="{{ __('mail_setup.encryption') }}" aria-describedby="encryption_error">
                            @if($errors->has('encryption'))
                                <p id="encryption_error" class="form-text text-danger">
                                    {{ $errors->first('encryption') }}
                                </p>
                            @endif
                        </div>
                        <button type="success" class="row btn btn-warning">{{ __('mail_setup.update_btn') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection