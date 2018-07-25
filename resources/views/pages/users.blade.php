@extends('layouts.app')

@section('title', __('users.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('users.title') }}</div>

                <div class="card-body">
                    @forelse ($users as $user)
                        <form action="/" class="row">
                            @csrf
                            <div class="form-group col">
                                <input type="text" class="form-control" id="profile_name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col">
                                <input type="email" class="form-control" id="profile_email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group col">
                                <input type="text" readonly class="form-control" id="profile_role" value="{{ $user->role->name }}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('users.delete_btn') }}</button>
                            </div>
                        </form>
                    @empty
                        <p>No users</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
