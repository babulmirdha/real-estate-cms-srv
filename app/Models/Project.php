<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{

    use HasFactory;

    protected $fillable = [
        'title','type','status','area','city','bedrooms','size_sqft','price',
        'lat','lng','images','amenities','video_url','description','is_published',
        'published_at','slug', // keep slug fillable so you can also set it manually if needed
    ];

    protected $casts = [
        'images' => 'array',
        'amenities' => 'array',
        'lat' => 'float',
        'lng' => 'float',
        'bedrooms' => 'integer',
        'size_sqft' => 'integer',
        'price' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $base = Str::slug($project->title ?: Str::random(8));
                $slug = $base;

                // ensure uniqueness
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base.'-'.Str::random(5);
                    // or: $slug = "{$base}-{$i++}";
                }
                $project->slug = $slug;
            }
        });
    }
}
