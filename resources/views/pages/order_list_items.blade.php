@extends('layouts.app')

@section('title', $order_list->note)

@section('main')
    <div class="row justify-content-center mb-3">
        <div class="col-10">
            <div class="row justify-content-between">
                <a href="{{ route('order_list_items.view', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                    Kitchen sort order
                </a>
                <a href="{{ route('order_list_items.view_supplier', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                    Supplier grouped
                </a>
                <a href="{{ route('order_list_items.view_category', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                    Category grouped
                </a>
            </div>
        </div>
    </div>
    @if(empty($order_list_items))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('order_list_items.empty') }}
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="list-group list-group-root well col-md-10 mb-3">
                @include('partials.order_list_header', ['order_list' => $order_list])
                <div class="list-group">
                    @if(Auth::user()->can('create', \App\OrderListItem::class))
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_create')
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            @include('partials.order_list_item_form_create', ['order_list_id' => $order_list->id,
                                    'available_items' => $available_items, 'suppliers' => $suppliers, 'errors' => $errors])
                        </div>
                    @endif
                    @if(count($order_list_items) != 0)
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_update', ['item' => $order_list_items[0]])
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>

                        @yield('order_list_items')
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    @include('partials.delete_confirm')
    <script>
        $(function() {
            $('#select_item').change(function() {
                var fields = JSON.parse($(this).val());
                $('#available_item_id').val(fields.available_item_id);
                $('#supplier_id').val(fields.supplier_id);
                $('#item_id').val(fields.item_id);
            });
        });
    </script>
@endsection