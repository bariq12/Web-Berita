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
}
