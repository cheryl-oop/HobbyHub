<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RoadmapTutorialProgress;
use App\Models\User;

class Tutorial extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'video_url', 'difficulty'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function savedByUsers(){
        return $this->belongsToMany(User::class, 'saved_tutorials');
    }
    public function roadmap(){
        return $this->belongsToMany(Roadmap::class);
    }
    //This function was AI generated and modified by me
    public function getThumbnailUrl(): string
    {
        // Format 1: https://www.youtube.com/watch?v=VIDEO_ID
        // Format 2: https://youtu.be/VIDEO_ID?si=XXXXX
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches);

        $videoId = $matches[1] ?? null;

        if ($videoId) {
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }

        return asset('images/placeholder.jpg');
    }
    public function roadmapProgress()
    {
        return $this->hasMany(RoadmapTutorialProgress::class);
    }
}
