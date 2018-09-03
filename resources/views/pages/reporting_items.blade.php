@extends('layouts.app')

@section('title', __('reporting_items.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->short_name }}</td>
                                    <td>{{ $item->long_name }}</td>
                                    <td>{{ $item->supplier_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->total_cost }}</td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->unit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection