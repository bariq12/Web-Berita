<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $banners = \App\Models\Banner::all();
        $featured = \App\Models\News::where('is_featured', true)->get();
        $news = \App\Models\News::latest()->get()->take(4);
        $authors = \App\Models\Author::all()->take(5);
        return view('pages.landing', compact('banners', 'featured', 'news', 'authors'));
    }
}
