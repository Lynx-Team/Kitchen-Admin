@extends('layouts.app')

@section('title', $order_list->note)

@section('main')
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="row justify-content-around">
                <a href="{{ route('order_list_items.view', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                    {{ __('order_list_items.kitchen_order_btn') }}
                </a>
                @if(Auth::user()->is_manager)
                    <a href="{{ route('order_list_items.view_supplier', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                        {{ __('order_list_items.supplier_grouped_btn') }}
                    </a>
                @endif
                <a href="{{ route('order_list_items.view_category', ['kitchen_id' => Request::segment(2), 'order_list_id' => Request::segment(4)]) }}" class="col-3 btn btn-primary">
                    {{ __('order_list_items.category_grouped_btn') }}
                </a>
            </div>
        </div>
    </div>
    @if(empty($order_list_items))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('order_list_items.empty') }}
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="list-group list-group-root well col-md-12 mb-3">
                @include('partials.order_list_header', ['order_list' => $order_list])
                <div class="list-group">
                    @if(Auth::user()->can('create', \App\OrderListItem::class))
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_create')
                                <div class="col small"></div>
                                <div class="col small"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            @include('partials.order_list_item_form_create', ['order_list_id' => $order_list->id,
                                    'available_items' => $available_items, 'suppliers' => $suppliers, 'errors' => $errors])
                        </div>
                    @endif
                    @if(count($order_list_items) != 0)
                        <div class="list-group-item">
                            <div class="row">
                                @include('partials.order_list_item_fields_update', ['item' => $order_list_items[0]])
                                <div class="col-1 small"></div>
                            </div>
                        </div>
                        @yield('order_list_items')
                    @endif
                    @if(!$order_list->completed)
                        <div class="list-group-item">
                                <a href="#" id="save_order_list" class="btn btn-success">
                                    @if(Auth::user()->is_kitchen)
                                        {{ __('order_list_items.save_btn') }}
                                    @else
                                        {{ __('order_list_items.update_btn') }}
                                    @endif
                                </a>
                                @if(Auth::user()->can('finalize', $order_list))
                                    <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('finalize_{{ $order_list->id }}').submit();">
                                        {{ __('order_list_items.finalize_btn') }}
                                    </a>
                                    <form id="finalize_{{ $order_list->id }}" action="{{ route('order_lists.finalize')  }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order_list->id }}">
                                    </form>
                                @endif
                        </div>
                    @else
                        @if(Auth::user()->can('reset', $order_list))
                            <div class="list-group-item">
                                <a href="#" id="reset_order_list" class="btn btn-warning"
                                   onclick="event.preventDefault(); document.getElementById('reset_{{ $order_list->id }}').submit();">
                                    {{ __('order_list_items.reset_btn') }}
                                </a>
                                <form id="reset_{{ $order_list->id }}" action="{{ route('order_lists.reset') }}"
                                      method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $order_list->id }}">
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    @include('partials.delete_confirm')
    <script>
        $(function() {
            $('.list-group-item').on('click', function() {
                $('.fas', this)
                    .toggleClass('fa-angle-right')
                    .toggleClass('fa-angle-down');
            });

            $('#select_item').change(function() {
                let fields = JSON.parse($(this).val());
                $('#supplier_id').val(fields.supplier_id);
                $('#item_id').val(fields.item_id);
            });

            $('#save_order_list').click(function() {
                $('.form_update').each(function() {
                    $(this).find('.error').text('');
                    $(this).find('#success-message').text('');
                    $('#success-message').text('');
                    $.ajax($(this).attr('action'), {
                        method: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: (data) => {
                            $(this).find('#success-message').text('{{ __('order_list_items.success') }}');
                        },
                        error: (data) => {
                            $.each(data.responseJSON.errors, (key, value) => {
                                $(this).find(`#update_${key}_error`).text(value);
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection