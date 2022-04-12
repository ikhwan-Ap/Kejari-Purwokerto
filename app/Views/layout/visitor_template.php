<!DOCTYPE html>
<html lang="en">
<head>
<title>Website Resmi Kejaksaan Negeri Purwokerto</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/styles/bootstrap4/bootstrap.min.css">
<link href="<?=base_url()?>/template/visitor/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/visitor/styles/responsive.css">
</head>
<body>

<div class="super_container">
	<!-- Header -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<nav class="main_nav">
							<ul>
								<li class="active"><a href="#">Beranda</a></li>
								<li><a href="#">Profil</a></li>
								<li><a href="#">Reformasi Birokrasi</a></li>
								<li><a href="#">Info Perkara</a></li>
								<li><a href="#">Bidang</a></li>
								<li><a href="#">Sarana</a></li>
								<li><a href="#">Peraturan</a></li>
								<li><a href="#">Informasi</a></li>
								<li><a href="#">Kontak Kami</a></li>
							</ul>
						</nav>
						<div class="hamburger ml-auto menu_mm">
							<i class="fa fa-bars trans_200 menu_mm" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="logo menu_mm"><a href="#">Avision</a></div>
		<div class="search">
			<form action="#">
				<input type="search" class="header_search_input menu_mm" required="required" placeholder="Type to Search...">
				<img class="header_search_icon menu_mm" src="<?=base_url()?>/template/visitor/images/search_2.png" alt="">
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="#">Beranda</a></li>
				<li class="menu_mm"><a href="#">Profil</a></li>
        <li class="menu_mm"><a href="#">Reformasi Birokrasi</a></li>
        <li class="menu_mm"><a href="#">Info Perkara</a></li>
        <li class="menu_mm"><a href="#">Bidang</a></li>
        <li class="menu_mm"><a href="#">Sarana</a></li>
        <li class="menu_mm"><a href="#">Peraturan</a></li>
        <li class="menu_mm"><a href="#">Informasi</a></li>
        <li class="menu_mm"><a href="#">Kontak Kami</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		
		<!-- Home Slider -->

		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(<?=base_url()?>/template/visitor/images/home_slider.jpg)"></div>
				</div>

        <!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(<?=base_url()?>/template/visitor/images/home_slider.jpg)"></div>
				</div>

        <!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(<?=base_url()?>/template/visitor/images/home_slider.jpg)"></div>
				</div>
			</div>

			<div class="custom_nav_container home_slider_nav_container">
				<div class="custom_prev custom_prev_home_slider">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
						<polyline fill="#FFFFFF" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
					</svg>
				</div>
		        <ul id="custom_dots" class="custom_dots custom_dots_home_slider">
					<li class="custom_dot custom_dot_home_slider active"><span></span></li>
					<li class="custom_dot custom_dot_home_slider"><span></span></li>
					<li class="custom_dot custom_dot_home_slider"><span></span></li>
				</ul>
				<div class="custom_next custom_next_home_slider">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
						<polyline fill="#FFFFFF" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
					</svg>
				</div>
			</div>

		</div>
	</div>

<?= $this->renderSection('content'); ?>

<!-- Sidebar -->

<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>

						<!-- Top Stories -->

						<div class="sidebar_section">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Kepala Kejaksaan Negeri Purwokerto</div>
							</div><br>
							<img src="<?=base_url()?>/template/visitor/images/kepala.jpg" alt="" width="100%">
						</div>
						
						<!-- Advertising 2 -->
						<br>
						<div class="sidebar_section">
							<a href="https://www.lapor.go.id/"><img src="<?=base_url()?>/template/visitor/images/lapor.jpg" alt="" width="100%"></a>
						</div>
						<br>
						<div class="sidebar_section">
							<a href="https://www.kejaksaan.go.id/pengaduan.php"><img src="<?=base_url()?>/template/visitor/images/laporkan.jpg" alt="" width="100%"></a>
						</div>


						<!-- Future Events -->

						<div class="sidebar_section future_events">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Agenda</div>
							</div><br>
							<!-- Future Events Post -->
							<div class="side_post">
								<a href="post.html">
									<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
										<div class="event_date d-flex flex-column align-items-center justify-content-center">
											<div class="event_day">13</div>
											<div class="event_month">apr</div>
										</div>
										<div class="side_post_content">
											<div class="side_post_title">Pencanangan Zona Integritas Wilayah Bebas dari Korupsi (WBK) menuju Wilayah Birokrasi Bersih Melayani (WBBM)</div>
										</div>
									</div>
								</a>
							</div>

							<!-- Future Events Post -->
							<div class="side_post">
								<a href="post.html">
									<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
										<div class="event_date d-flex flex-column align-items-center justify-content-center">
											<div class="event_day">27</div>
											<div class="event_month">apr</div>
										</div>
										<div class="side_post_content">
											<div class="side_post_title">Bakti Sosial Peduli & Berbagi Pada Dunia</div>
										</div>
									</div>
								</a>
							</div>

							<!-- Future Events Post -->
							<div class="side_post">
								<a href="post.html">
									<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
										<div class="event_date d-flex flex-column align-items-center justify-content-center">
											<div class="event_day">02</div>
											<div class="event_month">may</div>
										</div>
										<div class="side_post_content">
											<div class="side_post_title">Temu Sapa Wartawan Pada Kejaksaan Negeri Denpasar</div>
										</div>
									</div>
								</a>
							</div>

							<!-- Future Events Post -->
							<div class="side_post">
								<a href="post.html">
									<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
										<div class="event_date d-flex flex-column align-items-center justify-content-center">
											<div class="event_day">09</div>
											<div class="event_month">may</div>
										</div>
										<div class="side_post_content">
											<div class="side_post_title">Silaturahmi Ke Walikota Dan Wakil Walikota Denpasar Beserta Jajaran</div>
										</div>
									</div>
								</a>
							</div>
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
				<div class="col-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Kontak Informasi</b></p>
						<p style="color: white; text-align: left;">Kejaksaan Negeri Purwokerto</p>
						<p style="color: white; text-align: left;"><i class="fa fa-map-marker"></i> Jl. Gatot Subroto No.109 Purwokerto</p>
						<p style="color: white; text-align: left;"><i class="fa fa-envelope"></i> info@kejari-purwokerto.go.id</p>
						<p style="color: white; text-align: left;"><i class="fa fa-globe"></i> http://kejari-purwokerto.go.id</p>
						<p style="color: white; text-align: left;"><i class="fa fa-phone"></i> (0281) 635590</p>
					</div>
				</div>
				<div class="col-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Statistik</b></p>
						<p style="color: white; text-align: left;">User Online : 3</p>
						<p style="color: white; text-align: left;">Today Visitor : 527</p>
						<p style="color: white; text-align: left;">Hits hari ini : 2189</p>
						<p style="color: white; text-align: left;">Total Pengunjung : 31300</p>
					</div>
				</div>
				<div class="col-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Situs Terkait</b></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.kejaksaan.go.id/"><i class="fa fa-globe"></i> Kejaksaan RI</a></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.pn-purwokerto.go.id/"><i class="fa fa-globe"></i> Pengadilan Negeri Purwokerto</a></p>
						<p style="color: white; text-align: left;"><a style="color: white;" href="https://www.mahkamahagung.go.id/"><i class="fa fa-globe"></i> Mahkamah Agung</a></p>
					</div>
				</div>
				<div class="col-3">
					<div class="footer_content">
						<p style="color: white; text-align: left;"><b>Sosial Media</b></p>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="copyright align-items-center justify-content-center" style="color: #FFFFFF;">
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> Kejaksaan Negeri Purwokerto. All rights reserved
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="<?=base_url()?>/template/visitor/js/jquery-3.2.1.min.js"></script>
<script src="<?=base_url()?>/template/visitor/styles/bootstrap4/popper.js"></script>
<script src="<?=base_url()?>/template/visitor/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?=base_url()?>/template/visitor/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?=base_url()?>/template/visitor/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js"></script>
<script src="<?=base_url()?>/template/visitor/plugins/easing/easing.js"></script>
<script src="<?=base_url()?>/template/visitor/plugins/masonry/masonry.js"></script>
<script src="<?=base_url()?>/template/visitor/plugins/masonry/images_loaded.js"></script>
<script src="<?=base_url()?>/template/visitor/js/custom.js"></script>
</body>
</html>