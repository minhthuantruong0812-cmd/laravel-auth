<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="card">

            <div class="card-header">
                <h2>Edit Product</h2>
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

                <form action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label>Category</label>

                        <select name="category_id" class="form-control">

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" class="form-control" value="{{ $product->name }}">

                    </div>

                    <div class="mb-3">

                        <label>Price</label>

                        <input type="number" name="price" class="form-control" value="{{ $product->price }}">

                    </div>

                    <div class="mb-3">

                        <label>Quantity</label>

                        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">

                    </div>

                    <div class="mb-3">

                        <label>Current Image</label>
                        <br>

                        <img src="{{ asset('uploads/products/' . $product->image) }}" width="120">

                    </div>

                    <div class="mb-3">

                        <label>New Image</label>

                        <input type="file" name="image" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4"
                            class="form-control">{{ $product->description }}</textarea>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>

                                Hidden

                            </option>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">

                        Update Product

                    </button>

                    <a href="/admin/products" class="btn btn-secondary">

                        Back

                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>