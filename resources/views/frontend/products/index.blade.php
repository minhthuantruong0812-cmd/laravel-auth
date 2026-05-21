<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <h2 class="mb-4">
            Product Shop
        </h2>

        <form method="GET" action="/products" class="row mb-4">

            <div class="col-md-4">

                <input type="text" name="search" class="form-control" placeholder="Search product..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-4">

                <select name="category" class="form-control">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-4">

                <button type="submit" class="btn btn-primary">

                    Search

                </button>

            </div>

        </form>
        <div class="row">

            @foreach($products as $product)

                <div class="col-md-3 mb-4">

                    <div class="card h-100">

                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top" height="220"
                            style="object-fit: cover;">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">

                                {{ $product->name }}

                            </h5>

                            <p class="text-muted">

                                {{ $product->category->name }}

                            </p>

                            <h4 class="mb-3">

                                ${{ $product->price }}

                            </h4>

                            <a href="/products/{{ $product->slug }}" class="btn btn-primary mt-auto">

                                View Detail

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</body>

</html>