<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = [
        'author_id',
        'news_category_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'published_at',
    ];
    public function Author(){
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function newsCategory(){
        return $this->belongsTo(NewsCategory::class,'news_category_id');
    }
    public function Banners(){
        return $this->hasOne(Banner::class);
    }
}

