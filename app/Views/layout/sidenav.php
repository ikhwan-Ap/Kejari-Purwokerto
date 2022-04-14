<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item <?= ($title == "Dashboard") ? 'active' : ''; ?>">
                <a href="/dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master</li>
            <li class="nav-item dropdown <?= ($title == "Kasus" || $title == "Buron" || $title == 'Incraht') ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Kasus") ? 'active' : ''; ?>"><a class="nav-link" href="/kasus">Kasus</a></li>
                    <li class="<?= ($title == "Incraht") ? 'active' : ''; ?>"><a class="nav-link" href="/incraht">Incraht</a></li>
                    <li class="<?= ($title == "Buron") ? 'active' : ''; ?>"><a class="nav-link" href="/buron">Buron</a></li>
                </ul>
            </li>


            <li class="nav-item <?= ($title == "Bidang") ? 'active' : ''; ?>">
                <a class="nav-link" href="/bidang"><i class="fas fa-users"></i> <span>Bidang</span></a>
            </li>
            <li class="menu-header">Berita</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Moduls</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="News">Editor Berita</a></li>
                </ul>
            </li>
            <li class="menu-header">Pages</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                    <li><a href="auth-login.html">Login</a></li>
                    <li><a class="beep beep-sidebar" href="auth-login-2.html">Login 2</a></li>
                    <li><a href="auth-register.html">Register</a></li>
                    <li><a href="auth-reset-password.html">Reset Password</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="errors-503.html">503</a></li>
                    <li><a class="nav-link" href="errors-403.html">403</a></li>
                    <li><a class="nav-link" href="errors-404.html">404</a></li>
                    <li><a class="nav-link" href="errors-500.html">500</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="features-activities.html">Activities</a></li>
                    <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
                    <li><a class="nav-link" href="features-posts.html">Posts</a></li>
                    <li><a class="nav-link" href="features-profile.html">Profile</a></li>
                    <li><a class="nav-link" href="features-settings.html">Settings</a></li>
                    <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
                    <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li><a href="utilities-contact.html">Contact</a></li>
                    <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
                    <li><a href="utilities-subscribe.html">Subscribe</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>