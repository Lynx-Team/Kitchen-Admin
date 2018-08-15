<form action="{{ route('order_list_item.update')  }}" method="POST" class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="item_id" value="{{ $item->item_id }}">
    <input type="hidden" name="order_list_id" value="{{ $item->order_list_id }}">
    <input type="hidden" name="available_item_id" value="{{ $item->available_item_id }}">
    <div class="form-group col">
        <input type="text" class="form-control" readonly value="{{ $item->item->short_name }}">
    </div>
    @if(Auth::user()->can('update_supplier_id', $item))
        <div class="form-group col">
            <select class="form-control" name="supplier_id" aria-describedby="update_supplier_id_error">
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $item->supplier_id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
            @if($errors->update->has('supplier_id') && $errors->update->first('row_id') == $item->id)
                <p id="select_sort_order_error" class="form-text text-danger">
                    {{ $errors->update->first('supplier_id') }}
                </p>
            @endif
        </div>
    @else
        <input type="hidden" name="supplier_id" value="{{ $item->supplier_id }}">
    @endif
    @if(Auth::user()->can('update_quantity', $item))
        <div class="form-group col">
            <input type="number" class="form-control" name="quantity" min="1" value="{{ $item->quantity }}" aria-describedby="update_quantity_error">
            @if($errors->update->has('quantity') && $errors->update->first('row_id') == $item->id)
                <p id="update_quantity_error" class="form-text text-danger">
                    {{ $errors->update->first('quantity') }}
                </p>
            @endif
        </div>
    @else
        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
    @endif
    @if(Auth::user()->can('update_supplier_sort_order', $item))
        <div class="form-group col">
            <input type="number" class="form-control" name="supplier_sort_order" value="{{ $item->supplier_sort_order }}" aria-describedby="update_supplier_sort_order_error">
            @if($errors->update->has('supplier_sort_order') && $errors->update->first('row_id') == $item->id)
                <p id="update_supplier_sort_order_error" class="form-text text-danger">
                    {{ $errors->update->first('supplier_sort_order') }}
                </p>
            @endif
        </div>
    @else
        <input type="hidden" name="supplier_sort_order" value="{{ $item->supplier_sort_order }}">
    @endif
    @if(Auth::user()->can('update_kitchen_sort_order', $item))
        <div class="form-group col">
            <input type="number" class="form-control" name="kitchen_sort_order" value="{{ $item->kitchen_sort_order }}" aria-describedby="update_kitchen_sort_order_error">
            @if($errors->update->has('kitchen_sort_order') && $errors->update->first('row_id') == $item->id)
                <p id="update_kitchen_sort_order_error" class="form-text text-danger">
                    {{ $errors->update->first('kitchen_sort_order') }}
                </p>
            @endif
        </div>
    @else
        <input type="hidden" name="kitchen_sort_order" value="{{ $item->kitchen_sort_order }}">
    @endif
    <div class="form-group col-3">
        @if(Auth::user()->can('update', $item))
            <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
        @endif
        @if(Auth::user()->can('finilize', $item))
            <a role="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('finilize_{{ $item->id }}').submit();">
                {{ __('users.finilize_btn') }}
            </a>
        @endif
        @if(Auth::user()->can('delete', $item))
            <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
               data-title="Delete item?" data-message="Are you sure you want to delete this item?"
               data-form-id="delete_{{ $item->id }}">
                {{ __('users.delete_btn') }}
            </a>
        @endif
    </div>
</form>