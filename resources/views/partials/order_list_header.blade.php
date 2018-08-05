<div class="list-group-item">
    <div class="row justify-content-between">
        <div class="col">
            <a href="#list-{{ $order_list->id }}" class="collapse-href" data-toggle="collapse" role="button">
                <i class="fas fa-chevron-right"></i>
                {{ $order_list->note }}
                <span class="badge badge-primary badge-pill">{{ count($order_list->order_list_items) }}
            </a>
        </div>
        <div class="col">
            <form action="{{ route('order_lists.update_completed') }}" method="POST" class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $order_list->id }}">
                <div class="form-group col">
                    <input type="checkbox" class="form-check-input" name="completed" id="update_completed_{{ $order_list->id }}" aria-describedby="update_completed_error" {{ $order_list->completed ? 'checked' : '' }}>
                    <label class="form-check-label" for="update_completed_{{ $order_list->id }}">{{ __('kitchen.completed') }}</label>
                </div>
                <div class="form-group col">
                    <button type="submit" class="btn btn-primary">{{ __('kitchen.update_item') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>