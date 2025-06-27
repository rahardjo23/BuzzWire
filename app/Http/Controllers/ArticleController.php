<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display the home page with LOCAL articles ONLY
     */
    public function home(Request $request)
    {
        // Get filter parameters for local articles only
        $categoryId = $request->get('category');
        $search = $request->get('search');

        // Get categories for filter
        $categories = Category::orderBy('name')->get();

        // --- HANYA BERITA LOKAL ---
        $featuredArticle = null;
        $latestArticles = collect();

        $query = Article::where('is_published', 1)
            ->with(['user', 'category']);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $featuredArticle = $query->orderBy('publish_time', 'desc')->first();
        
        $latestArticles = Article::where('is_published', 1)
            ->with(['user', 'category'])
            ->when($featuredArticle, function($query) use ($featuredArticle) {
                return $query->where('id', '!=', $featuredArticle->id);
            })
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderBy('publish_time', 'desc')
            ->get();

        return view('welcome', compact('featuredArticle', 'latestArticles', 'categories'));
    }

    /**
     * Display LOCAL news ONLY (Dedicated page) - Replaces external news
     */
    public function localNews(Request $request)
    {
        $categoryId = $request->get('category');
        $search = $request->get('search');

        // Get categories for filter
        $categories = Category::orderBy('name')->get();

        // Build query for local articles
        $query = Article::where('is_published', 1)
            ->with(['user', 'category']);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $localArticles = $query->orderBy('publish_time', 'desc')->paginate(12);

        return view('local-news', compact('localArticles', 'categories'));
    }

    /**
     * Get trending news - LOCAL ARTICLES ONLY
     */
    public function trending(Request $request)
    {
        $categoryId = $request->get('category');
        $period = $request->get('period', 'all');
        $search = $request->get('search');

        // Get categories for filter
        $categories = Category::orderBy('name')->get();

        // Build query for local articles only
        $query = Article::where('is_published', 1)
            ->with(['user', 'category']);

        // Apply category filter
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Apply time period filter
        switch ($period) {
            case 'day':
                $query->where('created_at', '>=', now()->subDay());
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('created_at', '>=', now()->subMonth());
                break;
            case 'year':
                $query->where('created_at', '>=', now()->subYear());
                break;
            default:
                // 'all' - no time filter
                break;
        }

        // Get articles ordered by views (trending) then by publish time
        $articles = $query->orderBy('views', 'desc')
            ->orderBy('publish_time', 'desc')
            ->paginate(15);

        return view('trending', compact('articles', 'categories', 'period', 'categoryId', 'search'));
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
     * Method untuk membuat kategori dengan ID tetap
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
        
        Log::info('Kategori telah dibuat dengan ID tetap');
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
        Log::info('Categories loaded for publish form: ' . $categories->count());
        foreach ($categories as $category) {
            Log::info("Category ID: {$category->id}, Name: {$category->name}");
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
    public function destroy(Article $article)
    {
        // Check if the user owns the article
        if (auth()->user()->id !== $article->user_id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Delete the cover image if it exists
            if ($article->cover_image && Storage::exists('public/' . $article->cover_image)) {
                Storage::delete('public/' . $article->cover_image);
            }

            // Delete the article
            $article->delete();

            // Redirect back to profile with success message
            return redirect()->route('profile')
                ->with('success', 'Article deleted successfully.');

        } catch (\Exception $e) {
            // If there's an error, redirect back with error message
            return redirect()->route('profile')
                ->with('error', 'Failed to delete article. Please try again.');
        }
    }

    // Also add this method if you don't have articles.index view
    public function index()
    {
        $articles = Article::where('is_published', 1)
            ->with(['user', 'category'])
            ->latest('publish_time')
            ->paginate(12);

        return view('articles.index', compact('articles'));
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
    public function byCategory($categoryId)
    {
        // Find category by ID
        $category = Category::findOrFail($categoryId);
        
        $articles = Article::where('category_id', $category->id)
            ->where('is_published', 1)
            ->with(['user', 'category'])
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

    /**
     * Advanced search with filters and sorting
     */
    public function advancedSearch(Request $request)
    {
        $query = $request->input('q');
        $category = $request->input('category');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $author = $request->input('author');
        $sort = $request->input('sort', 'relevance');
        $perPage = $request->input('per_page', 12);
        
        $articlesQuery = Article::where('is_published', 1)
            ->with(['user', 'category']);
            
        // Text search
        if ($query) {
            $articlesQuery->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            });
        }
        
        // Category filter
        if ($category && $category !== 'all') {
            $articlesQuery->where('category_id', $category);
        }
        
        // Date range filter
        if ($dateFrom) {
            $articlesQuery->where('publish_time', '>=', Carbon::parse($dateFrom));
        }
        if ($dateTo) {
            $articlesQuery->where('publish_time', '<=', Carbon::parse($dateTo)->endOfDay());
        }
        
        // Author filter
        if ($author) {
            $articlesQuery->whereHas('user', function($q) use ($author) {
                $q->where('name', 'like', "%{$author}%");
            });
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
            case 'title_az':
                $articlesQuery->orderBy('title', 'asc');
                break;
            case 'title_za':
                $articlesQuery->orderBy('title', 'desc');
                break;
            default: // relevance
                $articlesQuery->orderBy('publish_time', 'desc');
                break;
        }
        
        $articles = $articlesQuery->paginate($perPage);
        $categories = Category::orderBy('name')->get();
        
        return view('articles.advanced-search', compact(
            'articles', 'query', 'categories', 'category', 'dateFrom', 
            'dateTo', 'author', 'sort', 'perPage'
        ));
    }

    /**
     * Get article analytics data
     */
    public function analytics(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view analytics for this article.');
        }

        // Simple analytics data - you can expand this
        $analytics = [
            'total_views' => $article->views ?? 0,
            'comments_count' => $article->comments()->count(),
            'publish_date' => $article->publish_time,
            'days_since_published' => $article->publish_time ? 
                Carbon::parse($article->publish_time)->diffInDays(now()) : 0,
            'category' => $article->category->name ?? 'Uncategorized',
            'word_count' => str_word_count(strip_tags($article->content)),
            'reading_time' => ceil(str_word_count(strip_tags($article->content)) / 200), // Assuming 200 words per minute
        ];

        return view('articles.analytics', compact('article', 'analytics'));
    }

    /**
     * Duplicate an existing article (useful for templates)
     */
    public function duplicate(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to duplicate this article.');
        }

        $newArticle = $article->replicate();
        $newArticle->title = 'Copy of ' . $article->title;
        $newArticle->is_published = false;
        $newArticle->publish_time = null;
        $newArticle->views = 0;
        $newArticle->created_at = now();
        $newArticle->updated_at = now();
        
        $newArticle->save();

        return redirect()->route('articles.edit', $newArticle)
            ->with('success', 'Article duplicated successfully! You can now edit and publish it.');
    }

    /**
     * Archive/unarchive article
     */
    public function toggleArchive(Article $article)
    {
        // Check if the current user is the author
        if ($article->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to archive this article.');
        }

        $article->is_archived = !($article->is_archived ?? false);
        $article->save();

        $status = $article->is_archived ? 'archived' : 'unarchived';
        
        return redirect()->back()
            ->with('success', "Article has been {$status} successfully.");
    }
}