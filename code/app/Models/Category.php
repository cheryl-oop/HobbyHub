<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_url'];

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }
}
