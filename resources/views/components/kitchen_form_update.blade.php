<form action="{{ route('order_list_item.update')  }}" method="POST" class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="item_id" value="{{ $item->item_id }}}">
    <input type="hidden" name="order_list_id" value="{{ $item->order_list_id }}">
    <div class="form-group col">
        <input type="text" class="form-control" readonly value="{{ $item->item->short_name }}">
    </div>
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
    <div class="form-group col">
        <input type="number" class="form-control" name="cost" min="0" value="{{ $item->cost }}" aria-describedby="update_cost_error">
        @if($errors->update->has('cost') && $errors->update->first('row_id') == $item->id)
            <p id="update_cost_error" class="form-text text-danger">
                {{ $errors->update->first('cost') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="quantity" min="1" value="{{ $item->quantity }}" aria-describedby="update_quantity_error">
        @if($errors->update->has('quantity') && $errors->update->first('row_id') == $item->id)
            <p id="update_quantity_error" class="form-text text-danger">
                {{ $errors->update->first('quantity') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="supplier_sort_order" value="{{ $item->supplier_sort_order }}" aria-describedby="update_supplier_sort_order_error">
        @if($errors->update->has('supplier_sort_order') && $errors->update->first('row_id') == $item->id)
            <p id="update_supplier_sort_order_error" class="form-text text-danger">
                {{ $errors->update->first('supplier_sort_order') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="kitchen_sort_order" value="{{ $item->kitchen_sort_order }}" aria-describedby="update_kitchen_sort_order_error">
        @if($errors->update->has('kitchen_sort_order') && $errors->update->first('row_id') == $item->id)
            <p id="update_kitchen_sort_order_error" class="form-text text-danger">
                {{ $errors->update->first('kitchen_sort_order') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="checkbox" class="form-check-input" name="completed" id="update_completed" aria-describedby="update_completed_error" {{ $item->completed ? 'checked' : '' }}>
        <label class="form-check-label" for="update_completed">{{ __('kitchen.completed') }}</label>
        @if($errors->update->has('completed') && $errors->update->first('row_id') == $item->id)
            <p id="update_completed_error" class="form-text text-danger">
                {{ $errors->update->first('completed') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <button type="submit" class="btn btn-warning">{{ __('users.update_btn') }}</button>
    </div>
    <div class="form-group col">
        <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
           data-title="Delete item?" data-message="Are you sure you want to delete this item?"
           data-form-id="delete_{{ $item->id }}">
            {{ __('users.delete_btn') }}
        </a>
    </div>
</form>