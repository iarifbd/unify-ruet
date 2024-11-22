<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar profile starts -->
    <div class="shop-profile">
        <p class="mb-1 fw-bold text-primary">Admin</p>
        <p class="m-0">Panel</p>
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="active current-page">
                <a href="<?php echo base_url('AdminDashboard'); ?>">
                    <i class="bi bi-pie-chart"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="bi bi-activity" href="<?php echo base_url('AdminDashboard'); ?>">Top Sheet</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </div>
    <!-- Sidebar menu ends -->

</nav>
<!-- Sidebar wrapper end -->