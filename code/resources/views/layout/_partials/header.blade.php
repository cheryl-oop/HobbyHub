<header>
    <div class="logo">
        <h2>HobbyHub</h2>
    </div>

    <div class="nav-center">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('roadmaps.index') }}">
            Roadmaps
        </a>
        @auth
            <a href="{{ route('saved.index') }}">
                Saved Tutorials
            </a>
        @endauth
    </div>

    <div class="nav-right">
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">
                Register
            </a>
        @endguest
        @auth
            <p>Hello, {{ auth()->user()->name }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</header>
