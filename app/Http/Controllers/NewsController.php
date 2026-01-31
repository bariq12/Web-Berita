<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug){
        $news = \App\Models\News::where('slug', $slug)->firstOrFail();
        $latestNews = \App\Models\News::orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.news.show', compact('news', 'latestNews'));
    }

    public function category($slug){
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $newsInCategory = \App\Models\News::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        $latestNews = \App\Models\News::orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.news.category', compact('category', 'newsInCategory', 'latestNews'));
    }
}
