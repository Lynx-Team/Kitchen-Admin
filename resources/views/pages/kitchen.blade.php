@extends('layouts.app')

@section('title', $kitchen->name)

@section('main')
    <div class="row justify-content-center mb-2">
        <div class="col-md-10">
            <div class="row justify-content-around">
                <a href="{{ route('kitchen.view', ['kitchen_id' => $kitchen->id]) }}" class="col-3 btn btn-primary" role="button">
                    {{ __('kitchen.simple_view') }}
                </a>
                <a href="{{ route('kitchen.view', ['kitchen_id' => $kitchen->id]) . '?grouped=true' }}" class="col-3 btn btn-primary" role="button">
                    {{ __('kitchen.group_by_category_view') }}
                </a>
            </div>
        </div>
    </div>
    @if(empty($rows))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('kitchen.empty_order_list') }}
                </div>
            </div>
        </div>
    @elseif(!$grouped)
        @php($i = 0)
        @while($i < count($rows))
            @php($cur_order_list_id = $rows[$i]->id)
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-3">
                    @include('partials.order_list_header')
                    <div class="list-group collapse" id="list-{{ $rows[$i]->id }}">
                        <div class="list-group-item">
                            <div class="row">
                                {{--                                @include('partials.order_list_item_fields_create')--}}
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            {{--                            @include('partials.order_list_item_form_create')--}}
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                {{--@if(count($order_list->order_list_items) != 0)--}}
                                {{--                                    @include('partials.order_list_item_fields_update', ['item' => $order_list->order_list_items[0]])--}}
                                {{--@endif--}}
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        @while($i < count($rows) && $rows[$i]->id == $cur_order_list_id)
                            <div class="list-group-item">
                                {{$rows[$i]->note}}
                                {{--@include('partials.order_list_item_form_update')--}}
                                <form id="delete_{{ $rows[$i]->order_list_item_id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $rows[$i]->order_list_item_id }}">
                                </form>
                            </div>
                            @php($i++)
                        @endwhile
                    </div>
                </div>
            </div>
        @endwhile
    @elseif($grouped)
        {{--@foreach($order_lists as $order_list)--}}
        {{--<div class="row justify-content-center">--}}
        {{--<div class="list-group list-group-root well col-md-10 mb-3">--}}
        {{--@include('partials.order_list_header')--}}
        {{--<div class="list-group collapse" id="list-{{ $order_list->id }}">--}}
        {{--<div class="list-group-item">--}}
        {{--<div class="row">--}}
        {{--<div class="col small">{{ __('kitchen.short_name') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.supplier') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.cost') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.quantity') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.supplier_sort_order') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.kitchen_sort_order') }}</div>--}}
        {{--<div class="col small">{{ __('kitchen.completed') }}</div>--}}
        {{--<div class="col small"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@php($items = $order_list->order_list_items)--}}
        {{--@php($current_category = null)--}}
        {{--@php($i = 0)--}}
        {{--@while($i < count($items))--}}
        {{--<a href="#category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}" class="list-group-item" data-toggle="collapse" role="button">--}}
        {{--<i class="fas fa-chevron-right"></i>--}}
        {{--{{ $items[$i]->item->category->name }}--}}
        {{--</a>--}}
        {{--<div class="list-group collapse" id="category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}">--}}
        {{--@php($current_category = $items[$i]->item->category->name)--}}
        {{--@while($i < count($items) && $current_category == $items[$i]->item->category->name)--}}
        {{--<div class="list-group-item">--}}
        {{--{{ $items[$i]->id }}--}}
        {{--</div>--}}
        {{--@php($i++)--}}
        {{--@endwhile--}}
        {{--</div>--}}
        {{--@endwhile--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
    @endif
@endsection

@section('js')
    @include('partials.delete_confirm')
    <script>
        $(function() {
            $('.collapse-href').on('click', function() {
                $('.fas', this).toggleClass('fa-chevron-right').toggleClass('fa-chevron-down');
            });
        });
    </script>
@endsection