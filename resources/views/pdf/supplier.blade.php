<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $supplier_name }} | {{ $order_list_name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="col-6">
        Order from {{ $kitchen->kitchenProfile->company_name }}
    </div>
    <div class="col-6 float-right text-right">
        {{ \Carbon\Carbon::now()->toDateString() }}
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        For: {{ $kitchen->name }}
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        {{ $kitchen->kitchenProfile->delivery_address }}
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        {{ $kitchen->kitchenProfile->delivery_instructions }}
    </div>
</div>

<div class="row mt-4 mb-4">
    <div class="col-6">
        For order queries, please contact: {{ $kitchen->kitchenProfile->contact_name }}
    </div>
    <div class="col-6 float-right">
        Phone: {{ $kitchen->kitchenProfile->phone }}
    </div>
</div>
<table style="width: 100%;" class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('supplier_pdf.product_code') }}</th>
        <th scope="col">{{ __('supplier_pdf.full_name') }}</th>
        <th scope="col">{{ __('supplier_pdf.unit') }}</th>
        <th scope="col">{{ __('supplier_pdf.quantity') }}</th>
    </tr>
    </thead>
    <tbody>
        @foreach($order_list_items as $order_list_item)
            <tr>
                <td>{{ $order_list_item->item->product_code }}</td>
                <td>{{ $order_list_item->item->full_name }}</td>
                <td>{{ $order_list_item->item->unit }}</td>
                <td>{{ $order_list_item->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>