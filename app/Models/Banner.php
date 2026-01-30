<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'news_id',
    ];
    public function News(){
        return $this->belongsTo(News::class, 'news_id');
    }
}
