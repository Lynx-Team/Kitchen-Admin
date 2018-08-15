<form action="{{ route('order_list_item.create')  }}" method="POST" class="row">
    @csrf
    <input type="hidden" name="order_list_id" value="{{ $order_list_id }}">
    @if(count($available_items) != 0)
        <input type="hidden" name="available_item_id" id="available_item_id" value="{{ $available_items[0]->id }}">
        <input type="hidden" name="supplier_id" id="supplier_id" value="{{$available_items[0]->item->default_supplier_id}}">
        <input type="hidden" name="item_id" id="item_id" value="{{ $available_items[0]->item_id }}">
    @endif
    <div class="form-group col">
        <select class="form-control" id="select_item" aria-describedby="create_item_id_error">
            @foreach($available_items as $item)
                <option value='{"item_id":{{ $item->item_id }}, "available_item_id":{{ $item->id }}, "supplier_id": {{ $item->item->default_supplier_id }} }'>
                    {{ $item->item->short_name }}
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
        <button type="submit" class="btn btn-success form-control">{{ __('kitchen.create_item') }}</button>
    </div>
    <div class="form-group col">
    </div>
</form>