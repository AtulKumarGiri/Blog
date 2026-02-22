<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles Link  -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <!-- Scripts -->
</head>
<body>
    <div id="app">
        @include('layouts.inc.frontend-navbar')

        <main>
            @yield('content')
        </main>

        @include('layouts.inc.frontend-footer')
    </div>

    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}" defer></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        document.getElementById('globalSearch').addEventListener('keyup', function () {

            let query = this.value;

            fetch(`/search?search=${query}`)
                .then(response => response.json())
                .then(data => {

                    let results = '';

                    // POSTS
                    data.posts.forEach(post => {

                        let url = `/tutorial/${post.category.slug}/${post.slug}`;

                        results += `
                            <div class="col-lg-6 mb-4">
                                <div class="post-card p-4 h-100">
                                    <a href="${url}" class="text-decoration-none">
                                        <h4 class="post-title">${post.name}</h4>
                                    </a>
                                </div>
                            </div>
                        `;
                    });

                    // CATEGORIES
                    data.categories.forEach(cat => {

                        let url = `/tutorial/${cat.slug}`;

                        results += `
                            <div class="col-lg-4 mb-4">
                                <div class="sidebar-card p-4 text-center">
                                    <a href="${url}" class="text-decoration-none">
                                        <h5>${cat.name}</h5>
                                    </a>
                                </div>
                            </div>
                        `;
                    });

                    if(results === ''){
                        results = `
                            <div class="text-center mt-4">
                                <h5>No Results Found</h5>
                            </div>
                        `;
                    }

                    document.getElementById('searchResults').innerHTML = results;

                });
            });
        </script>
</body>
</html>
