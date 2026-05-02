<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'long_description', 'thumbnail',
        'demo_url', 'github_url', 'technologies', 'images', 'category',
        'featured', 'is_active', 'order'
    ];

    protected $casts = [
        'technologies' => 'array',
        'images' => 'array',
        'featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}
