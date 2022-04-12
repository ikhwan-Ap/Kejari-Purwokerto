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
		var today=new Date(),
		curr_hour=today.getHours(),
		curr_min=today.getMinutes(),
		curr_sec=today.getSeconds();
		curr_hour=checkTime(curr_hour);
		curr_min=checkTime(curr_min);
		curr_sec=checkTime(curr_sec);
		document.getElementById('clock').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year + '  ' + curr_hour+":"+curr_min+":"+curr_sec;
	}
	function checkTime(i) {
		if (i<10) {
			i="0" + i;
		}
		return i;
	}
	setInterval(startTime, 500);
</script>

<div class="super_container">
	<!-- Header -->
	<header class="header">
		<div class="hidden-xs hidden-sm">
			<div style="background-color: #FFFFFF;">
				<div class="container">
					<div class="row">
						<div class="col-sm-4" style="color:#000; text-align:left; padding-left:55px">
							<div style="margin-top:8px"><i class="fa fa-clock-o" style="color: #000000"></i>
								<span id="clock"></span>
							</div>			
						</div>
						<div class="col-md-1" style="padding: 0px;margin:0px;">
						</div>
						<div class="col-md-5" style="padding-right:0px; ">
							<div class="">
								<div class="row" style="margin:unset">
									<div class="col-sm-12" style="background-color: #ffffff">
										<!-- get marquee css -->
										<script type="text/javascript">
											var use_debug = false;
											function debug(){
												if( use_debug && window.console && window.console.log ) console.log(arguments);
											}
											// on DOM ready
											$(document).ready(function (){
												$(".marquee").marquee({
													loop: -1
													// this callback runs when the marquee is initialized
													, init: function ($marquee, options){
														debug("init", arguments);
														// shows how we can change the options at runtime
														if( $marquee.is("#marquee2") ) options.yScroll = "bottom";
													}
													// this callback runs before a marquee is shown
													, beforeshow: function ($marquee, $li){
														debug("beforeshow", arguments);
														// check to see if we have an author in the message (used in #marquee6)
														var $author = $li.find(".author");
														// move author from the item marquee-author layer and then fade it in
														if( $author.length ){
															$("#marquee-author").html("<span style='display:none;'>" + $author.html() + "</span>").find("> span").fadeIn(850);
														}
													}
													// this callback runs when a has fully scrolled into view (from either top or bottom)
													, show: function (){
														debug("show", arguments);
													}
													// this callback runs when a after message has being shown
													, aftershow: function ($marquee, $li){
														debug("aftershow", arguments);
														// find the author
														var $author = $li.find(".author");
														// hide the author
														if( $author.length ) $("#marquee-author").find("> span").fadeOut(250);
													}
												});
											});
															
											var iNewMessageCount = 0;
											
											function addMessage(selector){
												// increase counter
												iNewMessageCount++;
												// append a new message to the marquee scrolling list
												var $ul = $(selector).append("<li>New message #" + iNewMessageCount + "</li>");
												// update the marquee
												$ul.marquee("update");
											}
															
											function pause(selector){
												$(selector).marquee('pause');
											}
											
											function resume(selector){
												$(selector).marquee('resume');
											}
										</script>
										<!-- ul running text -->
										<!-- <ul id="marquee1" class="marquee" style="margin-top:5px;">
											<li style="color:#000000">Selamat Datang di Website Resmi Kejaksaan Negeri Denpasar. Kejaksaan Negeri Denpasar Solid Menuju Wilayah Birokrasi Bersih Melayani</li>
										</ul> -->

									</div>
								</div>
							</div>
						</div><!-- .col-md-offset-2 col-md-6 -->

						<div class="col-md-2" style="padding: 7px; text-align:left">
							<span class="margin-right-5 margin-top-10">
								<a target="_blank" href="https://www.instagram.com/kejari_denpasar/"style="">
									<b><i style="font-size:20px; width:30px; color:#000" class="fa fa-instagram"></i></b>
								</a>    
							</span>
							<span class="margin-right-5 margin-top-10">	
								<a target="_blank" href="https://www.youtube.com/kejaridenpasar"style="">
									<b><i style="font-size:20px; width:30px; color:#000" class="fa fa-youtube"></i></b>
								</a>    
							</span>
							<span class="margin-right-5 margin-top-10">
								<a target="_blank" href="https://www.facebook.com/kejaridenpasar"style="">
									<b><i style="font-size:20px; width:30px; color:#000" class="fa fa-facebook"></i></b>
								</a>    
							</span>
						</div> <!-- .col-md-4 -->
					</div> <!-- .row -->
        </div> <!-- .container -->
    	</div>
		</div>
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
							<a href=""><img src="<?=base_url()?>/template/visitor/images/lapor.jpg" alt="" width="100%"></a>
						</div>
						<br>
						<div class="sidebar_section">
							<a href=""><img src="<?=base_url()?>/template/visitor/images/laporkan.jpg" alt="" width="100%"></a>
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
				<div class="col-lg-9 order-lg-1 order-2">
					<div class="footer_content">
						<div class="footer_logo"><a href="#">avision</a></div>
						<div class="footer_social">
							<ul>
								<li class="footer_social_facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li class="footer_social_twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li class="footer_social_pinterest"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li class="footer_social_vimeo"><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
								<li class="footer_social_instagram"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li class="footer_social_google"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>. Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
					</div>
				</div>
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="subscribe">
						<div class="subscribe_background"></div>
						<div class="subscribe_content">
							<div class="subscribe_title">Subscribe</div>
							<form action="#">
								<input type="email" class="sub_input" placeholder="Your Email" required="required">
								<button class="sub_button">
									<svg version="1.1" id="link_arrow_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
										<polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
									</svg>
								</button>
							</form>
						</div>
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