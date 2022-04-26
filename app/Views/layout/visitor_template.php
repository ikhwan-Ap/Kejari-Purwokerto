<!DOCTYPE html>
<html lang="en">

<head>
	<title>Website Resmi Kejaksaan Negeri Purwokerto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Demo project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/bootstrap4/bootstrap.min.css">
	<link href="<?= base_url() ?>/template/visitor/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/responsive.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/post.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/post_responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url() ?>/template/visitor/fonts/icomoon/style.css" />
	<link rel="stylesheet" href="<?= base_url() ?>/template/visitor/css/style.css" />
</head>

<body>
	<script type='text/javascript'>
		var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var thisDay = date.getDay(),
			thisDay = myDays[thisDay];
		var yy = date.getYear();
		var year = (yy < 1000) ? yy + 1900 : yy;

		function startTime() {
			var today = new Date(),
				curr_hour = today.getHours(),
				curr_min = today.getMinutes(),
				curr_sec = today.getSeconds();
			curr_hour = checkTime(curr_hour);
			curr_min = checkTime(curr_min);
			curr_sec = checkTime(curr_sec);
			document.getElementById('clock').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year + '  ' + curr_hour + ":" + curr_min + ":" + curr_sec;
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}
		setInterval(startTime, 500);
	</script>



	<?php function tanggal($date)
	{
		$datetime = DateTime::createFromFormat('Y-m-d', $date);
		$day = $datetime->format('l');
		switch ($day) {
			case 'Sunday':
				$hari = 'Minggu';
				break;
			case 'Monday':
				$hari = 'Senin';
				break;
			case 'Tuesday':
				$hari = 'Selasa';
				break;
			case 'Wednesday':
				$hari = 'Rabu';
				break;
			case 'Thursday':
				$hari = 'Kamis';
				break;
			case 'Friday':
				$hari = 'Jum\'at';
				break;
			case 'Saturday':
				$hari = 'Sabtu';
				break;
			default:
				$hari = 'Tidak ada';
				break;
		}
		$months = [
			'0' => '', '01' => 'Januari', '02' => 'Februari',
			'03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
			'07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		];
		$bulan = $months[$datetime->format('m')];
		$year = $datetime->format(' Y');
		$tgl = $datetime->format(' d');
		return $hari . ', ' . $tgl . ' ' . $bulan .   $year;
	} ?>

	<div class="super_container">
		<div class="custom-site-mobile-menu custom-site-navbar-target">
			<div class="custom-site-mobile-menu-header">
				<div class="custom-site-mobile-menu-close mt-3">
					<span class="custom-icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="custom-site-mobile-menu-body"></div>
		</div>

		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<a href="#" class=""><span class="mr-2 fa fa-clock-o"></span>
							<span class="d-none d-md-inline-block" id="clock"></span></a>
						<span class="mx-md-2 d-inline-block"></span>

						<div class="float-right">
							<a href="#" class=""><span class="mr-2 custom-icon-twitter"></span>
								<span class="d-none d-md-inline-block">Twitter</span></a>
							<span class="mx-md-2 d-inline-block"></span>
							<a href="#" class=""><span class="mr-2 custom-icon-facebook"></span>
								<span class="d-none d-md-inline-block">Facebook</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="" style="background-image: url('<?= base_url() ?>/template/visitor/images/header.jpg')">
				<div class="container">
					<center><img class="hidden-sm hidden-xs text-left" style="display:block; padding:11px 0; margin-left:40px; margin-right:auto; width:auto; " src="<?= base_url() ?>/template/visitor/images/logo_fix.png"></center>
				</div>
			</div>
			<div class="toggle-button d-inline-block d-lg-none" style="top: 56px;right: 6px;position: absolute;">
				<a href="#" class="custom-site-menu-toggle py-5 js-menu-toggle text-black" style="color:ghostwhite;"><span class="custom-icon-menu h3"></span></a>
			</div>
		</div>
		<header class="custom-site-navbar js-sticky-header custom-site-navbar-target" role="banner" style="background-image: url('<?= base_url() ?>/navbar/<?= session()->get('header'); ?>'); background-position:bottom; margin-top: -8px;">
			<div style="background-color: green; width: 100%;height: 100%; position: absolute;left: 0;top: 0;opacity: 0.5;"></div>
			<div class="container">
				<div class="row align-items-center position-relative">
					<div class="col-12">
						<nav class="custom-site-navigation text-center mx-auto" style="margin-left: 0;" role="navigation">
							<ul class="custom-site-menu main-menu js-clone-nav mx-auto d-none d-lg-block">
								<li><a href="<?= base_url() ?>/home" class="nav-link"><b>Beranda</b></a></li>
								<li class="has-children">
									<a href="#" class="nav-link"><b>Profil</b></a>
									<ul class="dropdown arrow-top">
										<?php $i = 0;
										foreach ($_SESSION['profil'] as $data) :
										?>
											<li><a href="<?= base_url() ?>/beranda/profil/<?= $data['id_profil']; ?>" class="nav-link"><?= $data['nama_kategori_profil']; ?></a></li>
										<?php $i++;
										endforeach; ?>
										<li><a href="/visi-misi" class="nav-link">Visi dan Misi</a></li>
										<li><a href="/beranda/struktur" class="nav-link">Struktur Organisasi</a></li>
									</ul>
								</li>

								<li class="has-children">
									<a href="#" class="nav-link"><b>Info Perkara</b></a>
									<ul class="dropdown arrow-top">
										<li><a href="<?= base_url() ?>/home/pidana_umum" class="nav-link">Pidana Umum</a></li>
										<li><a href="<?= base_url() ?>/home/pidana_khusus" class="nav-link">Pidana Khusus</a></li>
										<li><a href="<?= base_url() ?>/home/tata_usaha" class="nav-link">Perdata dan Tata Usaha Negara</a></li>
										<li><a href="<?= base_url() ?>/home/jadwal_sidang" class="nav-link">Jadwal Sidang</a></li>
									</ul>
								</li>
								<li class="has-children">
									<a href="#" class="nav-link"><b>Bidang</b></a>
									<ul class="dropdown arrow-top">
										<?php $i = 0;
										foreach ($_SESSION['kategori']  as $row) : ?>
											<li><a href="<?= base_url() ?>/bidang_view/<?= $row['id_bidang']; ?>" class="nav-link"><?= $row['nama_kategori']; ?></a></li>
										<?php $i++;
										endforeach; ?>
									</ul>
								</li>
								<li class="has-children">
									<a href="" class="nav-link"><b>Sarana</b></a>
									<ul class="dropdown arrow-top">
										<?php $i = 0;
										foreach ($_SESSION['sarana'] as $data) : ?>
											<li><a href="<?= base_url() ?>/beranda/sarana/<?= $data['id_sarana']; ?>" class="nav-link"><?= $data['nama_kategori_sarana']; ?></a></li>
										<?php $i++;
										endforeach; ?>
									</ul>
								</li>
								<li class="has-children">
									<a href="" class="nav-link"><b>Peraturan</b></a>
									<ul class="dropdown arrow-top">
										<?php $i = 0;
										foreach ($_SESSION['peraturan'] as $data) : ?>
											<li><a href="<?= base_url() ?>/beranda/peraturan/<?= $data['id_kategori_peraturan']; ?>" class="nav-link"><?= $data['nama_kategori_peraturan']; ?></a></li>
										<?php $i++;
										endforeach; ?>
									</ul>
								</li>
								<li class="has-children">
									<a href="#" class="nav-link"><b>Informasi</b></a>
									<ul class="dropdown arrow-top">
										<li>
											<a href="#" class="nav-link">Pengaduan</a>
										</li>
										<li><a href="<?= base_url() ?>/berita_tentang/1" class="nav-link">Berita</a></li>
										<li><a href="<?= base_url() ?>/beranda/pengumuman" class="nav-link">Pengumuman</a></li>
										<li><a href="<?= base_url() ?>/beranda/agenda" class="nav-link">Agenda</a></li>
										<li><a href="<?= base_url('/beranda/arsip_foto') ?>" class="nav-link">Foto Kegiatan</a></li>
										<li><a href="<?= base_url('/beranda/arsip_video') ?>" class="nav-link">Video Kegiatan</a></li>
									</ul>
								</li>
								<li><a href="<?= base_url() ?>/home/portal" class="nav-link" target="_blank"><b>Pelayanan</b></a></li>
								<li><a href="<?= base_url() ?>/home/kontak" class="nav-link"><b>Kontak Kami</b></a></li>
							</ul>
						</nav>
					</div>

				</div>
			</div>
		</header>

		<?= $this->renderSection('content'); ?>

		<!-- Sidebar -->
		<div class="col-lg-3">
			<div class="sidebar">
				<div class="sidebar_background"></div>

				<!-- Top Stories -->
				<?php if (session()->get('jaksa') != null) :  ?>
					<div class="sidebar_section">
						<div class="sidebar_title_container">
							<div class="sidebar_title">Kepala Kejaksaan Negeri Purwokerto</div>
						</div><br>
						<img src="<?= base_url() ?>/uploads/bidang/<?= session()->get('jaksa'); ?>" alt="" width="100%">
						<img src="<?= base_url() ?>/template/visitor/images/bg_kepala.png" alt="" width="100%" style="margin-top:-50px">
						<div class="sidebar_title" style="margin-top: -45px; margin-left: 8px; font-size:13px;"><?= session()->get('nama_jaksa'); ?></div>
					</div>
				<?php endif;  ?>
				<br>
				<div class="sidebar_section">
					<img src="<?= base_url() ?>/icon-icon/<?= session()->get('icon_beranda'); ?>" alt="" width="100%" />
				</div>
				<br>
				<!-- Advertising 2 -->
				<br>
				<?php foreach ($_SESSION['banner'] as $data) :  ?>
					<a href="<?= $data['url_banner']; ?>" target="_blank">
						<div class="sidebar_section">
							<img src="<?= base_url() ?>/uploads/banner/<?= $data['img_banner']; ?>" alt="" width="100%" height="135px" style="border: 3px solid gray; border-radius: 10px;" />
						</div>
					</a><br>
				<?php endforeach; ?>
				<div class="sidebar_section future_events">
					<div class="sidebar_title_container">
						<div class="sidebar_title">Pengumuman</div>
					</div><br>
					<!-- Future Events Post -->
					<?php
					$i = 0;
					foreach ($_SESSION['pengumuman'] as $data) : ?>
						<a href="/beranda/pengumuman/<?= $data['id_pengumuman']; ?>">
							<div class="tgl_agenda"><i class="fa fa-calendar"></i> <?= tanggal($data['tgl_pengumuman']); ?></div>
							<div class="isi_agenda"><?= $data['nama_pengumuman']; ?></div>
						</a>
						<hr>
					<?php $i++;
					endforeach; ?>
					<p>
						<a href="<?= base_url() ?>/beranda/pengumuman" class="btn btn-secondary btn-sm btn-sidebar">
							<span class="">Selengkapnya...</span>
						</a>
					</p>
				</div>

				<!-- Future Events -->
				<div class="sidebar_section future_events">
					<div class="sidebar_title_container">
						<div class="sidebar_title">Agenda</div>
					</div><br>
					<!-- Future Events Post -->
					<?php
					$i = 0;
					foreach ($_SESSION['agenda'] as $data) : ?>
						<a href="/beranda/agenda/<?= $data['id_agenda']; ?>">
							<div class="tgl_agenda"><i class="fa fa-calendar"></i> <?= tanggal($data['tanggal_agenda']); ?></div>
							<div class="isi_agenda"><?= $data['nama_agenda']; ?></div>
						</a>
						<hr>
					<?php $i++;
					endforeach; ?>
					<p>
						<a href="<?= base_url() ?>/home/agenda" class="btn btn-secondary btn-sm btn-sidebar">
							<span class="">Selengkapnya...</span>
						</a>
					</p>
				</div>

				<div class="sidebar_section future_events">
					<div class="sidebar_title_container">
						<div class="sidebar_title">Daftar Pencarian Orang</div>
					</div><br>
					<!-- Future Events Post -->

					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php
							$i = 0;
							foreach ($_SESSION['buron'] as $data) :
							?>
								<?php if ($i == 0) : ?>
									<?php $carousel = 'active'; ?>
									<div class="carousel-item dpo <?= $carousel; ?>">
										<img width="100%" src="<?= base_url() ?>/uploads/buron/<?= $data['image']; ?>" alt="">
										<p>Nama: <?= $data['nama_buron']; ?></p>
										<p>Jenis Kelamin: <?= $data['jenis_kelamin']; ?></p>
										<p>Usia: <?= $data['usia']; ?></p>
										<p>Alamat: <?= $data['alamat_buron']; ?></p>
									</div>
								<?php else : ?>
									<?php $carousel = ''; ?>
									<div class="carousel-item dpo <?= $carousel; ?>">
										<img width="100%" src="<?= base_url() ?>/uploads/buron/<?= $data['image']; ?>" alt="">
										<p>Nama: <?= $data['nama_buron']; ?></p>
										<p>Jenis Kelamin: <?= $data['jenis_kelamin']; ?></p>
										<p>Usia: <?= $data['usia']; ?></p>
										<p>Alamat: <?= $data['alamat_buron']; ?></p>
									</div>
								<?php endif; ?>
							<?php $i++;
							endforeach; ?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>

					<br>
					<!-- <p>
						<a href="#" class="btn btn-secondary btn-sm btn-sidebar">
							<span class="">Selengkapnya...</span>
						</a>
					</p> -->
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row row-lg-eq-height">
				<div class="col-md-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Kontak Informasi</b></p>
						<p style="color: white; text-align: left;">Kejaksaan Negeri Purwokerto</p>
						<p style="color: white; text-align: left;"><i class="fa fa-map-marker"></i> Jl. Gatot Subroto No.109 Purwokerto</p>
						<p style="color: white; text-align: left;"><i class="fa fa-envelope"></i> info@kejari-purwokerto.go.id</p>
						<p style="color: white; text-align: left;"><i class="fa fa-globe"></i> http://kejari-purwokerto.go.id</p>
						<p style="color: white; text-align: left;"><i class="fa fa-phone"></i> (0281) 635590</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Statistik</b></p>
						<p style="color: white; text-align: left;">User Online : 3</p>
						<p style="color: white; text-align: left;">Today Visitor : 527</p>
						<p style="color: white; text-align: left;">Hits hari ini : 2189</p>
						<p style="color: white; text-align: left;">Total Pengunjung : 31300</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Situs Terkait</b></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.kejaksaan.go.id/"><i class="fa fa-globe"></i> Kejaksaan RI</a></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.pn-purwokerto.go.id/"><i class="fa fa-globe"></i> Pengadilan Negeri Purwokerto</a></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.mahkamahagung.go.id/"><i class="fa fa-globe"></i> Mahkamah Agung</a></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Sosial Media</b></p>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="copyright align-items-center justify-content-center" style="color: #FFFFFF;">
						Copyright &copy;
						<script>
							document.write(new Date().getFullYear());
						</script> Kejaksaan Negeri Purwokerto. All rights reserved
					</div>
				</div>
			</div>
		</div>
	</footer>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<div class="floating-container">
		<div class="floating-button"><img class="floating-icon" src="<?= base_url() ?>/icon-icon/<?= session()->get('icon'); ?>" alt=""></div>
		<div class="element-container">
			<!-- Buat Database untuk dinasmi,,,  -->
			<a href="google.com"> <span class="float-element tooltip-left">
					<i class="material-icons">phone
					</i> Call Center / Pengaduan / Layanan Hukum</a>
			</span>
			<span class="float-element">
				<i class="material-icons">email
				</i> Pengembalian Barang Bukti
			</span>
			<span class="float-element">
				<i class="material-icons">chat</i> Pengambilan Tilang
			</span>
		</div>
	</div>

	</div>

	<script src="<?= base_url() ?>/template/visitor/js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url() ?>/template/visitor/styles/bootstrap4/popper.js"></script>
	<script src="<?= base_url() ?>/template/visitor/styles/bootstrap4/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="<?= base_url() ?>/template/visitor/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js"></script>
	<script src="<?= base_url() ?>/template/visitor/plugins/easing/easing.js"></script>
	<script src="<?= base_url() ?>/template/visitor/plugins/masonry/masonry.js"></script>
	<script src="<?= base_url() ?>/template/visitor/plugins/masonry/images_loaded.js"></script>
	<script src="<?= base_url() ?>/template/visitor/js/custom.js"></script>

	<script src="<?= base_url() ?>/template/visitor/js/jquery.sticky.js"></script>
	<script src="<?= base_url() ?>/template/visitor/js/main.js"></script>
</body>

</html>