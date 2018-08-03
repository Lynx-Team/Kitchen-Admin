@extends('layouts.app')

@section('title', $kitchen->name)

@section('main')
    @if(empty($order_lists))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('kitchen.empty_order_list') }}
                </div>
            </div>
        </div>
    @elseif(!$grouped)
        @foreach($order_lists as $order_list)
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-3">
                    <a href="#list-{{ $order_list->id }}" class="list-group-item" data-toggle="collapse" role="button">
                        <i class="fas fa-chevron-right"></i>
                        {{ $order_list->note }}
                        <span class="badge badge-primary badge-pill">{{ count($order_list->order_list_items) }}</span>
                    </a>
                    <div class="list-group collapse" id="list-{{ $order_list->id }}">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col small">{{ __('kitchen.short_name') }}</div>
                                <div class="col small">{{ __('kitchen.supplier') }}</div>
                                <div class="col small">{{ __('kitchen.cost') }}</div>
                                <div class="col small">{{ __('kitchen.quantity') }}</div>
                                <div class="col small">{{ __('kitchen.supplier_sort_order') }}</div>
                                <div class="col small">{{ __('kitchen.kitchen_sort_order') }}</div>
                                <div class="col small">{{ __('kitchen.completed') }}</div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        @foreach($order_list->order_list_items as $item)
                            <div class="list-group-item">
                                @include('components.kitchen_form')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @elseif($grouped)
        @foreach($order_lists as $order_list)

        @endforeach
    @endif
@endsection

@section('js')
    <script>
        $(function() {
            $('.list-group-item').on('click', function() {
                $('.fas', this).toggleClass('fa-chevron-right').toggleClass('fa-chevron-down');
            });
        });
    </script>
@endsection