@extends('layout.app')

@section('content')
    <div class="section">
<h1>Welcome to HobbyHub</h1>
<p class="landing-description">
    HobbyHub is a platform for discovering, saving, and organizing tutorials for creative and technical hobbies. From 3D modeling and coding to art and baking,
    you can explore tutorials, create personalized learning roadmaps, and keep track of hobbies you want to try or improve!
</p>
@auth
    @if($suggestedRoadmaps->isNotEmpty())
            <h2>Continue learning</h2>

            <div class="roadmaps-container">
            @foreach($suggestedRoadmaps as $roadmap)
                    <a href="{{ route('roadmaps.show', $roadmap) }}" class="roadmap-card-link">
                        <div class="roadmap-card">
                            <div class="roadmap-card-header">
                                <h3>{{ $roadmap->title }}</h3>
                                <p>{{ $roadmap->description }}</p>
                            </div>

                            @auth
                                @php
                                    $percentage = auth()->user()->roadmapProgress($roadmap);
                                    $completed  = auth()->user()->progress()->where('roadmap_id', $roadmap->id)->count();
                                    $total      = $roadmap->tutorials->count();
                                @endphp
                                <div class="roadmap-progress">
                                    <span class="badge">{{ $completed }}/{{ $total }} tutorials completed</span>
                                    <span>{{ $percentage }}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:{{ $percentage }}%"></div>
                                </div>
                            @endauth

                            <ol class="roadmap-tutorial-list">
                                @foreach($roadmap->tutorials as $tutorial)
                                    <li>
                                        {{ $tutorial->title }}
                                        <span class="badge">{{ $tutorial->difficulty }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </a>
            @endforeach
                </div>
    @endif
@endauth

<h2>Your saved tutorials</h2>
@if($savedTutorials->isEmpty())
    <p>No saved tutorials yet.</p>
@else
    <div class="saved-tutorials-container">
        @foreach($savedTutorials as $tutorial)
            <div class="tutorial-card">
                <a class="tutorial-card-link" href="{{ route('tutorials.show', $tutorial) }}">
                    <img src="{{ $tutorial->getThumbnailUrl() }}" alt="{{ $tutorial->title }}">
                    <div class="card-meta">
                        <span class="badge">{{ $tutorial->category->name }}</span>
                        <span class="badge">{{ $tutorial->difficulty }}</span>
                    </div>
                    <h3>{{ $tutorial->title }}</h3>
                </a>
                <x-save-button :tutorial="$tutorial" />
            </div>
        @endforeach
    </div>

    <a href="{{ route('saved.index') }}">
        View all saved tutorials
    </a>
@endif
<h2>Tutorials</h2>
<form method="GET" action="{{ route('home') }}">
<select name="difficulty" onchange="this.form.submit()">
    <option value="">All difficulties</option>
    @foreach($difficulties as $difficulty)
        <option value="{{ $difficulty }}" {{ request('difficulty') == $difficulty ? 'selected' : '' }}> {{$difficulty}}</option>
    @endforeach
</select>

    <select name="category" onchange="this.form.submit()">
        <option value="">All categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

</form>
<div class="saved-tutorials-container">
@foreach ($tutorials as $tutorial)
    <div class="tutorial-card">
        <a class="tutorial-card-link" href="{{ route('tutorials.show', $tutorial) }}">
                <img src="{{ $tutorial->getThumbnailUrl() }}" alt="{{ $tutorial->title }}">
                <div class="card-meta">
                    <span class="badge">{{ $tutorial->category->name }}</span>
                    <span class="badge">{{ $tutorial->difficulty }}</span>
                </div>
                <h3>{{ $tutorial->title }}</h3>
        </a>
        <x-save-button :tutorial="$tutorial" />
    </div>
@endforeach
</div>
    </div>
    <script>
        // Save scroll position before reload
        window.addEventListener('beforeunload', () => {
            localStorage.setItem('scrollPosition', window.scrollY);
        });

        // Restore scroll position after reload
        window.addEventListener('load', () => {
            const scrollPosition = localStorage.getItem('scrollPosition');

            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
            }
        });
    </script>
@endsection

