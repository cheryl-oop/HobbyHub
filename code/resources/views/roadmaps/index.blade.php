@extends('layout.app')

@section('content')
    <div class="section">
    <h1>Roadmaps</h1>

    @if(auth()->check())
        <a class="btn-secondary"  href="{{ route('roadmaps.create') }}">+ Create your own roadmap</a>
    @else
        <a class="btn-secondary" href="{{ route('login') }}">+ Login to create a roadmap</a>
    @endif

    <h2>Featured roadmaps</h2>
    <div class="roadmaps-container">
    @forelse($featuredRoadmaps as $roadmap)
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
    @empty
        <p>No featured roadmaps yet.</p>
    @endforelse
    </div>

@auth
    <div class="roadmaps-container">
        <h2>Your roadmaps</h2>
    @forelse($userRoadmaps as $roadmap)
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
    @empty
        <p>No roadmaps yet. Create a fitting roadmap for your goals!</p>
    @endforelse
    </div>
        @endauth

    </div>
@endsection
