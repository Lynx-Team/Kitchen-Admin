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
            @php($items = $order_list->order_list_items)
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-3">
                    @include('partials.order_list_header', ['order_list' => $order_list])
                    <div class="list-group collapse" id="list-{{ $order_list->id }}">
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_create')
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            @include('partials.order_list_item_form_create', ['order_list_id' => $order_list->id,
                                    'all_items' => $all_items, 'suppliers' => $suppliers, 'errors' => $errors])
                        </div>
                        @if(count($items) == 0)
                            @continue
                        @endif
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_update', ['item' => $items[0]])
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        @foreach($items as $item)
                            <div class="list-group-item">
                                @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors])
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
            @php($items = $order_list->order_list_items)
            @if(count($items) == 0)
                @continue
            @endif
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-3">
                    @include('partials.order_list_header', ['order_list' => $order_list])
                    <div class="list-group collapse" id="list-{{ $order_list->id }}">
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_create')
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            @include('partials.order_list_item_form_create', ['order_list_id' => $order_list->id,
                                    'all_items' => $all_items, 'suppliers' => $suppliers, 'errors' => $errors])
                        </div>
                        @php($i = 0)
                        @while($i < count($items))
                            @php($curr_item_category = $items[$i]->category_name)
                            <a href="#category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}" class="list-group-item collapse-href" data-toggle="collapse">
                                <i class="fas fa-chevron-right"></i>{{ $curr_item_category }}
                            </a>
                            <div class="list-group collapse" id="category-{{ $order_list->id }}-{{ $items[$i]->item->category_id }}">
                                <div class="list-group-item">
                                    <div class="row">
                                        @include('partials.order_list_item_fields_update', ['item' => $items[$i]])
                                        <div class="col small"></div>
                                        <div class="col small"></div>
                                    </div>
                                </div>
                                @while($i < count($items) && $items[$i]->category_name == $curr_item_category)
                                    <div class="list-group-item">
                                        @include('partials.order_list_item_form_update', ['item' => $items[$i], 'suppliers' => $suppliers, 'errors' => $errors])
                                        <form id="delete_{{ $items[$i]->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $items[$i]->id }}">
                                        </form>
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