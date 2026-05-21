<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>

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
            <h2>Category List</h2>

            <a href="/admin/categories/create" class="btn btn-primary">
                Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="200">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($categories as $category)

                    <tr>
                        <td>{{ $category->id }}</td>

                        <td>{{ $category->name }}</td>

                        <td>{{ $category->slug }}</td>

                        <td>
                            @if($category->status == 1)
                                Active
                            @else
                                Hidden
                            @endif
                        </td>

                        <td>

                            <a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="/admin/categories/{{ $category->id }}" method="POST" class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa category này?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</body>

</html>