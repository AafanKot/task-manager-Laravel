<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <div class="container-box">
        <h1>Welcome to Task Manager</h1>
        <p>Manage your projects and tasks easily</p>
        <div>
            <a href="{{ url('/register') }}" class="btn btn-primary btn-custom">Signup</a>
            <a href="{{ url('/login') }}" class="btn btn-success btn-custom">Login</a>
        </div>
    </div>
</body>
</html>