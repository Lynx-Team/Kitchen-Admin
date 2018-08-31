@extends('layouts.app')

@section('title', __('users.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('users.add_user_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('users.create') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col">
                            <label for="new_name">{{ __('home.profile_name') }}</label>
                            <input type="text" class="form-control" name="name" id="new_name" placeholder="{{ __('home.profile_name') }}" aria-describedby="create_name_error">
                            @if($errors->create_user->has('name'))
                                <p id="create_name_error" class="form-text text-danger">
                                    {{ $errors->create_user->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="new_email">{{ __('home.profile_email') }}</label>
                            <input type="email" class="form-control" name="email" id="new_email" placeholder="test@test.com" aria-describedby="create_email_error">
                            @if($errors->create_user->has('email'))
                                <p id="create_email_error" class="form-text text-danger">
                                    {{ $errors->create_user->first('email') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="new_password">{{ __('users.password') }}</label>
                            <input type="password" class="form-control" name="password" id="new_password" aria-describedby="create_password_error">
                            @if($errors->create_user->has('password'))
                                <p id="create_password_error" class="form-text text-danger">
                                    {{ $errors->create_user->first('password') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="role">{{ __('home.profile_role') }}</label>
                            <select class="form-control" name="role" id="role" aria-describedby="create_role_error">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->create_user->has('role'))
                                <p id="create_role_error" class="form-text text-danger">
                                    {{ $errors->create_user->first('role') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="add_user_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_user_btn">{{ __('users.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('users.title') }}</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">{{ __('home.profile_name') }}</div>
                        <div class="col">{{ __('home.profile_email') }}</div>
                        <div class="col">{{ __('home.profile_role') }}</div>
                        <div class="col">{{ __('users.password') }}</div>
                        <div class="col"></div>
                    </div>
                    @forelse ($users as $user)
                        <form action="{{ route('users.update') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" aria-describedby="update_name_error">
                                @if($errors->update_user->has('name') && $errors->update_user->first('row_id') == $user->id)
                                    <p id="update_name_error" class="form-text text-danger">
                                        {{ $errors->update_user->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" aria-describedby="update_email_error">
                                @if($errors->update_user->has('email')  && $errors->update_user->first('row_id') == $user->id)
                                    <p id="update_email_error" class="form-text text-danger">
                                        {{ $errors->update_user->first('email') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <select class="form-control" name="role" aria-describedby="update_role_error">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id === $user->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->update_user->has('role')  && $errors->update_user->first('row_id') == $user->id)
                                    <p id="update_role_error" class="form-text text-danger">
                                        {{ $errors->update_user->first('role') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <input type="password" class="form-control" name="password" aria-describedby="update_password_error">
                                @if($errors->update_user->has('password')  && $errors->update_user->first('row_id') == $user->id)
                                    <p id="update_password_error" class="form-text text-danger">
                                        {{ $errors->update_user->first('password') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
                                <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
                                   data-title="Delete user" data-message="Are you sure you want to delete this user?"
                                   data-form-id="delete_{{ $user->id }}">
                                    {{ __('users.delete_btn') }}
                                </a>
                            </div>
                        </form>
                        <form id="delete_{{ $user->id }}" action="{{ route('users.delete') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        </form>
                    @empty
                        <p>No users</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('partials.delete_confirm')
@endsection
