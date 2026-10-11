<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roadmap;
use App\Models\RoadmapTutorialProgress;
use App\Models\Tutorial;

class ProgressController extends Controller
{
    public function toggle(Roadmap $roadmap, Tutorial $tutorial)
    {
        $user = auth()->user();

        $progress = RoadmapTutorialProgress::where('user_id', $user->id)
            ->where('roadmap_id', $roadmap->id)
            ->where('tutorial_id', $tutorial->id)
            ->first();

        if ($progress) {
            // uncheck
            $progress->delete();
        } else {
            // nog niet completed, check het



            RoadmapTutorialProgress::create([
                'user_id'      => $user->id,
                'roadmap_id'   => $roadmap->id,
                'tutorial_id'  => $tutorial->id,
                'completed_at' => now(),
            ]);
        }

        return back();
    }
}
