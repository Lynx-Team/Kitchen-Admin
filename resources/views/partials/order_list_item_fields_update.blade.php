<div class="col small">{{ __('kitchen.short_name') }}</div>
@if(Auth::user()->is_kitchen)
    <div class="col-2 small">{{ __('kitchen.unit') }}</div>
@endif
@if(Auth::user()->can('update_supplier_id', $item))
    <div class="col small">{{ __('kitchen.supplier') }}</div>
@endif
@if(Auth::user()->can('update_quantity', $item))
    <div class="col-2 small">{{ __('kitchen.quantity') }}</div>
@endif
@if(Auth::user()->can('update_supplier_sort_order', $item))
    <div class="col-2 small">{{ __('kitchen.supplier_sort_order') }}</div>
@endif
@if(Auth::user()->can('update_kitchen_sort_order', $item))
    <div class="col-2 small">{{ __('kitchen.kitchen_sort_order') }}</div>
@endif
@if(isset($is_show_cost) && $is_show_cost)
    <div class="col-2 small">Cost</div>
@endif
<div class="col-2 small"></div>