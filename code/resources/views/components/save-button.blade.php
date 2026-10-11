@auth

    @if(auth()->user()->savedTutorials->contains($tutorial->id))
        <form method="POST" action="{{ route('saved.delete', $tutorial) }}">
            @csrf
            @method('DELETE')
            <button type="submit">⭐ Unsave</button>
        </form>
    @else
        <form method="POST" action="{{ route('saved.store', $tutorial) }}">
            @csrf
            <button type="submit">☆ Save</button>
        </form>
    @endif

@else
    <a href="{{ route('login') }}">☆ Login to save</a>
@endauth
