<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortenUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_url',
        'shortened_url',
        'page_title',
        'visit_count',
    ];
}
