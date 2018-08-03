@extends('layouts.app')

@section('title', $kitchen->name)

@section('main')
    @if(empty($order_lists))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('kitchen.empty_order_list') }}
                </div>
            </div>
        </div>
    @elseif(!$grouped)
        @foreach($order_lists as $order_list)
            <div class="row justify-content-center">
                <div class="list-group list-group-root well col-md-10 mb-5">
                    <div class="list-group-item">
                        {{ $order_list->note }}
                    </div>
                    @foreach($order_list->order_list_items as $item)
                        <div class="list-group-item">
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
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @elseif($grouped)
        @foreach($order_lists as $order_list)

        @endforeach
    @endif
@endsection