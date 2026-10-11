@extends('layout.app')

@section('content')
    <div class="section">
        <a href="{{ route('roadmaps.index') }}" class="back-link">← Back to roadmaps</a>

        <h1>Create a roadmap</h1>

        <form method="POST" action="{{ route('roadmaps.store') }}" class="roadmap-form">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="Give your roadmap a title"
                       required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description"
                          name="description"
                          placeholder="What will people learn in this roadmap?"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="roadmap-form-columns">

                {{-- Left: selected tutorials --}}
                <div class="roadmap-form-selected">
                    <h2>Selected tutorials</h2>
                    <div id="selected-container">
                        <p class="empty-message">No tutorials selected yet.</p>
                    </div>
                </div>

                {{-- Right: tutorial picker --}}
                <div class="roadmap-form-picker">
                    <h2>Pick tutorials</h2>
                    @foreach($tutorials as $categoryName => $categoryTutorials)
                        <div class="picker-category">
                            <h3>{{ $categoryName }}</h3>
                            <div class="picker-cards-grid">
                                @foreach($categoryTutorials as $tutorial)
                                    <div class="picker-card"
                                         id="picker-{{ $tutorial->id }}"
                                         data-id="{{ $tutorial->id }}"
                                         data-title="{{ $tutorial->title }}"
                                         data-category="{{ $tutorial->category->name }}"
                                         data-difficulty="{{ $tutorial->difficulty }}"
                                         data-thumbnail="{{ $tutorial->getThumbnailUrl() }}">
                                        <input type="checkbox"
                                               class="tutorial-checkbox"
                                               name="tutorials[]"
                                               value="{{ $tutorial->id }}"
                                               id="tutorial-{{ $tutorial->id }}"
                                               hidden>
                                        <img src="{{ $tutorial->getThumbnailUrl() }}" alt="{{ $tutorial->title }}">
                                        <div class="picker-card-info">
                                            <span class="picker-card-title">{{ $tutorial->title }}</span>
                                            <div class="tutorial-detail-badges">
                                                <span class="badge">{{ $tutorial->category->name }}</span>
                                                <span class="badge">{{ $tutorial->difficulty }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <button type="submit" class="btn-primary">Create roadmap</button>
        </form>
    </div>

    <script src="{{ asset('js/roadmap-functions.js') }}"></script>
@endsection
