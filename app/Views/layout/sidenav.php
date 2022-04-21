<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard">St</a>
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
            <li class="menu-header">Beranda</li>
            <li class="nav-item dropdown <?= ($title == "Banner" || $title == "Carousel" || $title == "Icon" || $title == "Header") ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Menu</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Banner") ? 'active' : ''; ?>"><a class="nav-link" href="/banner">Banner</a></li>
                    <li class="<?= ($title == "Carousel") ? 'active' : ''; ?>"><a class="nav-link" href="/carousel">Carousel</a></li>
                    <li class="<?= ($title == "Header") ? 'active' : ''; ?>"><a class="nav-link" href="/header">Header</a></li>
                    <li class="<?= ($title == "Icon") ? 'active' : ''; ?>"><a class="nav-link" href="/icon">Icon</a></li>
                </ul>
            </li>
            <li class="menu-header">Informasi</li>
            <li class="nav-item dropdown <?= ($title == "Berita" || $title == "Profil" || $title == "Visi Dan Misi" || $title == "Pelayanan" || $title == "Agenda" || $title == 'Pengumuman') ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Moduls</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Agenda") ? 'active' : ''; ?>"><a class="nav-link" href="/agenda">Agenda</a></li>
                    <li class="<?= ($title == "Berita") ? 'active' : ''; ?>"><a class="nav-link" href="/berita">Berita</a></li>
                    <li class="<?= ($title == "Profil") ? 'active' : ''; ?>"><a class="nav-link" href="/profil">Profil</a></li>
                    <li class="<?= ($title == "Pelayanan") ? 'active' : ''; ?>"><a class="nav-link" href="/pelayanan">Pelayanan</a></li>
                    <li class="<?= ($title == "Pengumuman") ? 'active' : ''; ?>"><a class="nav-link" href="#">Pengumuman</a></li>
                    <li class="<?= ($title == "Visi Dan Misi") ? 'active' : ''; ?>"><a class="nav-link" href="/visi_misi"> Visi Dan Misi</a></li>
                </ul>
            </li>
            <li class="menu-header">Arsip</li>
            <li class="nav-item dropdown <?= ($title == "Foto" || $title == "File" || $title == "Video" || $title == "Struktur") ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Arsip</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Foto") ? 'active' : ''; ?>"><a class="nav-link" href="/arsip_foto">Foto</a></li>
                    <li class="<?= ($title == "File") ? 'active' : ''; ?>"><a class="nav-link" href="/arsip_file">File</a></li>
                    <li class="<?= ($title == "Struktur") ? 'active' : ''; ?>"><a class="nav-link" href="/struktur">Struktur</a></li>
                    <li class="<?= ($title == "Video") ? 'active' : ''; ?>"><a class="nav-link" href="/arsip_video">Video</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>