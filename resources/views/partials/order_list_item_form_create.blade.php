<form action="{{ route('order_list_item.create')  }}" method="POST" class="row">
    @csrf
    <input type="hidden" name="order_list_id" value="{{ $order_list_id }}">
    <div class="form-group col">
        <select class="form-control" name="item_id" aria-describedby="create_item_id_error">
            @foreach($all_items as $item)
                <option value="{{ $item->id }}">
                    {{ $item->short_name }}
                </option>
            @endforeach
        </select>
        @if($errors->create->has('item_id'))
            <p id="create_item_id_error" class="form-text text-danger">
                {{ $errors->create->first('item_id') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <select class="form-control" name="supplier_id" aria-describedby="create_supplier_id_error">
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @if($errors->create->has('supplier_id'))
            <p id="create_supplier_id_error" class="form-text text-danger">
                {{ $errors->create->first('supplier_id') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="quantity" min="1" aria-describedby="create_quantity_error">
        @if($errors->create->has('quantity'))
            <p id="create_quantity_error" class="form-text text-danger">
                {{ $errors->create->first('quantity') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="supplier_sort_order" aria-describedby="create_supplier_sort_order_error">
        @if($errors->create->has('supplier_sort_order'))
            <p id="create_supplier_sort_order_error" class="form-text text-danger">
                {{ $errors->create->first('supplier_sort_order') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="kitchen_sort_order" aria-describedby="create_kitchen_sort_order_error">
        @if($errors->create->has('kitchen_sort_order'))
            <p id="create_kitchen_sort_order_error" class="form-text text-danger">
                {{ $errors->create->first('kitchen_sort_order') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="checkbox" class="form-check-input" name="completed" id="create_completed_{{ $order_list_id }}" aria-describedby="create_completed_error">
        <label class="form-check-label" for="create_completed_{{ $order_list_id }}">{{ __('kitchen.completed') }}</label>
        @if($errors->create->has('completed'))
            <p id="create_completed_error" class="form-text text-danger">
                {{ $errors->create->first('completed') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <button type="submit" class="btn btn-success form-control">{{ __('kitchen.create_item') }}</button>
    </div>
    <div class="form-group col">
    </div>
</form>