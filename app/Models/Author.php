<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'username',
        'employee_code',
        'bio',
    ];


    public function getRouteKeyName()
    {
        return 'username';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function getProfileUrlAttribute()
    {
        return route('author.username', $this);
    }
}
