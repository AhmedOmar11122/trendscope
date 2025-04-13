<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page Not Found - TrendScope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center">

    <div class="container">
        <h1 class="display-1 text-danger">404</h1>
        <h3 class="mb-3">Oops! The page you're looking for doesn't exist.</h3>
        <p class="text-muted">It might have been removed or renamed, or the link you clicked is broken.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">← Back to Home</a>
    </div>

</body>
</html>
