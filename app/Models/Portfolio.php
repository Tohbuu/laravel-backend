<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id', 'title', 'about', 'theme_color', 
        'background_image', 'social_links', 'custom_sections'
    ];

    protected $casts = [
        'social_links' => 'array',
        'custom_sections' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}