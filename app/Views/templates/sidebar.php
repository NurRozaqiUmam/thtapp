
<!-- Sidebar -->
<ul class="navbar-nav bg-red-custom sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
        <img src="../assets/images/Handbag.png" class="nav-icon">
        </div>
        <div class="sidebar-brand-text mx-2">
            SIMS Web App
        </div>
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn mr-1">
            <i class="fa fa-bars"></i>
        </button>
    </a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('/produk'); ?>">
    <img src="../assets/images/Package.png" class="nav-icon">
        <span>Produk</span></a>
</li>

<!-- Nav Item - Profil -->
<li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/profil'); ?>">
        <img src="../assets/images/User.png" class="nav-icon">
            <span>Profil</span>
        </a>
    </li>

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/logout'); ?>">
        <img src="../assets/images/SignOut.png" class="nav-icon">
            <span>Logout</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->