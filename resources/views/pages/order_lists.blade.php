@extends('layouts.app')

@section('title', __('order_lists.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('order_lists.add_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('order_lists.create') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col">
                            <label for="new_note">{{ __('order_lists.note') }}</label>
                            <input type="text" class="form-control" name="note" id="new_note" placeholder="{{ __('order_lists.note') }}" aria-describedby="create_note_error">
                            @if($errors->create->has('note'))
                                <p id="create_note_error" class="form-text text-danger">
                                    {{ $errors->create->first('note') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="new_kitchen">{{ __('order_lists.kitchen') }}</label>
                            <select class="form-control" name="kitchen" id="new_kitchen" aria-describedby="create_kitchen_error">
                                @foreach($kitchens as $kitchen)
                                    <option value="{{ $kitchen->id }}">
                                        {{ $kitchen->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->create->has('kitchen'))
                                <p id="create_kitchen_error" class="form-text text-danger">
                                    {{ $errors->create->first('kitchen') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="add_order_list_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_order_list_btn">{{ __('order_lists.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('order_lists.title') }}</div>
                <div class="card-body">
                    @forelse ($order_lists as $order_list)
                        <form action="{{ route('order_lists.update') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $order_list->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="note" value="{{ $order_list->note }}" placeholder="{{ __('order_lists.note') }}" aria-describedby="update_note_error">
                                @if($errors->update->has('note') && $errors->update->first('row_id') == $order_list->id)
                                    <p id="update_note_error" class="form-text text-danger">
                                        {{ $errors->update->first('note') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <select class="form-control" name="kitchen" aria-describedby="update_kitchen_error">
                                    @foreach($kitchens as $kitchen)
                                        <option value="{{ $kitchen->id }}" {{ $order_list->kitchen_id == $kitchen->id ? 'selected' : '' }}>
                                            {{ $kitchen->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->update->has('kitchen') && $errors->update->first('row_id') == $order_list->id)
                                    <p id="update_kitchen_error" class="form-text text-danger">
                                        {{ $errors->update->first('kitchen') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-check col">
                                <input type="checkbox" class="form-check-input" name="completed" id="update_completed" aria-describedby="update_completed_error" {{ $order_list->completed ? 'checked' : '' }}>
                                <label class="form-check-label" for="update_completed">{{ __('order_lists.completed') }}</label>
                                @if($errors->update->has('completed') && $errors->update->first('row_id') == $order_list->id)
                                    <p id="update_completed_error" class="form-text text-danger">
                                        {{ $errors->update->first('completed') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <button type="submit" class="btn btn-warning">{{ __('order_lists.update_btn') }}</button>
                                <a role="button" class="btn btn-danger"  data-toggle="modal" data-target="#confirmDelete"
                                   data-title="Delete order list" data-message="Are you sure you want to delete this order list?"
                                   data-form-id="delete_{{ $order_list->id }}">
                                    {{ __('order_lists.delete_btn') }}
                                </a>
                            </div>
                        </form>
                        <form id="delete_{{ $order_list->id }}" action="{{ route('order_lists.delete') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $order_list->id }}">
                        </form>
                    @empty
                        <p>{{ __('order_lists.no_order_lists') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('partials.delete_confirm')
@endsection
