<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'news_id',
        'is_published',
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'category_id',
    ];

    protected $primaryKey = 'news_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'news_id';
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getBeritaUrlAttribute()
    {
        return route('berita.show', [
            'year' => $this->created_at->format('Y'),
            'month' => $this->created_at->format('m'),
            'day' => $this->created_at->format('d'),
            'news_id' => $this->news_id,
            'slug' => $this->slug
        ]);
    }

    // public function getBeritaIdAttribute()
    // {
    //     return route('redaksi.edit', [
    //         'news_id' => $this->news_id,
    //     ]);
    // }

}
