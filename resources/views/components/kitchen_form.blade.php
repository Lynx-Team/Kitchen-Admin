<form action="<some>" method="POST" class="row">
    @csrf
    <div class="form-group col">
        <input type="text" class="form-control" readonly value="{{ $item->item->short_name }}">
    </div>
    <div class="form-group col">
        <select class="form-control" name="supplier" aria-describedby="update_supplier_error">
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @if($errors->update->has('supplier') && $errors->update->first('row_id') == $item->id)
            <p id="select_sort_order_error" class="form-text text-danger">
                {{ $errors->update->first('supplier') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <input type="number" class="form-control" name="quantity" min="0" value="{{ $item->quantity }}" aria-describedby="update_quantity_error">
        @if($errors->update->has('quantity') && $errors->update->first('row_id') == $item->id)
            <p id="update_quantity_error" class="form-text text-danger">
                {{ $errors->update->first('quantity') }}
            </p>
        @endif
    </div>
    <div class="form-group col">
        <button type="submit" class="btn btn-success form-control">{{ __('kitchen.update_item') }}</button>
    </div>
</form>