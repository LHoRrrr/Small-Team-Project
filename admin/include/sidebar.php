<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?p=dashboard">
        <div class="sidebar-brand-text mx-2">Admin Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($p == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?p=dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= ($p == 'banners') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?p=banners">
            <i class="fas fa-fw fa-bars"></i>
            <span>Banners</span></a>
    </li>

    <!-- Nav Item - Product -->

    <li class="nav-item <?= ($p == 'products' ? 'active' : '') ?>">
        <a class="nav-link" href="index.php?p=products">
            <i class="fas fa-fw fa-filter"></i>
            <span>Products</span></a>
    </li>

    <!-- Nav Item Users -->
    <li class="nav-item <?= ($p == 'users' ? 'active' : '') ?>">
        <a class="nav-link" href="index.php?p=users">
            <i class="fa fa-user-circle"></i>
            <span>Users</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>