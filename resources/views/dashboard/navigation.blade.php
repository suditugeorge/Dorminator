        <!--Double navigation-->
        <header>
            <!-- Sidebar navigation -->
            <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">
                <!-- Logo -->
                <li>
                    <div class="user-box">
                        @if (file_exists(public_path('images/users/'.$user->id.'.jpg')))
                            <img src="{{URL::asset('images/users/'.$user->id.'.jpg')}}" class="img-fluid rounded-circle">
                        @else
                            <img src="{{URL::asset('images/users/default.png')}}" class="img-fluid rounded-circle">
                        @endif
                        <p class="user text-center">{{$user->name}}</p>
                    </div>
                </li>
                <!--/. Logo -->
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="/profile" class="collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i> Profil</a></li>
                        @if(Auth::check() && ($user->is_admin || $user->is_super_admin))
                            <li><a href="/users" class="collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Adaugă admini</a></li>
                            <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-lock"></i> Admin<i class="fa fa-angle-down rotate-icon"></i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="/add-institution" class="waves-effect"><i class="fa fa-building"></i>Adaugă instituții</a></li>
                                        <li><a href="/add-students" class="waves-effect"><i class="fa fa-graduation-cap"></i>Adaugă studenți</a></li>
                                        <li><a href="/dorms" class="waves-effect"><i class="fa fa-building"></i>Adaugă cămine</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#" class="collapsible-header waves-effect arrow-r" id="start-sort"><i class="fa fa-database"></i> Pornește sortarea</a>
                        @endif
                        @if(Auth::check() && !$user->is_admin && !$user->is_super_admin)
                            <li><a href="/select-dorm" class="collapsible-header waves-effect arrow-r"><i class="fa fa-building"></i> Cămine</a></li>
                        @endif

                        <li><a href="invoice.html" class="collapsible-header waves-effect arrow-r"><i class="fa fa-money"></i> Invoice</a>
                        <li><a href="support.html" class="collapsible-header waves-effect arrow-r"><i class="fa fa-support"></i> Support</a>
                        <li><a href="faq.html" class="collapsible-header waves-effect arrow-r"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQ</a>
                    </ul>
                </li>
                <!--/. Side navigation links -->
                <div class="sidenav-bg mask-strong"></div>
            </ul>
            <!--/. Sidebar navigation -->
            <!-- Navbar -->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
                <!-- SideNav slide-out button -->
                <div class="float-left">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
                </div>
                <!-- Breadcrumb-->
                <div class="breadcrumb-dn mr-auto">
                    <p>Dorminator</p>
                </div>
                <ul class="nav navbar-nav nav-flex-icons ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"><i class="fa fa-envelope"></i> <span class="hidden-sm-down">Contact</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/messages" aria-expanded="false">
                            <span class="badge red">99</span> <i class="fa fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" type="button" aria-haspopup="true" aria-expanded="false" href="/logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </nav>
            <!-- /.Navbar -->
        </header>
        <!--/.Double navigation-->