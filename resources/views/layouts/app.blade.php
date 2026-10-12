<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | School Equipment Borrowing</title>
</head>
<body>
    <nav>
        <a href="{{ route('categories.index') }}">Categories</a> |
        <a href="{{ route('students.index') }}">Students</a> |
        <a href="{{ route('equipments.index') }}">Equipment</a> |
        <a href="{{ route('borrowings.index') }}">Borrowings</a> |
        <a href="{{ route('returns.index') }}">Returns</a>
    </nav>
    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @yield('content')
</body>
</html>