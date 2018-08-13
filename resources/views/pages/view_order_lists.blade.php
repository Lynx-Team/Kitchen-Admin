@extends('layouts.app')

@section('title', __('view_order_lists.title'))

@section('main')
    @forelse($order_lists as $order_list)
        <div class="row justify-content-center mb-2">
            <div class="card col-10">
                <div class="card-body row">
                    <div class="col-8">
                        <h5>
                            {{ $order_list->note }}
                            <span class="badge badge-primary badge-pill">Items: {{ $order_list->order_list_items_count}}</span>
                        </h5>
                    </div>
                    <div class="col-2">
                        @if(\Illuminate\Support\Facades\Auth::user()->can('view', \App\AvailableItem::class))
                            <a href="{{ route('available_item.view', ['kitchen_id' => Request::segment(2),'order_list_id' => $order_list->id]) }}" class="btn btn-primary">
                                Available items
                            </a>
                        @endif
                    </div>
                    <div class="col-2">
                        <a href="#" class="btn btn-success">
                            Items
                        </a>
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
