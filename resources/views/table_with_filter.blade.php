<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Posts List</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ url('/table_with_multiple_filter') }}" class="mb-4">
		
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Search by title..." value="{{ request('title') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="body" class="form-control" placeholder="Search by body..." value="{{ request('body') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('/posts') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Body</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paginatedData as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['body'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $paginatedData->appends(['title' => request('title'), 'body' => request('body')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</body>
</html>
