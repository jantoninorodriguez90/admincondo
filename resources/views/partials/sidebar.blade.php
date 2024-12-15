<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            {{-- <div class="input-group" data-widget="sidebar-search"> --}}
            <div class="input-group">
                <select class="form-control selectpicker form-control-sidebar" type="search" placeholder="Search" aria-label="Search" id="search_menu">
                    <option value="">Choose one...</option>
                    @php
                        $menu = menu();
                    @endphp
                    @foreach ($menu as $value)
                        <optgroup label="{{ $value['menu'] }}">
                            @foreach ($value['modulos'] as $item)
                                <option value="{{ route($item['ruta']) }}">
                                    {{ $item['modulo'] }}
                                </option>
                            @endforeach
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    @php
                        $menu = menu();
                        
                        if(!empty($menu)){
                            foreach ($menu as $key => $value) {
                                echo '<li class="nav-item">';
                                    echo '<a href="#" class="nav-link active">';
                                        echo '<i class="nav-icon '.$value['icon'].'"></i>';
                                        echo '<p>';
                                            echo $value['menu'];
                                        echo '<i class="right fas fa-angle-left"></i>';
                                        echo '</p>';
                                    echo '</a>';
                                    echo '<ul class="nav nav-treeview">';
                                        foreach ($value['modulos'] as $key_modulo => $value_modulo) {
                                            echo '<li class="nav-item">';
                                                echo '<a href="' . route($value_modulo['ruta']) . '" class="nav-link">';
                                                    echo '<i class="pr-1 '.$value_modulo['icon'].'"></i>';
                                                    echo '<p>'.$value_modulo['modulo'].'</p>';
                                                echo '</a>';
                                            echo '</li>';
                                        }
                                    echo '</ul>';
                                echo '</li>';
                            }
                        }
                    @endphp
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                            Administrator
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="fa fa-user"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="fa fa-list"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="fa fa-list"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('navegations.index') }}" class="nav-link">
                                    <i class="fa fa-link"></i>
                                    <p>Navigation</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>