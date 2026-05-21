<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h2 class="mb-4">
            Shopping Cart
        </h2>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @php
            $total = 0;
        @endphp

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Image</th>

                    <th>Name</th>

                    <th>Price</th>

                    <th width="180">Quantity</th>

                    <th>Total</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($cart as $id => $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <tr>

                        <td>

                            <img src="{{ asset('uploads/products/' . $item['image']) }}" width="80">

                        </td>

                        <td>

                            {{ $item['name'] }}

                        </td>

                        <td>

                            ${{ $item['price'] }}

                        </td>

                        <td>

                            <form action="/cart/update/{{ $id }}" method="POST" class="d-flex">

                                @csrf

                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                    class="form-control me-2">

                                <button type="submit" class="btn btn-primary btn-sm">

                                    Update

                                </button>

                            </form>

                        </td>

                        <td>

                            ${{ $subtotal }}

                        </td>

                        <td>

                            <a href="/cart/remove/{{ $id }}" class="btn btn-danger btn-sm">

                                Remove

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Cart is empty

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <h3 class="mt-4">

            Grand Total:
            ${{ $total }}

        </h3>

        <a href="/products" class="btn btn-secondary mt-3">

            Continue Shopping

        </a>

        <a href="/checkout" class="btn btn-success mt-3">

            Checkout

        </a>

    </div>

</body>

</html>