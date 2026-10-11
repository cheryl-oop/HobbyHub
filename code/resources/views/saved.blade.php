@extends('layout.app')

@section('content')
    <div class="section">
    <a class="back-button" href="{{ route('home') }}">← Back to home</a>
    <h1>Saved tutorials</h1>

    @if($savedTutorials->isEmpty())
        <p>You haven't saved tutorials yet.</p>
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
    @endif
    </div>
@endsection
