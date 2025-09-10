<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Marshmallow pastel navbar */
        .navbar-custom {
            background: #FFFAF0; /* Soft marshmallow color */
        }
        .navbar-custom .nav-link {
            color: #555; /* slightly darker for text */
            font-weight: 500;
        }
        .navbar-custom .nav-link:hover {
            color: #FF7F50; /* coral accent on hover */
        }
        .navbar-brand {
            font-weight: 700;
            color: #FF6347 !important; /* tomato-ish brand color */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('projects.index') }}"><h2>Task Manager</h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
