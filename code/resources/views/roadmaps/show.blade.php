@extends('layout.app')

@section('content')
    <div class="section">
        <a href="{{ route('roadmaps.index') }}" class="back-link">← Back to roadmaps</a>

        {{-- Header section --}}
        <div class="roadmap-detail-header">
            <div>
                <h1>{{ $roadmap->title }}</h1>
                <p class="description">{{ $roadmap->description }}</p>
                @if($roadmap->is_featured)
                    <span class="badge">Featured roadmap</span>
                @else
                    <span class="badge">By {{ $roadmap->user->name }}</span>
                @endif
            </div>

            {{-- Edit/Delete buttons --}}
            @auth
                @if($roadmap->user_id === auth()->id())
                    <div class="roadmap-detail-actions">
                        <a href="{{ route('roadmaps.edit', $roadmap) }}" class="btn-secondary">Edit roadmap</a>
                        <form method="POST" action="{{ route('roadmaps.destroy', $roadmap) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete roadmap</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        {{-- Progress bar --}}
        @auth
            @php
                $percentage = auth()->user()->roadmapProgress($roadmap);
                $completed  = $roadmap->tutorials->filter(fn($t) => auth()->user()->hasCompleted($t->id, $roadmap->id))->count();
                $total      = $roadmap->tutorials->count();
            @endphp
            <div class="roadmap-detail-progress">
                <div class="roadmap-progress">
                    <span>Progress</span>
                    <span>{{ $completed }}/{{ $total }} ({{ $percentage }}%)</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:{{ $percentage }}%"></div>
                </div>
            </div>
        @endauth

        {{-- Tutorial list --}}
        <h2>Tutorials in this roadmap</h2>
        <div class="roadmap-tutorial-items">
            @foreach($roadmap->tutorials as $tutorial)
                <div class="roadmap-tutorial-item {{ auth()->check() && auth()->user()->hasCompleted($tutorial->id, $roadmap->id) ? 'completed' : '' }}">

                    {{-- Order number --}}
                    <div class="roadmap-tutorial-order">
                        {{ $tutorial->pivot->order }}
                    </div>

                    {{-- Tutorial info --}}
                    <div class="roadmap-tutorial-info">
                        <h3>{{ $tutorial->title }}</h3>
                        <div class="tutorial-detail-badges">
                            <span class="badge">{{ $tutorial->category->name }}</span>
                            <span class="badge">{{ $tutorial->difficulty }}</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="roadmap-tutorial-item-actions">
                        <a href="{{ route('tutorials.show', $tutorial) }}" class="btn-primary">Watch →</a>
                        @auth
                            <form method="POST" action="{{ route('progress.toggle', [$roadmap, $tutorial]) }}">
                                @csrf
                                @if(auth()->user()->hasCompleted($tutorial->id, $roadmap->id))
                                    <button type="submit" class="btn-completed">Completed</button>
                                @else
                                    <button type="submit" class="btn-secondary">Mark complete</button>
                                @endif
                            </form>
                        @endauth
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
