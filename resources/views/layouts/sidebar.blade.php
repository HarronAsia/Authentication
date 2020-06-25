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

        </div>
        
        <div class="user-panel">
            <!-- Status -->
            <a href="/"><i class="fa fa-circle text-info"></i> Home</a>
        </div>

        <div class="user-panel">
            @if (Auth::user()->role == "manager")
            <!-- Status -->
            <a href="/{{Auth::user()->role}}/event/add"><i class="fa fa-circle text-info"></i> Event</a>
            @elif (Auth::user()->role == "admin")
            <!-- Status -->
            <a href="/{{Auth::user()->role}}/event/add"><i class="fa fa-circle text-info"></i> Event</a>
            @endif
        </div>

        <!-- Sidebar Menu -->

        <ul class="sidebar-menu" data-widget="tree">
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>