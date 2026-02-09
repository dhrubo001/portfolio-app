<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'user_id',
        'address',
        'skills',
        'bio',
        'projects',
        'slug'
    ];

    protected $casts = [
        'projects' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($portfolio) {
            $baseSlug = Str::slug($portfolio->name);
            $slug = $baseSlug;

            $i = 1;
            while (static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }

            $portfolio->slug = $slug;
        });
    }
}
