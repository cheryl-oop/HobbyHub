<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class SavedTutorialController extends Controller
{
    //Tutorials kunnen gevonden worden (uit database)
    public function index(){
        $savedTutorials = auth()->user()->savedTutorials()->latest()->get();
        return view('saved', compact('savedTutorials'));
    }
    //Tutorials kunnen toegevoegd worden
    public function store(Tutorial $tutorial){
        auth()->user()->savedTutorials()->attach($tutorial->id);
        return back();
    }
    //Tutorials kunnen uit de lijst gehaald worden
    public function delete(Tutorial $tutorial){
        auth()->user()->savedTutorials()->detach($tutorial);
        return back();
    }
}
