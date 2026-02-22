<footer class="custom-footer mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row">

            {{-- Logo & About --}}
            <div class="col-md-4 mb-4">
                <h4 class="footer-logo">
                    </>MyBlog
                </h4>

                <p class="footer-text">
                    MyBlog is a platform to learn coding, algorithms, and software development
                    through practical tutorials and real-world examples.
                </p>

                <div class="footer-social d-flex gap-3 mt-3">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>

            {{-- Company Links --}}
            <div class="col-md-2 mb-4">
                <h6 class="footer-heading">Company</h6>
                <ul class="footer-links mt-3">
                    @php
                        $companyPages = \App\Models\Page::where('status',1)
                                        ->where('show_in_footer',1)
                                        ->whereIn('slug',['about-us','contact'])
                                        ->get();
                    @endphp

                    @foreach($companyPages as $page)
                        <li>
                            <a href="{{ url($page->slug) }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Legal Links --}}
            <div class="col-md-3 mb-4">
                <h6 class="footer-heading">Legal</h6>
                <ul class="footer-links mt-3">
                    @php
                        $legalPages = \App\Models\Page::where('status',1)
                                        ->where('show_in_footer',1)
                                        ->whereIn('slug',['privacy-policy','terms','disclaimer'])
                                        ->get();
                    @endphp

                    @foreach($legalPages as $page)
                        <li>
                            <a href="{{ url($page->slug) }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="col-md-3 mb-4">
                <h6 class="footer-heading">Subscribe</h6>
                <p class="footer-text">
                    Get the latest coding tutorials directly in your inbox.
                </p>

                <form>
                    <div class="input-group footer-input-group">
                        <input type="email" class="form-control footer-input"
                               placeholder="Enter your email">
                        <button class="btn footer-btn">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="footer-bottom text-center">
            © {{ date('Y') }} </>MyBlog. All Rights Reserved.
        </div>
    </div>
</footer>