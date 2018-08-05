<div class="list-group-item">
    <div class="row justify-content-between">
        <div class="col">
            <a href="#list-{{ $rows[$i]->id }}" class="collapse-href" data-toggle="collapse" role="button">
                <i class="fas fa-chevron-right"></i>
                {{ $rows[$i]->note }}
                <span class="badge badge-primary badge-pill">{{ $rows[$i]->count }}
            </a>
        </div>
        <div class="col">
            <form action="{{ route('order_lists.update_completed') }}" method="POST" class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $rows[$i]->id }}">
                <div class="form-group col">
                    <input type="checkbox" class="form-check-input" name="completed"
                           id="update_completed_{{ $rows[$i]->id }}"
                           aria-describedby="update_completed_error" {{ $rows[$i]->completed ? 'checked' : '' }}>
                    <label class="form-check-label" for="update_completed_{{ $rows[$i]->id }}">{{ __('kitchen.completed') }}</label>
                </div>
                <div class="form-group col">
                    <button type="submit" class="btn btn-primary">{{ __('kitchen.update_item') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>