<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    public function index(Request $request){
        $search = $request->input('search');
        $news = \App\Models\News::orderBy('created_at', 'desc')->paginate(10);
        if ($search) {
            $news = \App\Models\News::where('title', 'like', "%$search%")->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('pages.news.index', compact('news'));
    }
    public function show($slug){
        $news = \App\Models\News::where('slug', $slug)->firstOrFail();
        $latestNews = \App\Models\News::orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.news.show', compact('news', 'latestNews'));
    }

    public function category($slug){
        $category = \App\Models\NewsCategory::where('slug', $slug)->firstOrFail();
        return view('pages.news.category', compact('category'));
    }
}
