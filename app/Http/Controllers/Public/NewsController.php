<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index()
    {
        $categories = NewsCategory::all();

        $featuredPost = News::latest()->where('is_published', true)->first();

        $trendingPost = News::where('is_published', true)->orderByDesc('views')->first();

        $posts = News::with('category', 'author')->where('is_published', true)->latest()->paginate(9);
        return view('pages.index', compact('posts', 'categories', 'featuredPost', 'trendingPost'));
    }

    public function show($year, $month, $day, $news_id, $slug)
    {
        $news = News::with('author', 'category')->where('slug', $slug)
            ->where('news_id', $news_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereDay('created_at', $day)
            ->firstOrFail();

        $news->increment('views');

        $categories = NewsCategory::orderBy('title')->get();

        return view('pages.show', compact('news', 'categories'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();

        $newsList = News::where('category_id', $category->id)
            ->with('author')
            ->latest()
            ->paginate(6);

        $categories = NewsCategory::orderBy('title')->get();

        return view('pages.category', compact('category', 'newsList', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $categories = NewsCategory::orderBy('title')->get();

        $results = News::with('category', 'author')
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.search', compact('results', 'query', 'categories'));
    }
}
