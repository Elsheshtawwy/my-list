<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">All posts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mt-4">
        <div class="text-center">
            <button type="button" class="btn btn-success">Create Post</button>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Title</th>
                        <th scope="col">Posted by</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post["id"]}}</th>
                        <td>{{$post["title"]}}</td>
                        <td>{{$post["Posted by"]}}</td>
                        <td>{{$post["Created at"]}}</td>
                        <td>
                            <button type="button" class="btn btn-primary">View</button>
                            <button type="button" class="btn btn-danger">Edit</button>
                            <button type="button" class="btn btn-secondary">Delete</button>
                        </td>
                    </tr>      
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
