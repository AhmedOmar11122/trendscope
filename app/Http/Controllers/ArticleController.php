<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->orderBy('published_at', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('articles'));
    }
    public function adminIndex()
{
    $articles = \App\Models\Article::with('category')->orderBy('id', 'desc')->get();
    return view('articles.admin', compact('articles'));
}
public function edit($id)
{
    $article = \App\Models\Article::findOrFail($id);
    $categories = \App\Models\Category::all();
    return view('articles.edit', compact('article', 'categories'));
}
public function update(Request $request, $id)
{
    $article = \App\Models\Article::findOrFail($id);

    // التحقق من صحة البيانات
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'slug' => 'required|unique:articles,slug,' . $id,
        'keywords' => 'nullable|string',
        'published_at' => 'nullable|date',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // رفع صورة جديدة إن وجدت
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $validated['image'] = '/storage/' . $imagePath;
    }

    // تعيين تاريخ النشر إذا لم يُحدد
    if (!$validated['published_at']) {
        $validated['published_at'] = now();
    }

    // تحديث المقال
    $article->update($validated);

    return redirect()->route('articles.admin')->with('success', 'تم تعديل المقال بنجاح.');
}



public function show($id)
{
    $article = \App\Models\Article::with('category')->findOrFail($id);

    // جلب مقالات من نفس التصنيف مع استثناء المقال الحالي
    $relatedArticles = \App\Models\Article::where('category_id', $article->category_id)
        ->where('id', '!=', $article->id)
        ->latest()
        ->take(3)
        ->get();

    return view('articles.show', compact('article', 'relatedArticles'));
}

public function create()
{
    $categories = \App\Models\Category::all();
    return view('articles.create', compact('categories'));
}


public function store(Request $request)
{
    // التحقق من صحة البيانات
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'slug' => 'required|unique:articles,slug',
        'keywords' => 'nullable|string',
        'published_at' => 'nullable|date',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // رفع الصورة إن وجدت
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $validated['image'] = '/storage/' . $imagePath;
    }

    // تعيين تاريخ النشر إذا لم يُحدد
    if (!$validated['published_at']) {
        $validated['published_at'] = now();
    }

    // إنشاء المقال
    \App\Models\Article::create($validated);

    return redirect()->route('articles.admin')->with('success', 'تمت إضافة المقال بنجاح.');
}


public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $adminRoutes = ['adminIndex', 'create', 'store', 'edit', 'update', 'destroy'];

            if (in_array($request->route()->getActionMethod(), $adminRoutes) && !session('is_admin')) {
                return redirect()->route('login');
            }

            return $next($request);
        });
    }
    public function destroy($id)
{
    $article = \App\Models\Article::findOrFail($id);
    $article->delete();

    return redirect()->route('articles.admin')->with('success', 'Article deleted successfully.');
}

public function category($slug)
{
    $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
    $articles = \App\Models\Article::where('category_id', $category->id)
        ->latest()
        ->get();

    return view('category', compact('articles', 'category'));
}



 
}
