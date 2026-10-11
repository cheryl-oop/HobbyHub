<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        // Split into featured and user created for the overview page
        $featuredRoadmaps = Roadmap::isFeatured()->with('tutorials')->get();
        $userRoadmaps = auth()->check()
            ? Roadmap::userCreated()->where('user_id', auth()->id())->with('tutorials', 'user')->get()
            : collect();

        return view('roadmaps.index', compact('featuredRoadmaps', 'userRoadmaps'));
    }

    public function show(Roadmap $roadmap)
    {
        if (!$roadmap->is_featured && $roadmap->user_id !== auth()->id()) {
            abort(403);
        }
        $roadmap->load('tutorials.category');
        return view('roadmaps.show', compact('roadmap'));
    }

    public function create()
    {
        $tutorials = Tutorial::with('category')
            ->get()
            ->groupBy(fn($tutorial) => $tutorial->category->name);

        return view('roadmaps.create', compact('tutorials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'tutorials'   => 'required|array|min:1',
        ]);

        $roadmap = Roadmap::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => auth()->id(),
            'is_featured' => false,
        ]);

        // ← remove the createMany line, only keep this
        foreach ($request->tutorials as $order => $tutorialId) {
            $roadmap->tutorials()->attach($tutorialId, ['order' => $order + 1]);
        }

        return redirect()->route('roadmaps.show', $roadmap);
    }

    public function destroy(Roadmap $roadmap)
    {
        if ($roadmap->user_id !== auth()->id()) {
            //Toont de verboden 403 pagina!!
            abort(403);
        }

        $roadmap->delete();
        return redirect()->route('roadmaps.index');
    }

    //Neemt tuturials
    public function edit(Roadmap $roadmap){
        if ($roadmap->user_id !== auth()->id()){
            abort(403);
        }
        $tutorials = Tutorial::with('category')
            ->get()
            ->groupBy(fn($tutorial) => $tutorial->category->name);

        $selectedTutorials = $roadmap->tutorials->map(fn($tutorial) => [
            'id' => $tutorial->id,
            'title' => $tutorial->title,
            'description' => $tutorial->description,
            'category' => $tutorial->category->name,
            'difficulty' => $tutorial->difficulty,
        ]);
        return view('roadmaps.edit', compact('roadmap', 'tutorials','selectedTutorials'));

    }
    public function update(Roadmap $roadmap, Request $request){
        if ($roadmap->user_id !== auth()->id()){
            abort(403);
        }
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'tutorials'   => 'required|array|min:1',
        ]);
        $roadmap->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
        //tutorials worden geplaatst in de nieuwe ordered lijst
        $roadmap->tutorials()->detach();
        foreach ($request->tutorials as $order => $tutorialId) {
            $roadmap->tutorials()->attach($tutorialId, ['order' => $order + 1]);
        }
        return redirect()->route('roadmaps.show', $roadmap);

    }
}
