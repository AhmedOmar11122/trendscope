<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: auto; padding: 50px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; }
        button { padding: 10px 20px; }
    </style>
</head>
<body>

    <h2>Admin Login</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

</body>
</html>
