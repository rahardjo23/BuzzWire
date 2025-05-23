<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display the home page with featured and latest articles
     * TAMBAHAN METHOD HOME YANG HILANG
     */
    public function home()
    {
        // Ambil artikel featured (artikel terbaru yang dipublish)
        $featuredArticle = Article::where('is_published', 1)
            ->with(['user', 'category'])
            ->orderBy('publish_time', 'desc')
            ->first();
        
        // Ambil 3-4 artikel terbaru untuk sidebar (selain featured article)
        $latestArticles = Article::where('is_published', 1)
            ->with(['user', 'category'])
            ->when($featuredArticle, function($query) use ($featuredArticle) {
                return $query->where('id', '!=', $featuredArticle->id);
            })
            ->orderBy('publish_time', 'desc')
            ->take(4)
            ->get();
        
        return view('welcome', compact('featuredArticle', 'latestArticles'));
    }

    public function index()
    {
        $articles = Article::where('is_published', 1)
            ->orderBy('publish_time', 'desc')
            ->paginate(10);
        
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published && $article->user_id !== Auth::id()) {
            abort(403, 'This article is not published yet.');
        }
        
        // Increment view count
        if (Auth::guest() || Auth::id() !== $article->user_id) {
            $article->incrementViewCount();
        }
        
        // Load comments with user relationship untuk efisiensi
        $article->load(['comments.user', 'user', 'category']);
        
        return view('article', compact('article'));
    }

    /**
     * Method tambahan untuk membuat kategori dengan ID tetap
     */
    private function createCategoriesWithFixedIds()
    {
        // Daftar kategori dengan ID tetap
        $categories = [
            1 => ['name' => 'Politik', 'description' => 'Berita dan analisis tentang peristiwa dan kebijakan politik'],
            2 => ['name' => 'Teknologi', 'description' => 'Berita teknologi terbaru, ulasan, dan inovasi'],
            3 => ['name' => 'Kesehatan', 'description' => 'Berita medis, tips kesehatan, dan penelitian kesehatan'],
            4 => ['name' => 'Olahraga', 'description' => 'Berita olahraga, hasil, dan analisis'],
            5 => ['name' => 'Kriminal', 'description' => 'Berita kriminal, investigasi, dan proses hukum'],
            6 => ['name' => 'Sains', 'description' => 'Penemuan ilmiah, penelitian, dan inovasi'],
            7 => ['name' => 'Ekonomi', 'description' => 'Berita bisnis dan ekonomi, analisis pasar'],
            8 => ['name' => 'Wisata', 'description' => 'Destinasi wisata, tips, dan pengalaman perjalanan'],
        ];

        // Reset autoincrement jika perlu
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('TRUNCATE TABLE categories');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Buat kategori dengan ID yang tetap
        foreach ($categories as $id => $data) {
            DB::table('categories')->insert([
                'id' => $id,
                'name' => $data['name'],
                'description' => $data['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        \Log::info('Kategori telah dibuat dengan ID tetap');
    }

    /**
     * Route admin untuk memastikan kategori ada dengan ID tetap
     */
    public function ensureCategories()
    {
        $this->createCategoriesWithFixedIds();
        return redirect()->back()->with('success', 'Kategori default telah dibuat dengan ID tetap!');
    }

    /**
     * Modifikasi method create untuk menggunakan kategori dengan ID tetap
     */
    public function create()
    {
        // Cek apakah kategori sudah ada dan tepat jumlahnya
        $categoryCount = Category::count();
        
        // Jika kategori kurang dari 8 atau ada masalah sequence ID
        if ($categoryCount !== 8) {
            $this->createCategoriesWithFixedIds();
        }
        
        // Ambil semua kategori
        $categories = Category::orderBy('id', 'asc')->get();
        
        // Debug info untuk membantu troubleshooting
        \Log::info('Categories loaded for publish form: ' . $categories->count());
        foreach ($categories as $category) {
            \Log::info("Category ID: {$category->id}, Name: {$category->name}");
        }
        
        return view('publish', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:10|max:100',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|min:100',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request->content;
        $article->user_id = Auth::id();
        $article->is_published = $request->input('is_published') == '1' ? true : false;
        
        // Set publish time if published
        if ($article->is_published) {
            $article->publish_time = Carbon::now();
        }

        // Handle image upload
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('articles', $filename, 'public');
            $article->cover_image = $path;
        }

        $article->save();

        $message = $article->is_published 
            ? 'Article published successfully!' 
            : 'Article saved as draft!';

        return redirect()->route('articles.show', $article)
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this article.');
        }

        // Pastikan kategori ada
        $categoryCount = Category::count();
        if ($categoryCount !== 8) {
            $this->createCategoriesWithFixedIds();
        }

        $categories = Category::orderBy('id', 'asc')->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this article.');
        }

        // Pastikan kategori ada dengan ID yang benar sebelum validasi
        $categoryCount = Category::count();
        if ($categoryCount !== 8) {
            $this->createCategoriesWithFixedIds();
        }

        $request->validate([
            'title' => 'required|min:10|max:100',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|min:100',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request->content;
        
        // Check if we're changing published status
        $wasPublished = $article->is_published;
        $article->is_published = $request->input('is_published') == '1' ? true : false;
        
        // Set publish time if newly published
        if (!$wasPublished && $article->is_published) {
            $article->publish_time = Carbon::now();
        }

        // Handle image upload
        if ($request->hasFile('cover_image')) {
            // Delete the old image if it exists
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            
            $image = $request->file('cover_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('articles', $filename, 'public');
            $article->cover_image = $path;
        }

        $article->save();

        $message = $article->is_published 
            ? 'Article updated and published!' 
            : 'Article updated and saved as draft!';

        return redirect()->route('articles.show', $article)
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
   /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this article.');
        }

        // Delete the cover image if it exists
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();

        // Redirect to profile instead of articles.index
        return redirect()->route('profile')
            ->with('success', 'Article deleted successfully!');
    }

    /**
     * Publish an existing draft article.
     */
    public function publish(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to publish this article.');
        }

        $article->is_published = true;
        $article->publish_time = Carbon::now();
        $article->save();

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article published successfully!');
    }

    /**
     * Display articles by category.
     */
    public function byCategory(Category $category)
    {
        $articles = Article::where('category_id', $category->id)
            ->where('is_published', 1)
            ->orderBy('publish_time', 'desc')
            ->paginate(10);
        
        return view('articles.category', compact('articles', 'category'));
    }

    /**
     * Mendapatkan daftar artikel milik user saat ini
     */
    public function myArticles()
    {
        $publishedArticles = Article::where('user_id', Auth::id())
            ->where('is_published', 1)
            ->orderBy('publish_time', 'desc')
            ->get();
            
        $draftArticles = Article::where('user_id', Auth::id())
            ->where('is_published', 0)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('articles.my-articles', compact('publishedArticles', 'draftArticles'));
    }

    /**
     * Mendapatkan artikel terpopuler berdasarkan jumlah view
     */
    public function popular()
    {
        $articles = Article::where('is_published', 1)
            ->orderBy('views', 'desc')
            ->limit(10)
            ->get();
            
        return view('articles.popular', compact('articles'));
    }

    /**
     * Mencari artikel berdasarkan kata kunci (Enhanced Version)
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $category = $request->input('category');
        $sort = $request->input('sort', 'relevance');
        
        if (empty($query)) {
            return redirect()->route('home')->with('info', 'Please enter a search term.');
        }
        
        $articlesQuery = Article::where('is_published', 1)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->with(['user', 'category']);
            
        // Filter by category if selected
        if ($category && $category !== 'all') {
            $articlesQuery->where('category_id', $category);
        }
        
        // Apply sorting
        switch ($sort) {
            case 'newest':
                $articlesQuery->orderBy('publish_time', 'desc');
                break;
            case 'oldest':
                $articlesQuery->orderBy('publish_time', 'asc');
                break;
            case 'popular':
                $articlesQuery->orderBy('views', 'desc');
                break;
            default: // relevance
                $articlesQuery->orderBy('publish_time', 'desc');
                break;
        }
            
        $articles = $articlesQuery->paginate(12);
        
        // Get categories for filter dropdown
        $categories = Category::orderBy('name')->get();
        
        return view('articles.search', compact('articles', 'query', 'categories', 'category', 'sort'));
    }

    /**
     * API endpoint untuk search suggestions
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $suggestions = Article::where('is_published', 1)
            ->where('title', 'like', "%{$query}%")
            ->with('category')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get()
            ->map(function($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'category' => $article->category->name ?? 'Uncategorized'
                ];
            });
            
        return response()->json($suggestions);
    }
}