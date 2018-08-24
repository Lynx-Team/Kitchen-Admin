@extends('pages.order_list_items')

@section('order_list_items')
    @php($readonly = $order_list->completed && !Auth::user()->is_manager ? 'readonly' : '')
    <div class="list-group-item">
        @foreach($order_list_items as $item)
            @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors, 'readonly' => $readonly])
            <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
            </form>
        @endforeach
    </div>
@endsection
