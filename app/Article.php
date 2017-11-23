<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'art_title', 'art_content', 'art_author',
    ];
}
