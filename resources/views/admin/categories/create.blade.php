<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="card">

            <div class="card-header">
                <h2>Add Category</h2>
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

                <form action="/admin/categories" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label>Name</label>

                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>

                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1">Active</option>

                            <option value="0">Hidden</option>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save Category
                    </button>

                    <a href="/admin/categories" class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>