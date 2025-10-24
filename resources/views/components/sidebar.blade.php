<nav class="pc-sidebar bg-white">
    <div class="navbar-wrapper">
        <div class="m-hea der mt-5">
            <a href="{{route('home')}}" class="b-brand text-primary">
                <img src="{{asset('logo.png')}}" class="img-fluid logo-lg" alt="logo">

            </a>
        </div>
        <div class="navbar-content mt-5">
            <ul class="pc-navbar">
                <!-- Dashboard -->
                <li class="pc-item">
                    <a href="{{ route('home') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-status-up"></use></svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>

                <!-- Livestock -->
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-layer"></use></svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Livestock">Livestock</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a href="{{ route('livestock.create') }}" class="pc-link" data-i18n="Add Livestock">Add
                                New</a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ route('livestock.index') }}" class="pc-link" data-i18n="View Livestock">View
                                All</a>
                        </li>
                    </ul>
                </li>

                <!-- Health Records -->
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-health"></use></svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Health Records">Health Records</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a href="{{ route('health-records.create') }}" class="pc-link"
                               data-i18n="Add Health Record">Add New</a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ route('health-records.index') }}" class="pc-link"
                               data-i18n="View Health Records">View All</a>
                        </li>
                    </ul>
                </li>
                <!-- Vaccinations -->
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-shield"></use></svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Vaccinations">Vaccinations</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @if(isVet())
                            <li class="pc-item">
                                <a href="{{ route('vaccinations.create') }}" class="pc-link"
                                   data-i18n="Add Vaccination">Add New</a>
                            </li>
                        @endif
                        <li class="pc-item">
                            <a href="{{ route('vaccinations.index') }}" class="pc-link" data-i18n="View Vaccinations">View
                                All</a>
                        </li>
                    </ul>
                </li>
                @if(isVet())
                    <!-- Reminders -->
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-notification"></use></svg>
                        </span>
                            <span class="pc-mtext" data-i18n="Reminders">Reminders</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a href="{{ route('reminders.create') }}" class="pc-link" data-i18n="Add Reminder">Add
                                    New</a>
                            </li>
                            <li class="pc-item">
                                <a href="{{ route('reminders.index') }}" class="pc-link" data-i18n="View Reminders">View
                                    All</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(isVet())
                    <!-- Disease Risks -->
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-alert-triangle"></use></svg>
                        </span>
                            <span class="pc-mtext" data-i18n="Disease Risks">Disease Risks</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">

                            <li class="pc-item">
                                <a href="{{ route('disease-risks.create') }}" class="pc-link"
                                   data-i18n="Add Disease Risk">Add New</a>
                            </li>
                            <li class="pc-item">
                                <a href="{{ route('disease-risks.index') }}" class="pc-link"
                                   data-i18n="View Disease Risks">View All</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(isVet())
                    <!-- Reports -->
                    <li class="pc-item">
                        <a href="{{ route('reports.health-summary') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon"><use xlink:href="#custom-status-up"></use></svg>
                        </span>
                            <span class="pc-mtext" data-i18n="Reports">Health Summary Report</span>
                        </a>
                    </li>
                @endif
                <!-- Chat -->
                <li class="pc-item">
                    <a href="{{ route('chat') }}" class="pc-link">
     <span class="pc-micon">
         <i data-feather="message-circle"></i>
     </span>
                        <span class="pc-mtext" data-i18n="Chat">Chat</span>
                    </a>
                </li>
                <!-- Farmers (Optional Admin Section) -->
                {{--                <li class="pc-item">--}}
                {{--                    <a href="{{ route('farmers.index') }}" class="pc-link">--}}
                {{--                        <span class="pc-micon">--}}
                {{--                            <svg class="pc-icon"><use xlink:href="#custom-user"></use></svg>--}}
                {{--                        </span>--}}
                {{--                        <span class="pc-mtext" data-i18n="Farmers">Farmers</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>

