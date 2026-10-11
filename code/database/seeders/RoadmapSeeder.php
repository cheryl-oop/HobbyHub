<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roadmap;
use App\Models\Tutorial;

//Tutorial::where('title', 'YOUR TITLE')->first().
class RoadmapSeeder extends Seeder
{
    public function run(): void
    {
        //Neemt al de tutorials
        //$tutorials = Tutorial::all();
        ////////////////////////////////Roadmap Coding for beginners ///////////////////////////
        $roadmap1 = Roadmap::create([
            'title'       => 'Getting started: Coding',
            'description' => 'A great starting point for beginners who wants to learn about coding!',
            'is_featured' => true,
            'user_id'     => null,
        ]);
        $tutorial1 = Tutorial::where('title', 'Learn To Code Like a GENIUS and Not Waste Time')->first();
        $tutorial2 = Tutorial::where('title', 'HTML & CSS Full Course for free')->first();
        $tutorial3 = Tutorial::where('title', 'React Full Course (FREE)')->first();
        $roadmap1->tutorials()->attach($tutorial1->id, ['order' => 1]);
        $roadmap1->tutorials()->attach($tutorial2->id, ['order' => 2]);
        $roadmap1->tutorials()->attach($tutorial3->id, ['order' => 3]);

        $roadmap1 = Roadmap::create([
            'title'       => 'Creative Baby Steps',
            'description' => 'You want to try new things? Check these hobbies out!',
            'is_featured' => true,
            'user_id'     => null,
        ]);
        $tutorial1 = Tutorial::where('title', 'I’m begging you to write essays')->first();
        $tutorial2 = Tutorial::where('title', 'ABSOLUTE Beginner Basics.. Blender For Noobs 2025')->first();
        $tutorial3 = Tutorial::where('title', 'Foundations for Solid Drawing [Character Drawing Basics Pt 1]')->first();
        $roadmap1->tutorials()->attach($tutorial1->id, ['order' => 1]);
        $roadmap1->tutorials()->attach($tutorial2->id, ['order' => 2]);
        $roadmap1->tutorials()->attach($tutorial3->id, ['order' => 3]);
    }
}
