<aside class="main-sidebar" id="sidebar-wrapper">
    {{Auth::user()->role}}
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::user()->photo == NULL)
                <img src="{{asset('storage/default.png')}}" alt="Image" class="user-image">
                @else
                <img src="{{asset('storage/'.Auth::user()->name.'/'.Auth::user()->photo.'/')}}" alt="Image" class="user-image">
                @endif

            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>Annynomous</p>
                @else
                <p>{{ Auth::user()->name}}</p>
                @endif
                <!-- Status -->
                
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

            </div>
            <hr>
        </div>
        <hr>
        <div class="user-panel">
            <!-- Status -->
            <a href="/"><i class="fa fa-circle text-info"></i> Home</a>
        </div>
        <hr>
        @if(Auth::user()->email_verified_at == NULL)


        @else
        <div class="user-panel">
            @if (Auth::user()->role == "manager")
            <!-- Status -->
            <a href="/manager/event/add"><i class="fa fa-circle text-info"></i> Add Event</a>
            @elseif (Auth::user()->role == "admin")
            <!-- Status -->
            <a href="/admin/event/add"><i class="fa fa-circle text-info"></i> Add Event</a>
            @else

            @endif
        </div>
        <hr>
        <div class="user-panel">
            @if (Auth::user()->role == "admin")
            <!-- Status -->
            <a href="/admin/dashboard"><i class="fa fa-circle text-info"></i> DashBoard</a>
            @else

            @endif
        </div>
        <hr>
        <div class="user-panel">
            @if (Auth::user()->role == "admin")
            <!-- Status -->
            <a href="/admin/users/export"><i class="fa fa-circle text-info"></i> Export Users list</a>
            @else

            @endif
        </div>
        <hr>
        <div class="user-panel">
            @if (Auth::user()->role == "admin")
            <!-- Status -->
            <a href="/admin/events/export"><i class="fa fa-circle text-info"></i> Export Events List</a>
            @else

            @endif
        </div>
        <!-- Sidebar Menu -->
        <hr>
        <ul class="sidebar-menu" data-widget="tree">
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
        @endif
    </section>
    <!-- /.sidebar -->
</aside>