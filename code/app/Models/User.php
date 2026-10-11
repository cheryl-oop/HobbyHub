<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tutorial;
use Laravel\Prompts\Progress;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function savedTutorials(){
        return $this->belongsToMany(Tutorial::class, 'saved_tutorials');
    }
    public function roadmap(){
        return $this->hasMany(Roadmap::class);
    }
    public function progress(){
        return $this->hasMany(RoadmapTutorialProgress::class);
    }
    public function hasCompleted(int $tutorialId, int $roadmapId): bool{
        return $this->progress()
            ->where('tutorial_id', $tutorialId)
            ->where('roadmap_id', $roadmapId)
            ->exists();
    }
    // Hulpfunctie om de de completed percentage te hebben
    public function roadmapProgress(Roadmap $roadmap): int
    {
        $total = $roadmap->tutorials->count();

        if ($total === 0) return 0;

        $completed = $this->progress()
            ->where('roadmap_id', $roadmap->id)
            ->count();

        return (int) round(($completed / $total) * 100);
    }
    // Unfinished roadmaps
    public function suggestedRoadmaps(int $limit = 4)
    {
        $roadmaps = Roadmap::with('tutorials')->get();

        $unfinished = $roadmaps->filter(function ($roadmap) {

            return $this->roadmapProgress($roadmap) < 100;

        });

        return $unfinished->take($limit);
    }
    public function nextTutorial(Roadmap $roadmap): ?Tutorial
    {
        return $roadmap->tutorials
            ->first(fn($tutorial) => !$this->hasCompleted($tutorial->id, $roadmap->id));
    }
    public function recentSavedTutorials(int $limit = 4)
    {
        return $this->savedTutorials()
            ->latest('saved_tutorials.created_at')
            ->take($limit)
            ->get();
    }
}
