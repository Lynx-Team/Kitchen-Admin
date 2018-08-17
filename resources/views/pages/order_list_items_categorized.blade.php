@extends('pages.order_list_items')

@section('order_list_items')
    @php($readonly = $order_list->completed ? 'readonly' : '')
    @php($i = 0)
    @while($i < count($order_list_items))
        @php($current_category = $order_list_items[$i]->item->category)
        <a href="#category-{{ $current_category->id }}" class="list-group-item" data-toggle="collapse">
            <i class="fas fa-angle-right"></i> {{ $current_category->name }}
        </a>
        <div class="list-group-item collapse" id="category-{{ $current_category->id }}">
            @while($i < count($order_list_items) && $order_list_items[$i]->item->category->id == $current_category->id)
                @php($item = $order_list_items[$i])
                @include('partials.order_list_item_form_update', ['item' => $item, 'suppliers' => $suppliers, 'errors' => $errors, 'readonly' => $readonly])
                <form id="delete_{{ $item->id }}" action="{{ route('order_list_item.delete') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                </form>
                @php($i++)
            @endwhile
        </div>
    @endwhile
@endsection
