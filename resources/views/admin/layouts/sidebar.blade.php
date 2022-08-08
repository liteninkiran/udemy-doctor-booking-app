
            <div class="page-wrap">

                <div class="app-sidebar colored">

                    <div class="sidebar-header">

                        <!-- Brand Name -->
                        <a class="header-brand" href="{{ url('dashboard') }}">
                            <span class="text">Doctor Booking</span>
                        </a>

                        <!-- Toggle auto-hide -->
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>

                    </div>

                    <div class="sidebar-content">

                        <div class="nav-container">

                            <nav id="main-menu-navigation" class="navigation-main">

                                <!-- Section 1: Navigation -->
                                <div class="nav-lavel">Navigation</div>

                                <!-- Dashboard -->
                                <div class="nav-item active">
                                    <a href="{{ url('dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>

                                <!-- Doctors -->
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Doctors</span></a>
                                    <div class="submenu-content">
                                        <a href="{{ route('doctor.index') }}" class="menu-item">View All</a>
                                        <a href="{{ route('doctor.create') }}" class="menu-item">Create</a>
                                    </div>
                                </div>

                            </nav>

                        </div>

                    </div>

                </div>
