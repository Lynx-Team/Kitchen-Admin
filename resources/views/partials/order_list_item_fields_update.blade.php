<div class="col small">{{ __('kitchen.short_name') }}</div>
@if(Auth::user()->can('update_supplier_id', $item))
    <div class="col small">{{ __('kitchen.supplier') }}</div>
@endif
@if(Auth::user()->can('update_quantity', $item))
    <div class="col small">{{ __('kitchen.quantity') }}</div>
@endif
@if(Auth::user()->can('update_supplier_sort_order', $item))
    <div class="col small">{{ __('kitchen.supplier_sort_order') }}</div>
@endif
@if(Auth::user()->can('update_kitchen_sort_order', $item))
    <div class="col small">{{ __('kitchen.kitchen_sort_order') }}</div>
@endif
@if(Auth::user()->can('update_completed', $item))
    <div class="col small">{{ __('kitchen.completed') }}</div>
@endif
