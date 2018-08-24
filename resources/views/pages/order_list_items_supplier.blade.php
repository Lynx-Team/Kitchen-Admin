@extends('pages.order_list_items')

@section('order_list_items')
    @php($is_show_cost = true)
    @php($readonly = $order_list->completed && !Auth::user()->is_manager? 'readonly' : '')
    @php($i = 0)
    @while($i < count($order_list_items))
        @php($current_supplier = $order_list_items[$i]->supplier)
        @php($total_cost = 0)
        @php($j = $i)
        @while($j < count($order_list_items) && $order_list_items[$j]->supplier_id == $current_supplier->id)
            @php($total_cost += $order_list_items[$j]->item->cost * $order_list_items[$j]->quantity)
            @php($j++)
        @endwhile
        <div class="list-group-item d-flex justify-content-between" >
            <div>
                <a href="#supplier-{{ $current_supplier->id }}" data-toggle="collapse">
                    <i class="fas fa-angle-right"></i>
                    <span>{{ $current_supplier->name }}</span>
                </a>
                <span class="badge badge-primary badge-pill">Total cost: {{ $total_cost }}</span>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('supplier_order_list.download_pdf',
                    [ 'supplier_id' => $current_supplier->id, 'order_list_id' => $order_list->id ]) }}">PDF</a>
                <a class="btn btn-primary" href="{{ route('supplier_order_list.send_email',
                    [ 'supplier_id' => $current_supplier->id, 'order_list_id' => $order_list->id ]) }}">Email</a>
            </div>
        </div>
        <div class="list-group-item collapse supplier-block" id="supplier-{{ $current_supplier->id }}"
             ondrop="drop(event);" ondragover="event.preventDefault();"  data-supplier-id="{{ $current_supplier->id }}">
            @while($i < count($order_list_items) && $order_list_items[$i]->supplier_id == $current_supplier->id)
                @php($item = $order_list_items[$i])
                @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors, 'readonly' => $readonly])
                <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                </form>
                @php($i++)
            @endwhile
        </div>
    @endwhile
@endsection

@section('js')
    @parent
    <script>
        function shareData(e) {
            e.dataTransfer.setData('item_id', e.target.id.value);
        }

        function drop(e) {
            let item_id = e.dataTransfer.getData('item_id');
            let supplier_block = $(e.target).closest('.supplier-block');
            let update_form = $(`#update-${item_id}`);
            update_form.appendTo(supplier_block);
            let supplier_id = supplier_block.attr('data-supplier-id');
            update_form.find(`select[name="supplier_id"]>option[value="${supplier_id}"]`).prop('selected', true);
        }
    </script>
@endsection
