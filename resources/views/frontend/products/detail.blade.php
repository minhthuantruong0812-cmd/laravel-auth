<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="row">

            <div class="col-md-5">

                <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid rounded">

            </div>

            <div class="col-md-7">

                <h2>{{ $product->name }}</h2>

                <p class="text-muted">

                    Category:
                    {{ $product->category->name }}

                </p>

                <h3 class="text-primary mb-3">

                    ${{ $product->price }}

                </h3>

                <p>

                    {{ $product->description }}

                </p>

                <p>

                    Quantity:
                    {{ $product->quantity }}

                </p>

                @if($product->quantity > 0)

                    <span class="badge bg-success">
                        In Stock
                    </span>

                @else

                    <span class="badge bg-danger">
                        Out Of Stock
                    </span>

                @endif

                <div class="mt-4 d-flex gap-2">

                    <form action="/add-to-cart/{{ $product->id }}" method="POST">

                        @csrf

                        <button type="submit" class="btn btn-primary">

                            Add To Cart

                        </button>

                    </form>

                    <a href="/products" class="btn btn-secondary">

                        Back Shop

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>