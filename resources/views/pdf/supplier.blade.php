<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $supplier_name }} | Order list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<table style="width: 100%;" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Cost</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach($order_list_items as $order_list_item)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $order_list_item->item->full_name }}</td>
                <td>{{ $order_list_item->quantity }}</td>
                <td>{{ $order_list_item->cost }}</td>
            </tr>
            @php($i++)
        @endforeach
    </tbody>
</table>
</body>
</html>