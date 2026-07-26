<aside class="sidebar sidebar-base" id="first-tour"
    data-toggle="main-sidebar"
    data-sidebar="responsive"
    style="height:100vh;overflow-y:auto;padding-bottom:120px;">

    <div class="sidebar-header d-flex align-items-center justify-content-start position-relative">
        <div class="logo pull-left">
            <a href="/" class="img-responsive">
                <img src="{{ asset('assets/images/ABS.News.p') }}"
                     alt="ABS News Logo"
                     style="width:180px;height:auto;">
            </a>
        </div>

        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none">
                    <path d="M15.5 19L8.5 12L15.5 5"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
            </i>
        </div>
    </div>

    <div class="sidebar-body pt-0 pb-2">
        <div class="sidebar-list">

            <ul class="navbar-nav iq-main-menu">

                <!-- ========================= -->
                <!-- MAIN -->
                <!-- ========================= -->

                <li class="nav-item static-item mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Main</span>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link" href="/">
                        <i class="ph-duotone ph-house"></i>
                        <span class="item-name">Visit Website</span>
                    </a>
                </li>

                <!-- ========================= -->
                <!-- DASHBOARD -->
                <!-- ========================= -->

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-gauge"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>

                <!-- ========================= -->
                <!-- POSTS -->
                <!-- ========================= -->

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Posts</span>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link" href="{{ route('posts.index') }}">
                        <i class="ph-duotone ph-newspaper"></i>
                        <span class="item-name">All Posts</span>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link" href="{{ route('posts.create') }}">
                        <i class="ph-duotone ph-note-pencil"></i>
                        <span class="item-name">Create Post</span>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link" href="{{ route('admin.news.headlines') }}">
                        <i class="ph-duotone ph-share-network"></i>
                        <span class="item-name">Generate Headlines</span>
                    </a>
                </li>

                <!-- ========================= -->
                <!-- ADMIN + SUPER ADMIN -->
                <!-- ========================= -->

                @hasanyrole('super-admin|admin')

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="ph-duotone ph-folders"></i>
                        <span class="item-name">All Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.create') }}">
                        <i class="ph-duotone ph-plus-circle"></i>
                        <span class="item-name">Add Category</span>
                    </a>
                </li>

                @endhasanyrole

                @can('manage live news')

<li class="nav-item static-item mt-3 mb-1">
    <a class="nav-link static-item disabled">
        <span class="default-icon">Live News</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.live-news.index') }}">
        <i class="ph-duotone ph-broadcast"></i>
        <span class="item-name">All Live News</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('live-news.create') }}">
        <i class="ph-duotone ph-plus-circle"></i>
        <span class="item-name">Add Live News</span>
    </a>
</li>

@endcan

@can('manage youtube live')

<li class="nav-item static-item mt-3 mb-1">
    <a class="nav-link static-item disabled">
        <span class="default-icon">YouTube Live</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.youtube-live.index') }}">
        <i class="ph-duotone ph-youtube-logo"></i>
        <span class="item-name">All Streams</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.youtube-live.create') }}">
        <i class="ph-duotone ph-plus-circle"></i>
        <span class="item-name">Add Stream</span>
    </a>
</li>

@endcan

@can('manage radio')

<li class="nav-item">

    <a class="nav-link"
       data-bs-toggle="collapse"
       href="#radio-menu"
       role="button">

        <i class="ph-duotone ph-broadcast"></i>

        <span class="item-name">
            Radio
        </span>

        <i class="right-icon">
            <svg width="18" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M7,10L12,15L17,10H7Z">
                </path>
            </svg>
        </i>

    </a>

    <ul class="sub-nav collapse"
        id="radio-menu">

        <li class="nav-item">

            <a class="nav-link"
               href="{{ route('admin.radio.index') }}">

                <i class="ph-duotone ph-list"></i>

                <span class="item-name">
                    All Streams
                </span>

            </a>

        </li>

        <li class="nav-item">

            <a class="nav-link"
               href="{{ route('admin.radio.create') }}">

                <i class="ph-duotone ph-plus-circle"></i>

                <span class="item-name">
                    Add Stream
                </span>

            </a>

        </li>

    </ul>

</li>

@endcan


@can('manage eyewitness')

<li class="nav-item static-item mt-3 mb-1">
    <a class="nav-link static-item disabled">
        <span class="default-icon">Eyewitness News</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.eyewitness.index') }}">
        <i class="ph-duotone ph-newspaper"></i>
        <span class="item-name">All Reports</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.eyewitness.trash') }}">
        <i class="ph-duotone ph-trash"></i>
        <span class="item-name">Trash</span>
    </a>
</li>

@endcan


                <!-- ========================= -->
                <!-- USERS -->
                <!-- ========================= -->

                @role('super-admin')

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.list') }}">
                        <i class="ph-duotone ph-users"></i>
                        <span class="item-name">Manage Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.create') }}">
                        <i class="ph-duotone ph-user-plus"></i>
                        <span class="item-name">Create Admin / Editor</span>
                    </a>
                </li>

                @endrole

                <!-- ========================= -->
                <!-- ROLES & PERMISSIONS -->
                <!-- ========================= -->

                @role('super-admin')
<!-- 
                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Roles & Permissions</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-shield-check"></i>
                        <span class="item-name">Roles</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-lock-key"></i>
                        <span class="item-name">Permissions</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-user-gear"></i>
                        <span class="item-name">Assign Permissions</span>
                    </a>
                </li> -->

                @endrole

                <!-- ========================= -->
                <!-- NEWSLETTER -->
                <!-- ========================= -->

                @hasanyrole('super-admin|admin')

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Newsletter</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.subscribers') }}">
                        <i class="ph-duotone ph-envelope-simple"></i>
                        <span class="item-name">Subscribers</span>
                    </a>
                </li>

                @endhasanyrole

                <!-- ========================= -->
                <!-- COMMENTS -->
                <!-- ========================= -->

                @hasanyrole('super-admin|admin')

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Comments</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.comments') }}">
                        <i class="ph-duotone ph-chat-text"></i>
                        <span class="item-name">Comments</span>
                    </a>
                </li>

                @endhasanyrole

                <!-- ========================= -->
                <!-- SETTINGS -->
                <!-- ========================= -->

                @hasanyrole('super-admin|admin')

                <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.seo.edit') }}">
                        <i class="ph-duotone ph-gear"></i>
                        <span class="item-name">SEO Settings</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-globe"></i>
                        <span class="item-name">Website Settings</span>
                    </a>
                </li> -->

                @endhasanyrole

                <!-- ========================= -->
                <!-- SUPER ADMIN ONLY -->
                <!-- ========================= -->

                @role('super-admin')

                <!-- <li class="nav-item static-item mt-3 mb-1">
                    <a class="nav-link static-item disabled">
                        <span class="default-icon">System</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.database-backup') }}">
                        <i class="ph-duotone ph-database"></i>
                        <span class="item-name">Database Backup</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.activity-logs') }}">
                        <i class="ph-duotone ph-activity"></i>
                        <span class="item-name">Activity Logs</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ph-duotone ph-gear-six"></i>
                        <span class="item-name">System Settings</span>
                    </a>
                </li> -->

                @endrole

                <li style="height:100px;"></li>

            </ul>

        </div>
    </div>

</aside>