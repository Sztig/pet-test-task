<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pet Store')</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<header>
    <h1>Pet Store</h1>
    <nav>
        <a href="{{ route('pets.index') }}">Pet List</a>
        <a href="{{ route('pets.create') }}">Add New Pet</a>
    </nav>
</header>

@if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

@yield('content')

<footer>
    <p>Pet Store</p>
</footer>
</body>
</html>
