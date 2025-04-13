<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }} Articles - TrendScope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .article-card img {
            height: 200px;
            object-fit: cover;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            transition: background-color 0.2s, color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            background-color: #212529;
            color: #fff !important;
            border-radius: 5px;
        }

        footer {
            background-color: #212529;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">TrendScope</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('/category/technology') }}">Technology</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/category/health') }}">Health</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/category/politics') }}">Politics</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/category/entertainment') }}">Entertainment</a></li>
                <li class="nav-item"><a class="nav-link" href="#">More</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5 flex-grow-1">
    <h2 class="mb-4">{{ $category->name }} Articles</h2>

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 article-card shadow-sm">
                    @if($article->image)
                        <img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text text-muted small">
                            {{ date('F j, Y', strtotime($article->published_at)) }}
                        </p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-primary mt-auto">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No articles found in this category.
            </div>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer class="mt-auto">
    &copy; {{ date('Y') }} TrendScope. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
