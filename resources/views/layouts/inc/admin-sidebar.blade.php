<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion border-top" id="sidenavAccordion" style="background-color: #024864ff;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading text-secondary">Core</div>
                            <a class="nav-link {{Request::is('admin/dashboard') ? 'active':''}} text-light" href="{{url('admin/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading text-secondary">Interface</div>
                            <a class="nav-link {{Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'collapse active':'collapsed'}} text-light" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns "></i></div>
                                Category
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse {{Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'show':''}}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link {{Request::is('admin/add-category') ? 'active':''}}" href="{{url('admin/add-category')}} ">Add Category</a>
                                    <a class="nav-link {{Request::is('admin/category') || Request::is('admin/edit-category/*') ? 'active':''}}" href="{{url('admin/category')}} ">View Category</a>
                                    <a class="nav-link {{Request::is('admin/category/trash') ? 'active':''}}" href="{{url('admin/category/trash')}}">Trash</a>
                                </nav>
                            </div>
                            <a class="nav-link 
                                {{ Request::is('admin/posts*') ? 'active' : 'collapsed' }}" 
                                href="#" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapsePost" 
                                aria-expanded="{{ Request::is('admin/posts*') ? 'true' : 'false' }}"
                                aria-controls="collapsePost">

                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-columns"></i>
                                </div>
                                Posts
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>

                            <div class="collapse 
                                {{ Request::is('admin/posts*') ? 'show' : '' }}" 
                                id="collapsePost" 
                                data-bs-parent="#sidenavAccordion">

                                <nav class="sb-sidenav-menu-nested nav">

                                    {{-- Add Post --}}
                                    <a class="nav-link 
                                        {{ Request::is('admin/posts/create') ? 'active' : '' }}" 
                                        href="{{ url('admin/posts/create') }}">
                                        Add Post
                                    </a>

                                    {{-- View Posts --}}
                                    <a class="nav-link 
                                        {{ Request::is('admin/posts') || Request::is('admin/posts/*/edit') ? 'active' : '' }}" 
                                        href="{{ url('admin/posts') }}">
                                        View Posts
                                    </a>

                                    {{-- Trash --}}
                                    <a class="nav-link 
                                        {{ Request::is('admin/posts/trash') ? 'active' : '' }}" 
                                        href="{{ url('admin/posts/trash') }}">
                                        Trash
                                    </a>

                                </nav>
                            </div>

                            <a class="nav-link {{Request::is('admin/pages*') || Request::is('admin/home-banner*') ? 'collapse active':'collapsed'}} text-light" 
                            href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapsePages" 
                            aria-expanded="false">

                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>

                            <div class="collapse {{Request::is('admin/pages*') || Request::is('admin/home-banner*') ? 'show':''}}" 
                                id="collapsePages" 
                                data-bs-parent="#sidenavAccordion">

                                <nav class="sb-sidenav-menu-nested nav">
                                    
                                    {{-- Pages --}}
                                    <a class="nav-link {{Request::is('admin/pages/create') ? 'active':''}}" 
                                    href="{{ route('admin.pages.create') }}">
                                        Add Page
                                    </a>

                                    <a class="nav-link {{Request::is('admin/pages') || Request::is('admin/pages/*/edit') ? 'active':''}}" 
                                    href="{{ route('admin.pages.index') }}">
                                        View Pages
                                    </a>

                                    {{-- Home Banner --}}
                                    <a class="nav-link {{Request::is('admin/home-banner') || Request::is('admin/home-banner/*') ? 'active':''}}" 
                                    href="{{ route('admin.home-banner.index') }}">
                                        Home Banner
                                    </a>

                                </nav>
                            </div>

                            <a class="nav-link {{Request::is('admin/users') ? 'active':''}} text-light" href="{{url('admin/users') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Registered Users
                            </a>





                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <a href="/" class="small text-light text-decoration-none">
                            <div class="sb-nav-link-icon"><i class="fas fa-globe"></i> Visit Site</div>
                        </a>
                    </div>
                </nav>
            </div>