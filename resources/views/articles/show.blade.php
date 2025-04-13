<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }} - TrendScope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .article-image {
            max-height: 400px;
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
                <li class="nav-item"><a class="nav-link" href="#">Technology</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Health</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Politics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Entertainment</a></li>
                <li class="nav-item"><a class="nav-link" href="#">More</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Article Content -->
<div class="container py-5 flex-grow-1">
    <div class="bg-white p-4 rounded shadow-sm">
        <h1>{{ $article->title }}</h1>
        <p class="text-muted small mb-4">
            {{ date('F j, Y', strtotime($article->published_at)) }} |
            {{ $article->category->name ?? 'Uncategorized' }}
        </p>

        @if($article->image)
            <div class="text-center mb-4">
                <img src="{{ $article->image }}" class="img-fluid rounded shadow-sm article-image" alt="{{ $article->title }}">
            </div>
        @endif

        <div class="article-body">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count())
        <div class="mt-5">
            <h5>Related Articles</h5>
            <div class="row">
                @foreach ($relatedArticles as $related)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            @if($related->image)
                                <img src="{{ $related->image }}" class="card-img-top" style="height:150px; object-fit:cover;">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ \Illuminate\Support\Str::limit($related->title, 60) }}</h6>
                                <a href="{{ route('articles.show', $related->id) }}" class="btn btn-sm btn-outline-primary mt-2">Read</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Footer -->
<footer class="mt-auto">
    &copy; {{ date('Y') }} TrendScope. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
