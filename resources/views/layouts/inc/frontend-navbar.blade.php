<header class="modern-header">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            &lt;/&gt; MyBlog
        </a>

        <!-- Nav -->
        <nav class="d-flex align-items-center gap-4">

            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ url('/about-us') }}" class="nav-link">About</a>
            <a href="{{ url('/categories') }}" class="nav-link">Topics</a>
            <a href="#" class="nav-link">Contact</a>

            @guest
                <a href="{{ route('login') }}" class="btn btn-login-nav">
                    Log In
                </a>
            @else
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest

        </nav>

    </div>
</header>
