@extends('layouts.app')

@section('title', __('items.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('items.add_title') }}</div>
                <div class="card-body">
                    <form action="{{ route('items.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kitchen_id" value="{{ Request::segment(2) }}">
                        <div class="row">
                            <div class="form-group col">
                                <label for="new_short_name">{{ __('items.short_name') }}</label>
                                <input type="text" class="form-control" name="short_name" id="new_short_name" placeholder="{{ __('items.short_name') }}" aria-describedby="create_short_name_error">
                                @if($errors->create->has('short_name'))
                                    <p id="create_short_name_error" class="form-text text-danger">
                                        {{ $errors->create->first('short_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="new_full_name">{{ __('items.full_name') }}</label>
                                <input type="text" class="form-control" name="full_name" id="new_full_name" placeholder="{{ __('items.full_name') }}" aria-describedby="create_full_name_error">
                                @if($errors->create->has('full_name'))
                                    <p id="create_full_name_error" class="form-text text-danger">
                                        {{ $errors->create->first('full_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="default_supplier">{{ __('items.default_supplier') }}</label>
                                <select class="form-control" name="default_supplier" id="default_supplier" aria-describedby="create_default_supplier_error">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->create->has('default_supplier'))
                                    <p id="create_default_supplier_error" class="form-text text-danger">
                                        {{ $errors->create->first('default_supplier') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="category">{{ __('items.category') }}</label>
                                <select class="form-control" name="category" id="category" aria-describedby="create_category_error">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->create->has('category'))
                                    <p id="create_category_error" class="form-text text-danger">
                                        {{ $errors->create->first('category') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="new_cost">{{ __('items.cost') }}</label>
                                <input type="number" min="0" step="0.01" class="form-control" name="cost" id="new_cost" placeholder="{{ __('items.cost') }}" aria-describedby="create_cost_error">
                                @if($errors->create->has('cost'))
                                    <p id="create_cost_error" class="form-text text-danger">
                                        {{ $errors->create->first('cost') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="new_product_code">{{ __('items.product_code') }}</label>
                                <input type="text" min="0" class="form-control" name="product_code"
                                       id="new_product_code" placeholder="{{ __('items.product_code') }}" aria-describedby="create_product_code_error">
                                @if($errors->create->has('product_code'))
                                    <p id="create_product_code_error" class="form-text text-danger">
                                        {{ $errors->create->first('product_code') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="new_unit">{{ __('items.unit') }}</label>
                                <input type="text" min="0" class="form-control" name="unit"
                                       id="new_unit" placeholder="{{ __('items.unit') }}" aria-describedby="create_unit_error">
                                @if($errors->create->has('unit'))
                                    <p id="create_unit_error" class="form-text text-danger">
                                        {{ $errors->create->first('unit') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="add_item_btn">&nbsp;</label>
                                <button type="submit" class="btn btn-success form-control" id="add_item_btn">{{ __('items.add_btn') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="accordion" id="items-list">
                @forelse ($items as $item)
                    <div class="card" style="margin-bottom: 0;">
                        <div class="card-header" id="item-heading-{{ $item->id }}">
                            <div class="row justify-content-between">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#item-{{ $item->id }}" aria-expanded="true" aria-controls="item-{{ $item->id }}">
                                    {{$item->short_name }}
                                </button>
                                <a role="button" class="btn btn-danger mr-3" data-toggle="modal" data-target="#confirmDelete"
                                   data-title="Delete item" data-message="Are you sure you want to delete this item?"
                                   data-form-id="delete_{{ $item->id }}">
                                    {!! __('items.delete_btn') !!}
                                </a>
                            </div>
                        </div>
                        <div id="item-{{ $item->id }}" class="collapse" aria-labelledby="item-heading-{{ $item->id }}" data-parent="#items-list">
                            <div class="card-body">
                                <form action="{{ route('items.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>{{ __('items.short_name') }}</label>
                                            <input type="text" class="form-control" name="short_name" value="{{ $item->short_name }}" placeholder="{{ __('items.short_name') }}" aria-describedby="update_short_name_error">
                                            @if($errors->update->has('short_name') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_short_name_error" class="form-text text-danger">
                                                    {{ $errors->update->first('short_name') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group col">
                                            <label>{{ __('items.full_name') }}</label>
                                            <input type="text" class="form-control" name="full_name" value="{{ $item->full_name }}" placeholder="{{ __('items.full_name') }}" aria-describedby="update_full_name_error">
                                            @if($errors->update->has('full_name') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_full_name_error" class="form-text text-danger">
                                                    {{ $errors->update->first('full_name') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group col">
                                            <label>{{ __('items.unit') }}</label>
                                            <input type="text" class="form-control" name="unit" value="{{ $item->unit}}"
                                                   placeholder="{{ __('items.unit') }}" aria-describedby="update_unit_error">
                                            @if($errors->update->has('unit') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_unit_error" class="form-text text-danger">
                                                    {{ $errors->update->first('unit') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>{{ __('items.default_supplier') }}</label>
                                            <select class="form-control" name="default_supplier" aria-describedby="update_default_supplier_error">
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ $item->default_supplier_id == $supplier->id ? 'selected' : '' }}>
                                                        {{ $supplier->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->update->has('default_supplier') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_default_supplier_error" class="form-text text-danger">
                                                    {{ $errors->update->first('default_supplier') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group col">
                                            <label>{{ __('items.category') }}</label>
                                            <select class="form-control" name="category" aria-describedby="update_category_error">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->update->has('category') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_category_error" class="form-text text-danger">
                                                    {{ $errors->update->first('category') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group col">
                                            <label>{{ __('items.cost') }}</label>
                                            <input type="number" min="0" step="0.01" class="form-control" name="cost" value="{{ $item->cost }}" placeholder="{{ __('items.cost') }}" aria-describedby="update_cost_error">
                                            @if($errors->update->has('cost') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_cost_error" class="form-text text-danger">
                                                    {{ $errors->update->first('cost') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group col">
                                            <label>{{ __('items.product_code') }}</label>
                                            <input type="text" class="form-control" name="product_code" value="{{ $item->product_code }}"
                                                   placeholder="{{ __('items.product_code') }}" aria-describedby="update_product_code_error">
                                            @if($errors->update->has('product_code') && $errors->update->first('row_id') == $item->id)
                                                <p id="update_product_code_error" class="form-text text-danger">
                                                    {{ $errors->update->first('product_code') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-end">
                                        <button type="submit" class="btn btn-warning mr-3">{{ __('items.update_btn') }}</button>
                                    </div>
                                </form>
                                <form id="delete_{{ $item->id }}" action="{{ route('items.delete') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                            {{ __('items.no_items') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('partials.delete_confirm')
@endsection
