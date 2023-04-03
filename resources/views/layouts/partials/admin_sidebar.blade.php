<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('home') }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-monitor"></i>
                        <span> Responsible </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a type="button" class="waves-effect waves-light" data-toggle="modal" data-target="#user-modal">Create user</a></li>
                        <li><a href="{{route('user.index')}}">User list</a></li>
                        <li><a href="{{route('income.index')}}">Income</a></li>
                        <li><a href="{{route('expense.index')}}">Expense</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-home"></i>
                        <span> Hostel </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a type="button" class="waves-effect waves-light" data-toggle="modal" data-target="#user-modal" href="">Create Hostel</a></li>
                        <li><a href="{{route('hostel.index')}}">Hostel list</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-settings"></i>
                        <span> Configuration </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('khat.index')}}">Khat</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
