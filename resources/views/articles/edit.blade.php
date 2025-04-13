<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Article</h2>
        <a href="{{ route('articles.admin') }}" class="btn btn-secondary">← Back to Articles</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There are some errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ $article->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $article->content }}</textarea>
        </div>

        <!-- عرض الصورة الحالية -->
        @if($article->image)
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="{{ $article->image }}" alt="Current Image" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
            </div>
        @endif

        <!-- حقل رفع صورة جديدة -->
        <div class="mb-3">
            <label class="form-label">Upload New Image (optional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" value="{{ $article->slug }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keywords</label>
            <input type="text" name="keywords" value="{{ $article->keywords }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Published At</label>
            <input type="datetime-local" name="published_at"
                   value="{{ date('Y-m-d\TH:i', strtotime($article->published_at)) }}"
                   class="form-control">
        </div>

        <div class="mb-4">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @if($category->id == $article->category_id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
