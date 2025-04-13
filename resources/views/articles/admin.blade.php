<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <!-- الشريط العلوي -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manage Articles</h2>
        <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
    </div>

    <!-- تنبيه النجاح -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- زر إضافة مقال -->
    <div class="mb-3 text-end">
        <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Add New Article</a>
    </div>

    <!-- جدول المقالات -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name ?? 'No Category' }}</td>
                    <td>{{ date('Y-m-d', strtotime($article->published_at)) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- زر تعديل -->
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- زر يفتح المودال -->
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $article->id }}">
                                Delete
                            </button>
                        </div>

                        <!-- مودال تأكيد الحذف -->
                        <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="modalLabel{{ $article->id }}">تأكيد الحذف</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                    </div>
                                    <div class="modal-body">
                                        هل أنت متأكد أنك تريد حذف المقال "<strong>{{ $article->title }}</strong>"؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">نعم، احذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
