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
                            <input type="text" class="form-control" name="name" id="new_name" placeholder="Login">
                        </div>
                        <div class="form-group col">
                            <label for="new_email">{{ __('home.profile_email') }}</label>
                            <input type="email" class="form-control" name="email" id="new_email" placeholder="test@test.com">
                        </div>
                        <div class="form-group col">
                            <label for="new_password">{{ __('users.password') }}</label>
                            <input type="password" class="form-control" name="password" id="new_password">
                        </div>
                        <div class="form-group col">
                            <label for="new_role">{{ __('home.profile_role') }}</label>
                            <select class="form-control" name="role" id="new_role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
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
                    @forelse ($users as $user)
                        <form action="{{ route('users.update') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group col">
                                <select class="form-control" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id === $user->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
                                <a role="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete_{{ $user->id }}').submit();">
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
