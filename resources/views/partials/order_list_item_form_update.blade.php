<form id="update-{{ $item->id }}" draggable="true" ondragstart="shareData(event);"
      action="{{ route('order_list_item.update')  }}" method="POST" class="form_update row">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="item_id" value="{{ $item->item_id }}">
    <input type="hidden" name="order_list_id" value="{{ $item->order_list_id }}">
    <div class="form-group col">
        <input type="text" class="form-control" readonly value="{{ $item->item->short_name }}">
    </div>
    @if(Auth::user()->can('update_supplier_id', $item))
        <div class="form-group col">
            <select class="form-control" name="supplier_id" aria-describedby="update_supplier_id_error" {{ $readonly }}>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $item->supplier_id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
            <p id="update_supplier_id_error" class="error form-text text-danger"></p>
        </div>
    @else
        <input type="hidden" name="supplier_id" value="{{ $item->supplier_id }}">
    @endif
    @if(Auth::user()->can('update_quantity', $item))
        <div class="form-group col-2">
            <input type="number" class="form-control" name="quantity" min="0" value="{{ $item->quantity }}" aria-describedby="update_quantity_error" {{ $readonly }}>
            <p id="update_quantity_error" class="error form-text text-danger"></p>
        </div>
    @else
        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
    @endif
    @if(Auth::user()->can('update_supplier_sort_order', $item))
        <div class="form-group col-2">
            <input type="number" class="form-control" name="supplier_sort_order" value="{{ $item->supplier_sort_order }}" aria-describedby="update_supplier_sort_order_error" {{ $readonly }}>
            <p id="update_supplier_sort_order_error" class="error form-text text-danger"></p>
        </div>
    @else
        <input type="hidden" name="supplier_sort_order" value="{{ $item->supplier_sort_order }}">
    @endif
    @if(Auth::user()->can('update_kitchen_sort_order', $item))
        <div class="form-group col-2">
            <input type="number" class="form-control" name="kitchen_sort_order" value="{{ $item->kitchen_sort_order }}" aria-describedby="update_kitchen_sort_order_error" {{ $readonly }}>
            <p id="update_kitchen_sort_order_error" class="error form-text text-danger"></p>
        </div>
    @else
        <input type="hidden" name="kitchen_sort_order" value="{{ $item->kitchen_sort_order }}">
    @endif
    <div class="form-group col-2">
        @if(Auth::user()->can('delete', $item))
            <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
               data-title="Delete item?" data-message="Are you sure you want to delete this item?"
               data-form-id="delete_{{ $item->id }}">
                {{ __('users.delete_btn') }}
            </a>
        @endif
        <span class="badge badge-pill badge-success ml-3" id="success-message"></span>
    </div>
</form>