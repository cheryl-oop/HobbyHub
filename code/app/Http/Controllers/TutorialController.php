<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\Category;
use App\Models\User;


class TutorialController extends Controller
{
    //index neemt de aanvraag van de gebruiker (filter webpagina),
    //checkt dat er een categorie en/of moeilijkheidsgraad is
    //Stuurt dan de juiste tutorials naar de home
    //Request is de aanvraag van de gebruiker (Url)
    public function index(Request $request)
    {   //query() maakt aanvraag aan.
        // Hier maken we een aanvraag voor categorie en difficulty
        $query = Tutorial::query();
        //filed() checks of de request een categorie heeft (heeft de gebruiker iets geselctioneerd),
        // zo ja een extra conditie voor de query (SELECT * FROM tutorials WHERE difficulty = 'difficulty')
        // Beide filters geselectioneerd (SELECT * FROM tutorials WHERE difficulty = 'difficulty' AND category = 'Category')
        if ($request->filled('category')) {
            $query = $query->where('category_id', $request->category);
        }
        if ($request->filled('difficulty')) {
            $query = $query->where('difficulty', $request->difficulty);
        }

        $tutorials = $query->latest()->get();
        $categories = Category::all();
        $difficulties = Tutorial::select('difficulty')->distinct()->pluck('difficulty');
        $suggestedRoadmaps = auth()->check()
            ? auth()->user()->suggestedRoadmaps(3)
            : collect();
        $savedTutorials = auth()->user()
            ? auth()->user()
            ->recentSavedTutorials()
            : collect();
        return view('home', compact('tutorials', 'categories', 'difficulties', 'suggestedRoadmaps', 'savedTutorials'));
    }

    public function show(Tutorial $tutorial)
    {
        return view('tutorials.show', compact('tutorial'));
    }
}
