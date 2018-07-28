@extends('layouts.app')

@section('title', __('item_categories.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('item_categories.add_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('item_categories.create') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col">
                            <label for="new_name">{{ __('item_categories.name') }}</label>
                            <input type="text" class="form-control" name="name" id="new_name" placeholder="{{ __('item_categories.name') }}" aria-describedby="create_name_error">
                            @if($errors->create->has('name'))
                                <p id="create_name_error" class="form-text text-danger">
                                    {{ $errors->create->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="add_user_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_user_btn">{{ __('item_categories.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('item_categories.title') }}</div>
                <div class="card-body">
                    @forelse ($item_categories as $category)
                        <form action="{{ route('item_categories.update') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}" aria-describedby="update_name_error">
                                @if($errors->update->has('name') && $errors->update->first('row_id') == $category->id)
                                    <p id="update_name_error" class="form-text text-danger">
                                        {{ $errors->update->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
                                <a role="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete_{{ $category->id }}').submit();">
                                    {{ __('users.delete_btn') }}
                                </a>
                            </div>
                        </form>
                        <form id="delete_{{ $category->id }}" action="{{ route('item_categories.delete') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                        </form>
                    @empty
                        <p>{{ __('item_categories.no_categories') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
