<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>
                Order #{{ $order->id }}
            </h2>

            <a href="/admin/orders" class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card mb-4">

            <div class="card-header">
                Customer Information
            </div>

            <div class="card-body">

                <p>
                    <strong>Name:</strong>
                    {{ $order->name }}
                </p>

                <p>
                    <strong>Phone:</strong>
                    {{ $order->phone }}
                </p>

                <p>
                    <strong>Address:</strong>
                    {{ $order->address }}
                </p>

                <p>
                    <strong>Total:</strong>
                    ${{ $order->total_price }}
                </p>

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                Order Items
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Product</th>

                            <th>Price</th>

                            <th>Quantity</th>

                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($order->items as $item)

                            <tr>

                                <td>

                                    {{ $item->product->name }}

                                </td>

                                <td>

                                    ${{ $item->price }}

                                </td>

                                <td>

                                    {{ $item->quantity }}

                                </td>

                                <td>

                                    ${{ $item->price * $item->quantity }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>