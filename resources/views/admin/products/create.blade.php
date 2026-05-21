<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="card">

            <div class="card-header">
                <h2>Add Product</h2>
            </div>

            <div class="card-body">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="/admin/products" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">

                        <label>Category</label>

                        <select name="category_id" class="form-control">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Price</label>

                        <input type="number" name="price" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Quantity</label>

                        <input type="number" name="quantity" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Image</label>

                        <input type="file" name="image" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" class="form-control" rows="4"></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Hidden
                            </option>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">

                        Save Product

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>