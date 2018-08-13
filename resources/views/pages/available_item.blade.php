@extends('layouts.app')

@section('title', __('available_item.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('available_item.add_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('available_items.create') }}" method="POST" class="row">
                        @csrf
                        <input type="hidden" name="order_list_id" value="{{ $order_list_id }}">
                        <div class="form-group col">
                            <label for="item">{{ __('available_item.item') }}</label>
                            <select class="form-control" name="item" id="item" aria-describedby="create_item_error">
                                @foreach($all_items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->short_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->create->has('item'))
                                <p id="create_item_error" class="form-text text-danger">
                                    {{ $errors->create->first('item') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="add_available_item_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_available_item_btn">{{ __('available_item.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('items.title') }}</div>
                <div class="card-body">
                    @forelse($items as $item)
                        <form id="delete_{{ $item->id }}" action="{{ route('available_items.delete') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-group col">
                                <input type="text" class="form-control" readonly value="{{ $item->item->short_name }}">
                            </div>
                            <div class="form-group col">
                                <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
                                   data-title="Delete item" data-message="Are you sure you want to delete this item?"
                                   data-form-id="delete_{{ $item->id }}">
                                    {!! __('available_item.delete_btn') !!}
                                </a>
                            </div>
                        </form>
                    @empty
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-warning" role="alert">
                                    {{ __('available_item.empty') }}
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('partials.delete_confirm')
@endsection