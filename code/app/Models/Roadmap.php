<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'is_featured'];

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class, 'roadmap_tutorial')
            ->withPivot('order')
            ->orderByPivot('order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeIsFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUserCreated($query)
    {
        return $query->whereNotNull('user_id');
    }
}
