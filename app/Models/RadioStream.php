<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadioStream extends Model
{
    protected $fillable = [
        'title',
        'stream_url',
        'is_live',
        'status'
    ];
}