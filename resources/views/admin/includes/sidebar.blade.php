<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{route('admin.parking.index')}}" class="nav-link">
                    <i class="nav-icon fa-solid fa-p"> </i>
                    <p>
                        Парковки
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.reservations.index')}}" class="nav-link">
                    <i class="nav-icon fa-solid fa-book"></i>
                    <p>
                        Резервації
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
