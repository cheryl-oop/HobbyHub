@extends('layout.app')

@section('content')
    <div class="section">
        <a href="{{ route('roadmaps.show', $roadmap) }}" class="back-link">← Back to roadmap</a>

        <h1>Edit roadmap</h1>

        <form method="POST" action="{{ route('roadmaps.update', $roadmap) }}" class="roadmap-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $roadmap->title) }}"
                       placeholder="Give your roadmap a title"
                       required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description"
                          name="description"
                          placeholder="What will people learn in this roadmap?"
                          required>{{ old('description', $roadmap->description) }}</textarea>
            </div>

            <div class="roadmap-form-columns">

                {{-- Left: selected tutorials --}}
                <div class="roadmap-form-selected">
                    <h2>Selected tutorials</h2>
                    <div id="selected-container">
                        @if($selectedTutorials->isEmpty())
                            <p class="empty-message">No tutorials selected yet.</p>
                        @else
                            @foreach($selectedTutorials as $tutorial)
                                <div class="selected-mini-card" data-id="{{ $tutorial['id'] }}">
                                    <img src="{{ \App\Models\Tutorial::find($tutorial['id'])->getThumbnailUrl() }}"
                                         alt="{{ $tutorial['title'] }}">
                                    <div class="selected-mini-card-info">
                                        <span class="picker-card-title">{{ $tutorial['title'] }}</span>
                                        <div class="tutorial-detail-badges">
                                            <span class="badge">{{ $tutorial['category'] }}</span>
                                            <span class="badge">{{ $tutorial['difficulty'] }}</span>
                                        </div>
                                    </div>
                                    <button type="button"
                                            class="selected-mini-card-remove"
                                            onclick="removeSelected({{ $tutorial['id'] }})">
                                        Remove
                                    </button>
                                    {{-- No hidden input here! The checkbox handles submission --}}
                                </div>
                            @endforeach
                        @endif
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
                                    <div class="picker-card {{ $selectedTutorials->contains('id', $tutorial->id) ? 'picker-card-selected' : '' }}"
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
                                               {{ $selectedTutorials->contains('id', $tutorial->id) ? 'checked' : '' }}
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

            <button type="submit" class="btn-primary">Save changes</button>
        </form>
    </div>

    <script src="{{ asset('js/roadmap-functions.js') }}"></script>
@endsection
