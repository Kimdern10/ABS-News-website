<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'user_id',
        'category_id',

        'title',
        'slug',
        'excerpt',
        'content',

        'image1',
        'image2',
        'image3',
        'image4',
        'image5',

        'featured',
        'breaking_news',
        'trending',
        'headline',
        'slider',
        'popular',

        'status',
        'published_at',
        'published_by',

        'author_name',
        'source',
        'reading_time',

        'allow_comments',

        'views',
        'likes',
        'shares',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'active',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'breaking_news' => 'boolean',
        'trending' => 'boolean',
        'headline' => 'boolean',
        'slider' => 'boolean',
        'popular' => 'boolean',
        'allow_comments' => 'boolean',
        'active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function comments()
{
    return $this->hasMany(Comment::class)
        ->whereNull('parent_id')
        ->with(['user','replies.user'])
        ->latest();
}

}