<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
<div class="mb-4">

    <a href="/admin/users"
       class="btn btn-dark">
        Users
    </a>

    <a href="/admin/categories"
       class="btn btn-dark">
        Categories
    </a>

    <a href="/admin/products"
       class="btn btn-dark">
        Products
    </a>

    <a href="/admin/orders"
       class="btn btn-dark">
        Orders
    </a>

    <a href="/products"
       class="btn btn-primary">
        Shop
    </a>

    <form action="/logout"
          method="POST"
          class="d-inline">

        @csrf

        <button type="submit"
                class="btn btn-danger">

            Logout

        </button>

    </form>

</div>
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Order List</h2>

            <a href="/admin/products" class="btn btn-secondary">

                Back

            </a>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Customer</th>

                    <th>Phone</th>

                    <th>Total</th>

                    <th>Created</th>

                    <th width="120">Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ $order->name }}</td>

                        <td>{{ $order->phone }}</td>

                        <td>${{ $order->total_price }}</td>

                        <td>{{ $order->created_at }}</td>

                        <td>

                            <a href="/admin/orders/{{ $order->id }}" class="btn btn-primary btn-sm">

                                View

                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</body>

</html>