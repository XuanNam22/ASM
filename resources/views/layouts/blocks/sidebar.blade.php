<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row text-center">
            <div class="nav-logo">
                <div class="nav-item theme-text">
                    <a href="/" class="nav-link fw-bold fs-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-shield text-primary">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        {{ Auth::check() && Auth::user()->role === 'admin' ? 'ADMIN PANEL' : 'GUIDE PANEL' }}
                    </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        aria-expanded="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>Tổng quan</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->routeIs('tours.*') ? 'active' : '' }}">
                    <a href="#tours" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('tours.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-map">
                                <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                <line x1="8" y1="2" x2="8" y2="18"></line>
                                <line x1="16" y1="6" x2="16" y2="22"></line>
                            </svg>
                            <span>Tours</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ request()->routeIs('tours.*') ? 'show' : '' }}"
                        id="tours" data-bs-parent="#accordionExample">
                        <li class="{{ request()->routeIs('tours.index') ? 'active' : '' }}">
                            <a href="{{ route('tours.index') }}"> Danh sách Tour </a>
                        </li>
                        <li class="{{ request()->routeIs('tours.create') ? 'active' : '' }}">
                            <a href="{{ route('tours.create') }}"> Thêm Tour mới </a>
                        </li>
                    </ul>
                </li>

                <li class="menu {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                    <a href="#bookings" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('bookings.*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-cart">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <span>Booking</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ request()->routeIs('bookings.*') ? 'show' : '' }}"
                        id="bookings" data-bs-parent="#accordionExample">
                        <li class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                            <a href="{{ route('bookings.index') }}"> Danh sách Đặt chỗ </a>
                        </li>
                    </ul>
                </li>

                <li class="menu">
                    <a href="#users" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Hướng dẫn viên</span>
                        </div>
                    </a>
                </li>
            @endif

            @if (Auth::check() && Auth::user()->role === 'guide')
                <li class="menu {{ request()->routeIs('guide.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('guide.dashboard') }}"
                        aria-expanded="{{ request()->routeIs('guide.dashboard') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>Tổng quan</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="#myTours" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                </rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>Lịch trình của tôi</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="myTours" data-bs-parent="#accordionExample">
                        <li><a href="#"> Danh sách đoàn </a></li>
                        <li><a href="#"> Điểm danh & Ghi chú </a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::check())
                <li class="menu mt-5">
                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                        @csrf
                        <button type="submit"
                            class="btn btn-outline-danger w-100 d-flex justify-content-center align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Đăng xuất
                        </button>
                    </form>
                </li>
            @endif

        </ul>
    </nav>
</div>
