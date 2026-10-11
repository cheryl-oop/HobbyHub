@extends('layout.app')

@section('content')

    <div class="section">
        <a href="{{ route('home') }}" class="back-link">← Back to overview</a>

        <div class="tutorial-detail">

            <div class="tutorial-detail-left">
                <img src="{{ $tutorial->getThumbnailUrl() }}" alt="{{ $tutorial->title }}">
                <div class="tutorial-detail-badges">
                    <span class="badge">{{ $tutorial->category->name }}</span>
                    <span class="badge">{{ $tutorial->difficulty }}</span>
                </div>
                <x-save-button :tutorial="$tutorial" />
            </div>

            <div class="tutorial-detail-right">
                <h1>{{ $tutorial->title }}</h1>
                <p>{{ $tutorial->description }}</p>
                <a href="{{ $tutorial->video_url }}" target="_blank" class="btn-primary">
                    ▶ Watch tutorial
                </a>
            </div>

        </div>
    </div>

@endsection
