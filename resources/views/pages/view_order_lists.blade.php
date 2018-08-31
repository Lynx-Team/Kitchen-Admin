@extends('layouts.app')

@section('title', __('view_order_lists.title'))

@section('main')
    <div class="row justify-content-center mb-2">
        <div class="col-10" style="text-align: center;">
            <h1>{{ $kitchen->name }}</h1>
        </div>
    </div>
    @if(Auth::user()->can('create', \App\OrderList::class))
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                        <input type="hidden" name="kitchen_id" value="{{ Request::segment(2) }}">
                        <div class="form-group col">
                            <label for="add_order_list_btn">&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control" id="add_order_list_btn">{{ __('order_lists.add_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @forelse($order_lists as $order_list)
        <div class="row justify-content-center mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-9">
                            <h5>
                                @if(Auth::user()->can('update', $order_list))
                                    <form id="update_{{ $order_list->id }}" method="POST" action="{{ route('order_lists.update') }}" class="row">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order_list->id }}">
                                        <input type="hidden" name="kitchen_id" value="{{ $order_list->kitchen_id }}">
                                        <div class="form-group col-5">
                                            <input type="text" name="note" class="form-control" value="{{ $order_list->note }}">
                                        </div>
                                        <div class="col-2">
                                            <span class="badge badge-primary badge-pill">Items: {{ $order_list->order_list_items_count}}</span>
                                        </div>
                                    </form>
                                @else
                                {{ $order_list->note }}
                                    <span class="badge badge-primary badge-pill">Items: {{ $order_list->order_list_items_count}}</span>
                                @endif
                            </h5>
                        </div>
                        <form id="delete_{{ $order_list->id }}" method="POST" action="{{ route('order_lists.delete') }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $order_list->id }}">
                        </form>
                        <div class="col-3">
                            <a href="{{ route('order_list_items.view', ['kitchen_id' => Request::segment(2), 'order_list_id' => $order_list->id]) }}" class="btn btn-success">
                                View
                            </a>
                            @if(Auth::user()->can('update', $order_list))
                                <a class="btn btn-warning"
                                   onclick="event.preventDefault();document.getElementById('update_{{ $order_list->id }}').submit();">
                                    Update
                                </a>
                            @endif
                            @if(Auth::user()->can('delete', $order_list))
                                <a class="btn btn-danger"
                                   data-toggle="modal" data-target="#confirmDelete"
                                   data-title="Delete order list" data-message="Are you sure you want to delete this order list?"
                                   data-form-id="delete_{{ $order_list->id }}">
                                    Delete
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('view_order_lists.empty') }}
                </div>
            </div>
        </div>
    @endforelse
@endsection

@section('js')
    @include('partials.delete_confirm')
@endsection
