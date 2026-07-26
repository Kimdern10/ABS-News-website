<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LiveNews extends Model
{
    protected $table = 'live_news';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_live',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }
}