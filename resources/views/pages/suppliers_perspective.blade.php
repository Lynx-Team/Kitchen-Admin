@extends('layouts.app')

@section('title', $supplier->name)

@section('main')
    <div class="row justify-content-center mb-2">
        <div class="col-md-10">
            <div class="row justify-content-around">
                <a href="{{ route('suppliers_perspective.view', ['supplier_id' => $supplier->id]) }}" class="col-3 btn btn-primary" role="button">
                    {{ __('kitchen.simple_view') }}
                </a>
                <a href="{{ route('suppliers_perspective.view', ['supplier_id' => $supplier->id]) . '?grouped=true' }}" class="col-3 btn btn-primary" role="button">
                    {{ __('kitchen.group_by_category_view') }}
                </a>
            </div>
        </div>
    </div>
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
                    @include('partials.order_list_header')
                    <div class="list-group collapse" id="list-{{ $order_list->id }}">
                        <div class="list-group-item">
                            <div class="row">
                                @if(count($order_list->order_list_items) != 0)
                                    @include('partials.order_list_item_fields_update', ['item' => $order_list->order_list_items[0]])
                                @endif
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        @foreach($order_list->order_list_items as $item)
                            <div class="list-group-item">
                                @include('partials.order_list_item_form_update')
                                <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @elseif($grouped)
        @foreach($order_lists as $order_list)
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-3">
                    @include('partials.order_list_header')
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
                        @php($items = $order_list->order_list_items)
                        @php($current_category = null)
                        @php($i = 0)
                        @while($i < count($items))
                            <a href="#category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}" class="list-group-item" data-toggle="collapse" role="button">
                                <i class="fas fa-chevron-right"></i>
                                {{ $items[$i]->item->category->name }}
                            </a>
                            <div class="list-group collapse" id="category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}">
                                @php($current_category = $items[$i]->item->category->name)
                                @while($i < count($items) && $current_category == $items[$i]->item->category->name)
                                    <div class="list-group-item">
                                        {{ $items[$i]->id }}
                                    </div>
                                    @php($i++)
                                @endwhile
                            </div>
                        @endwhile
                    </div>
                </div>
            </div>
        @endforeach
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