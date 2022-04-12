<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <div class="search-element">
            <input class="form-control" placeholder="<?= date('d M Y'); ?>" readonly>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url(); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('name'); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <button onclick="btnProfil( <?= session()->get('id'); ?>)" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </button>
                <div class="dropdown-divider"></div>
                <button onclick="btnLogout( <?= session()->get('id'); ?>)" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </li>
    </ul>
</nav>