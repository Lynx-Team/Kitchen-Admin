@extends('layouts.app')

@section('title', $order_list->note)

@section('main')
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
                    @if(count($order_list_items) != 0)
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_update', ['item' => $order_list_items[0]])
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        @foreach($order_list_items as $item)
                            <div class="list-group-item">
                                @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors])
                                <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                </form>
                            </div>
                        @endforeach
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
                var str_json = $(this).val();
                var fields = JSON.parse($(this).val());
                $('#available_item_id').val(fields.available_item_id);
                $('#supplier_id').val(fields.supplier_id);
                $('#item_id').val(fields.item_id);
            });
        });
    </script>
@endsection