<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: auto;
            padding: 20px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .meta {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>{{ $article->title }}</h1>

    <div class="meta">
        Published on {{ date('Y-m-d', strtotime($article->published_at)) }} |
        Category: {{ $article->category->name ?? 'No Category' }}
    </div>

    @if ($article->image)
        <img src="{{ $article->image }}" alt="{{ $article->title }}">
    @endif

    <p>{{ $article->content }}</p>

    <p><a href="{{ url('/') }}">← Back to Home</a></p>

</body>
</html>
