<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeLive extends Model
{
    protected $fillable = [
        'title',
        'youtube_url',
        'thumbnail',
        'is_live',
        'status',
    ];

    public function getYoutubeIdAttribute()
{
    parse_str(parse_url($this->youtube_url, PHP_URL_QUERY), $query);

    return $query['v'] ?? null;
}

}