<div class="list-group-item">
    <div class="row justify-content-between">
        <div class="col-8">
            <h5>{{ $order_list->note }}
                @if($order_list->completed)
                    <span class="badge badge-warning badge-pill">{{ __('order_lists.finalized') }}</span>
                @endif
            </h5>
        </div>
        <div class="col-4">
            @if(Auth::user()->can('download_pdf', $order_list))
                <a href="{{ route('order_list_items.download_pdf', ['order_list_id' => $order_list->id]) }}" class="btn btn-primary">{{ __('order_list_items.download_pdf') }}</a>
            @endif
            @if(Auth::user()->can('send_email', $order_list))
                <a href=" {{ route('order_list_items.send_email', ['order_list_id' => $order_list->id]) }}" class="btn btn-primary">{{ __('order_list_items.send_email') }}</a>
            @endif
        </div>
    </div>
</div>