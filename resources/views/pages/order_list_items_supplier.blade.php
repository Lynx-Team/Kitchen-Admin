@extends('pages.order_list_items')

@section('order_list_items')
    @php($i = 0)
    @while($i < count($order_list_items))
        @php($current_supplier = $order_list_items[$i]->supplier)
        <a href="#supplier-{{ $current_supplier->id }}" class="list-group-item" data-toggle="collapse">
            <i class="fas fa-angle-right"></i> {{ $current_supplier->name }}
        </a>
        <div class="list-group-item collapse" id="supplier-{{ $current_supplier->id }}">
            @while($i < count($order_list_items) && $order_list_items[$i]->supplier_id == $current_supplier->id)
                @php($item = $order_list_items[$i])
                @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors])
                <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                </form>
                @php($i++)
            @endwhile
        </div>
    @endwhile
@endsection
