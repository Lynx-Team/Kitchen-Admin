<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $order_list_name }} | Order list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
@php($i = 0)
@while($i < count($order_list_items))
    <div class="{{ $i == 0 ? '' : 'page-break' }}">
        <h3>{{ $order_list_items[$i]->supplier->name }}</h3>
        <table style="width: 100%;" class="table table-sm table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('supplier_pdf.full_name') }}</th>
                <th scope="col">{{ __('supplier_pdf.quantity') }}</th>
                <th scope="col">{{ __('supplier_pdf.cost') }}</th>
            </tr>
            </thead>
            <tbody>
                @php($current_supplier = $order_list_items[$i]->supplier_id)
                @while($i < count($order_list_items) && $order_list_items[$i]->supplier_id == $current_supplier)
                    @php($order_list_item = $order_list_items[$i])
                    <tr>
                        <td>{{ $order_list_item->item->full_name }}</td>
                        <td>{{ $order_list_item->quantity }}</td>
                        <td>{{ $order_list_item->item->cost }}</td>
                    </tr>
                    @php($i++)
                @endwhile
            </tbody>
        </table>
    </div>
@endwhile
</body>
</html>