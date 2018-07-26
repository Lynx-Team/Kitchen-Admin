@extends('layouts.app')

@section('title', __('suppliers.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('suppliers.add_supplier_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('suppliers.create') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col">
                            <label for="new_name">{{ __('suppliers.name') }}</label>
                            <input type="text" class="form-control" name="name" id="new_name" placeholder="Login">
                        </div>
                        <div class="form-group col">
                            <label for="new_email">{{ __('suppliers.email') }}</label>
                            <input type="email" class="form-control" name="email" id="new_email" placeholder="test@test.com">
                        </div>
                        <div class="form-group col">
                            <label for="add_user_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_user_btn">{{ __('suppliers.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('suppliers.title') }}</div>
                <div class="card-body">
                    @forelse ($suppliers as $supplier)
                        <form action="{{ route('suppliers.update') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="name" value="{{ $supplier->name }}">
                            </div>
                            <div class="form-group col">
                                <input type="email" class="form-control" name="email" value="{{ $supplier->email }}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
                                <a role="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete_{{ $supplier->id }}').submit();">
                                    {{ __('users.delete_btn') }}
                                </a>
                            </div>
                        </form>
                        <form id="delete_{{ $supplier->id }}" action="{{ route('suppliers.delete') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                        </form>
                    @empty
                        <p>{{ __('suppliers.no_suppliers') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
