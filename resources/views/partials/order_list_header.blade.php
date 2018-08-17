<div class="list-group-item">
    <div class="row justify-content-between">
        <div class="col">
            <h5>{{ $order_list->note }}
                @if($order_list->completed)
                    <span class="badge badge-warning badge-pill">{{ __('order_lists.finalized') }}</span>
                @endif
            </h5>
        </div>
    </div>
</div>