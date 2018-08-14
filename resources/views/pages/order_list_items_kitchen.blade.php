@extends('pages.order_list_items')

@section('order_list_items')
    @foreach($order_list_items as $item)
        <div class="list-group-item">
            @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors])
            <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
            </form>
        </div>
    @endforeach
@endsection
