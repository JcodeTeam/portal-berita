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

        $posts = News::with('category','author')->where('is_published', true)->latest()->paginate(9);
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

        return view('pages.show', compact('news'));
    }

}
