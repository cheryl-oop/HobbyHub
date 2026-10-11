<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapTutorialProgress extends Model
{
    protected $fillable = ['user_id', 'roadmap_id', 'tutorial_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function roadmap(){
        return $this->belongsTo(Roadmap::class);
    }
    public function tutorial(){
        return $this->belongsTo(Tutorial::class);
    }
}
