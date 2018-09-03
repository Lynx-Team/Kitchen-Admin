@extends('layouts.app')

@section('title', __('reporting_items.title'))

@section('main')
    <div class="row justify-content-center mt-2 mb-2">
        <div class="col-md-10 text-center">
            <h1>{{ \App\HistoryOrderList::findOrFail(Request::segment(4))->note }}</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @php($i = 0)
            @while($i < count($items))
                @php($current_supplier = $items[$i]->supplier_name)
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('reporting_items.short_name') }}</th>
                                    <th scope="col">{{ __('reporting_items.long_name') }}</th>
                                    <th scope="col">{{ __('reporting_items.supplier_name') }}</th>
                                    <th scope="col">{{ __('reporting_items.quantity') }}</th>
                                    <th scope="col">{{ __('reporting_items.total_cost') }}</th>
                                    <th scope="col">{{ __('reporting_items.product_code') }}</th>
                                    <th scope="col">{{ __('reporting_items.unit') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @while($i < count($items) && $items[$i]->supplier_name == $current_supplier)
                                    @php($item = $items[$i])
                                    <tr>
                                        <td>{{ $item->short_name }}</td>
                                        <td>{{ $item->long_name }}</td>
                                        <td>{{ $item->supplier_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total_cost }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->unit }}</td>
                                    </tr>
                                    @php($i++)
                                @endwhile
                            </tbody>
                        </table>
                    </div>
                </div>
            @endwhile
        </div>
    </div>
@endsection