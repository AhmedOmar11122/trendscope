<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TrendScope - Latest News & Trends</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .article-card img {
            height: 200px;
            object-fit: cover;
        }

        .site-title {
            font-weight: bold;
            font-size: 24px;
            color: #d63384;
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
        <a class="navbar-brand site-title" href="#">TrendScope</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Technology</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Health</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Politics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Entertainment</a></li>
                <li class="nav-item"><a class="nav-link" href="#">More</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 mb-5 flex-grow-1">
    <div class="row">
        <!-- Articles Column -->
        <div class="col-lg-8">
            <h3 class="mb-4">Latest Articles</h3>

            @foreach($articles as $article)
            <div class="card mb-4 article-card shadow-sm">
                @if($article->image)
                    <img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text text-muted small mb-2">
                        {{ date('F j, Y', strtotime($article->published_at)) }} |
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </p>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-primary">Read More</a>
                </div>
            </div>
            @endforeach

            @if(count($articles) == 0)
                <div class="alert alert-info">No articles available right now.</div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <h5 class="mb-3">Trending Now</h5>
            <ul class="list-group mb-4">
                @foreach($articles->take(5) as $item)
                    <li class="list-group-item">
                        <a href="{{ route('articles.show', $item->id) }}" class="text-decoration-none">
                            {{ \Illuminate\Support\Str::limit($item->title, 50) }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="p-3 bg-white shadow-sm rounded">
                <h6 class="mb-2">About TrendScope</h6>
                <p class="mb-0 small text-muted">TrendScope brings you the latest and trending topics from across the web — updated daily with insights, news, and articles from every corner of the internet.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-auto">
    &copy; {{ date('Y') }} TrendScope. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
