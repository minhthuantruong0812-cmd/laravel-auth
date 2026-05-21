<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h2 class="mb-4">
            Checkout
        </h2>

        <div class="row">

            <!-- FORM -->
            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">
                        Customer Information
                    </div>

                    <div class="card-body">

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <form action="/checkout" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label>Name</label>

                                <input type="text" name="name" class="form-control">

                            </div>

                            <div class="mb-3">

                                <label>Phone</label>

                                <input type="text" name="phone" class="form-control">

                            </div>

                            <div class="mb-3">

                                <label>Address</label>

                                <textarea name="address" rows="4" class="form-control"></textarea>

                            </div>

                            <button type="submit" class="btn btn-success">

                                Place Order

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- ORDER SUMMARY -->
            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">
                        Order Summary
                    </div>

                    <div class="card-body">

                        @php
                            $total = 0;
                        @endphp

                        @foreach($cart as $item)

                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp

                            <div class="d-flex justify-content-between mb-3">

                                <div>

                                    <strong>
                                        {{ $item['name'] }}
                                    </strong>

                                    <br>

                                    Qty:
                                    {{ $item['quantity'] }}

                                </div>

                                <div>

                                    ${{ $subtotal }}

                                </div>

                            </div>

                        @endforeach

                        <hr>

                        <h4>

                            Total:
                            ${{ $total }}

                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>