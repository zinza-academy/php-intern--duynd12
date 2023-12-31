<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'post_id', 'user_id', 'like_count', 'resolve'];

    protected $casts = [
        'resolve' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'comment_user');
    }

    public function isResolve()
    {
        return $this->resolve == true;
    }

    public function scopeHasResolvedComment($query)
    {
        return $query->where('resolve', true);
    }
}
