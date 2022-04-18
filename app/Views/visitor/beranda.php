	<?= $this->extend('layout/visitor_template'); ?>
	<?= $this->section('content'); ?>

	<!-- <div class="hero" style="background-image: url('<?= base_url() ?>/template/visitor/images/carousel.jpg');"></div> -->
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
			<li data-target="#carousel" data-slide-to="3"></li>
		</ol>

		<div class="carousel-inner">
			<?php $i = 0;
			foreach ($carousel as $row) : ?>
				<?php if ($i == 0) :  ?>
					<?php $set = 'active'; ?>
				<?php else :  ?>
					<?php $set = ''; ?>
				<?php endif; ?>
				<div class='carousel-item <?php echo $set; ?>'>
					<img class="d-block w-100" src="<?= base_url() ?>/img_carousel/<?= $row['image']; ?>">
				</div>
			<?php $i++;
			endforeach ?>
		</div>

		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<!-- Page Content -->
	<div class="page_content">

		<!-- Pelayanan -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="main_content">
						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Pelayanan</div>
							</div>
							<div class="section_content" style="margin-bottom: 20px;">

								<div class="grid clearfix">
									<!-- <?php
											$warna = 'green';
											$background = array(
												'/template/visitor/images/post_12.jpg)', '/template/visitor/images/post_6.jpg)',
												'/template/visitor/images/post_12.jpg)', '/template/visitor/images/post_6.jpg)',

											);
											$i = 0;
											foreach ($carousel as $value) :
											?>
										<a href="#">

											<div class="card card_default card_small_with_background grid-item">
												<div class="card_background" style="background-image:url(<?= base_url() ?><?= $background[$i]; ?>"></div>
												<div class="card-body">
													<div class="card-title card-title-small"><a href="post.html" style="display:block;">Pelayanan 1</a></div>
												</div>
											</div>
										</a>
									<?php
												$i++;
											endforeach;  ?> -->

									<!-- Small Card With Background -->
									<?php $i = 0;
									foreach ($pelayanan as $data) :  ?>
										<a href="<?= $data['url_pelayanan']; ?>" target="_blank">
											<div class="card card_default card_small_with_background grid-item md-sm">
												<div class="card_background" style="background-image: linear-gradient(45deg, <?= $data['warna_pelayanan']; ?>, <?= $data['gradiasi_pelayanan']; ?>)"></div>
												<div class="card-body">
													<img style="display: inline;" src="<?= base_url() ?>/img_pelayanan/<?= $data['img_pelayanan']; ?>" alt="" width="20%">
													<div class="card-title card-title-small md-sm" style="font-weight: 900; color: white;"><?= $data['nama_pelayanan']; ?></div>
												</div>
											</div>
										</a>
									<?php $i++;
									endforeach; ?>
								</div>
								<br>
								<p>
									<a href="<?= base_url() ?>/home/portal" target="_blank" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- Main Content -->

				<div class="col-lg-9">
					<div class="main_content">

						<!-- Blog Section - Latest -->

						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Informasi Publik</div>
							</div>
							<div class="section_content">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<button onclick="btnJadwal()" class="nav-link btnA actived" aria-current="page">Jadwal Sidang</button>
									</li>
									<li class="nav-item">
										<button onclick="btnUmum()" class="nav-link btnB" href="#">Info Perkara Umum</button>
									</li>
									<li class="nav-item">
										<button onclick="btnKhusus()" class="nav-link btnC" href="#">Info Perkara Khusus</button>
									</li>
									<li class="nav-item">
										<button onclick="btnPerdata()" class="nav-link btnD" href="#">Info Perkara Datun</button>
									</li>
								</ul>
								<table id="myTable" class="table table-responsive table-bordered table-light" style="width: 100%;">
									<thead id="th_jadwal">
										<tr style="font-weight:bold; color:black">
											<th hidden>no</th>
											<th>Hari / Tanggal</th>
											<th>Nama Terdakwa</th>
											<th>Nama Jaksa</th>
											<th>Hakim</th>
											<th>No. Perkara</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									<tbody id="jadwal">
										<?php $i = 1;
										foreach ($jadwal as $informasi) : ?>
											<tr style="font-weight:bold; color:black">
												<td hidden><?= $i++; ?></td>
												<td><?= $informasi['tanggal']; ?></td>
												<td><?= $informasi['nama_terdakwa']; ?></td>
												<td><?= $informasi['nama_jaksa']; ?></td>
												<td><?= $informasi['nama_hakim']; ?></td>
												<td><?= $informasi['no_perkara']; ?></td>
												<td><?= $informasi['agenda']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<thead id="th_umum">
										<tr style="font-weight:bold; color:black">
											<th>No.</th>
											<th>Tanggal</th>
											<th>No. Perkara</th>
											<th>Nama Terdakwa</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="umum">
										<?php $i = 1;
										foreach ($umum as $informasi) : ?>
											<tr style="font-weight:bold; color:black">
												<td><?= $i++; ?></td>
												<td><?= $informasi['tanggal']; ?></td>
												<td><?= $informasi['no_perkara']; ?></td>
												<td><?= $informasi['nama_terdakwa']; ?></td>
												<td><?= $informasi['keterangan']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<thead id="th_khusus">
										<tr style="font-weight:bold; color:black">
											<th>No.</th>
											<th>Tanggal</th>
											<th>No. Perkara</th>
											<th>Nama Terdakwa</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="khusus">
										<?php $i = 1;
										foreach ($khusus as $informasi) : ?>
											<tr style="font-weight:bold; color:black">
												<td><?= $i++; ?></td>
												<td><?= $informasi['tanggal']; ?></td>
												<td><?= $informasi['no_perkara']; ?></td>
												<td><?= $informasi['nama_terdakwa']; ?></td>
												<td><?= $informasi['keterangan']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<thead id="th_perdata">
										<tr style="font-weight:bold; color:black">
											<th>No.</th>
											<th>No. Perkara</th>
											<th>Nama Terdakwa</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="perdata">
										<?php $i = 1;
										foreach ($perdata as $informasi) : ?>
											<tr style="font-weight:bold; color:black">
												<td><?= $i++; ?></td>
												<td><?= $informasi['no_perkara']; ?></td>
												<td><?= $informasi['nama_terdakwa']; ?></td>
												<td><?= $informasi['keterangan']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<p id="p_perdata">
									<a href="<?= base_url() ?>/home/tata_usaha" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
								<p id="p_khusus">
									<a href="<?= base_url() ?>/home/pidana_khusus" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
								<p id="p_umum">
									<a href="<?= base_url() ?>/home/pidana_umum" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
								<p id="p_jadwal">
									<a href="<?= base_url() ?>/home/jadwal_sidang" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
							</div>
						</div>
						<!-- Blog Section - Don't Miss -->

						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Berita Terbaru</div>
							</div>
							<div class="section_content">
								<div class="grid clearfix">
									<!-- Desending / Terbaru Yg akan Di Tampilkan-->
									<?php $i = 0;
									$a = array('a', 'b', 'c', 'd');
									foreach ($carousel as $img) :  ?>
										<?php if ($i == 0) : ?>
											<?php $card = 'card_largest_with_image';  ?>
											<div class="card <?= $card; ?> grid-item">
												<img class="card-img-top" src="<?= base_url() ?>/img_carousel/<?= $img['image']; ?>" alt="https://unsplash.com/@cjtagupa">
												<div class="card-body">
													<div class="card-title"><a href="post.html"><?php echo $a[$i]; ?> Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</a></div>
													<p class="card-text">Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
													<small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></small>
												</div>
											</div>
										<?php else :  ?>
											<?php $card = 'card_small_no_image' ?>
											<div class="card card_default <?= $card; ?>  grid-item">
												<div class="card-body">
													<div class="card-title card-title-small"><a href="post.html"><?= $a[$i]; ?> How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</a></div>
													<small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></small>
												</div>
											</div>
										<?php endif; ?>
									<?php $i++;
									endforeach; ?>
									<!-- Small Card With Background -->
									<div class="card card_default card_small_with_background grid-item">
										<div class="card_background" style="<?= base_url() ?>/template/visitor/images/post_4.jpg)"></div>
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</a></div>
											<small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></small>
										</div>
									</div>

									<!-- Small Card With Image -->
									<div class="card card_small_with_image grid-item">
										<img class="card-img-top" src="<?= base_url() ?>/template/visitor/images/post_2.jpg" alt="https://unsplash.com/@jakobowens1">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</a></div>
											<small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></small>
										</div>
									</div>

									<!-- Small Card With Image -->
									<div class="card card_small_with_image grid-item">
										<img class="card-img-top" src="<?= base_url() ?>/template/visitor/images/post_3.jpg" alt="https://unsplash.com/@jannerboy62">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</a></div>
											<small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></small>
										</div>
									</div>

									<!-- Default Card No Image -->

									<div class="card card_default card_default_no_image grid-item">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most</a></div>
										</div>
									</div>

									<!-- Default Card No Image -->

									<div class="card card_default card_default_no_image grid-item">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most</a></div>
										</div>
									</div>

									<!-- Default Card No Image -->

									<div class="card card_default card_default_no_image grid-item">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.html">How Did van Gogh’s Turbulent Mind Depict One of the Most</a></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Blog Section - Videos -->

						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Video Galeri</div>
							</div>
							<div class="section_content">
								<div class="row">
									<div class="col">
										<div class="videos">
											<div class="player_container">
												<div id="P1" class="player" data-property="{videoURL:'QhOFg_3RV5Q',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
												</div>
											</div>
											<div class="playlist">
												<div class="playlist_background"></div>

												<!-- Video -->
												<div class="video_container video_command active" onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'https://www.youtube.com/watch?v=n_N8hB7CoPk', mute:false, addRaster:true})">
													<div class="video d-flex flex-row align-items-center justify-content-start">
														<div class="video_image">
															<div><img src="https://img.youtube.com/vi/QhOFg_3RV5Q/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
														</div>
														<div class="video_content">
															<div class="video_title">X-Japan - Endless Rain</div>
															<div class="video_info"><span>1.2M views</span><span>Sep 29</span></div>
														</div>
													</div>
												</div>

												<!-- Video -->
												<div class="video_container video_command" onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'https://www.youtube.com/watch?v=n_N8hB7CoPk', mute:false, addRaster:true})">
													<div class="video d-flex flex-row align-items-center justify-content-start">
														<div class="video_image">
															<div><img src="https://img.youtube.com/vi/_me2yfR7Jfk/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
														</div>
														<div class="video_content">
															<div class="video_title">X-Japan - Rusty Nail</div>
															<div class="video_info"><span>1.2M views</span><span>Sep 29</span></div>
														</div>
													</div>
												</div>

												<!-- Video -->
												<div class="video_container video_command" onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'https://www.youtube.com/watch?v=n_N8hB7CoPk', mute:false, addRaster:true})">
													<div class="video d-flex flex-row align-items-center justify-content-start">
														<div class="video_image">
															<div><img src="https://img.youtube.com/vi/8ArAnXLbFck/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
														</div>
														<div class="video_content">
															<div class="video_title">X-Japan - Kurenai</div>
															<div class="video_info"><span>1.2M views</span><span>Sep 29</span></div>
														</div>
													</div>
												</div>

												<!-- Video -->
												<div class="video_container video_command" onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'https://www.youtube.com/watch?v=n_N8hB7CoPk', mute:false, addRaster:true})">
													<div class="video d-flex flex-row align-items-center justify-content-start">
														<div class="video_image">
															<div><img src="https://img.youtube.com/vi/qlI7GAHnMfM/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
														</div>
														<div class="video_content">
															<div class="video_title">X-Japan - Tears</div>
															<div class="video_info"><span>1.2M views</span><span>Sep 29</span></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Blog Section - Latest -->

						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Foto Galeri</div>
							</div>
							<div class="section_content">

								<div class="container">
									<div class="row">
										<div class="MultiCarousel" data-items="1,2,3,3" data-slide="1" id="MultiCarousel" data-interval="1000">
											<div class="MultiCarousel-inner">
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>
												<div class="item">
													<div class="pad15">
														<img src="<?= base_url() ?>/template/visitor/images/post_6.jpg" alt="" width="100%">
														<p><i class="fa fa-clock-o"></i> 25 April 2022</p>
														<p style="font-weight: bold;">Selamat Hari Raya Nyepi Tahun Baru Saka 1944</p>
													</div>
												</div>

											</div>
											<button class="carousel-control-prev-icon leftLst"></button>
											<button class="carousel-control-next-icon rightLst"></button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center">
											<br /><br /><br />
											<hr />
											<p>Settings</p>
											<p>Change data items for xs,sm,md and lg display items respectively. Ex:data-items="1,3,5,6"</p>
											<p>Change data slide for slides per click Ex:data-slide="1"</p>
										</div>
									</div>
								</div>

								<div class="grid clearfix">

									<!-- Default Card With Background -->
									<div class="card card_default card_default_with_background grid-item"></div>
								</div>
							</div>
						</div>
					</div>
					<br><br>
				</div>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
				<script>
					$(document).ready(function() {
						var table = $('#umum').hide();
						var table = $('#khusus').hide();
						var table = $('#perdata').hide();
					})

					$.ajax({
						type: "GET",
						url: "<?= site_url('home/berita'); ?>",
						dataType: "json",
						success: function(data) {
							$('.berita').html(data.nama_buron);
						}
					});

					function btnJadwal() {
						$('#jadwal').show();
						$('#umum').hide();
						$('#khusus').hide();
						$('#perdata').hide();
					}

					function btnUmum() {
						$('#jadwal').hide();
						$('#umum').show();
						$('#khusus').hide();
						$('#perdata').hide();
					}

					function btnKhusus() {
						$('#jadwal').hide();
						$('#umum').hide();
						$('#perdata').hide();
						$('#khusus').show();
					}

					function btnPerdata() {
						$('#jadwal').hide();
						$('#umum').hide();
						$('#perdata').show();
						$('#khusus').hide();
					}

					$(document).ready(function() {
						$('#th_umum').hide();
						$('#th_khusus').hide();
						$('#th_perdata').hide();
						$('#p_umum').hide();
						$('#p_khusus').hide();
						$('#p_perdata').hide();
						$('.btnA').click(function() {
							$(this).addClass('actived');
							$('.btnB').removeClass('actived');
							$('.btnC').removeClass('actived');
							$('.btnD').removeClass('actived');
							$('#th_jadwal').show();
							$('#th_umum').hide();
							$('#th_khusus').hide();
							$('#th_perdata').hide();
							$('#p_jadwal').show();
							$('#p_umum').hide();
							$('#p_khusus').hide();
							$('#p_perdata').hide();
						});
						$('.btnB').click(function() {
							$(this).addClass('actived');
							$('.btnA').removeClass('actived');
							$('.btnC').removeClass('actived');
							$('.btnD').removeClass('actived');
							$('#th_jadwal').hide();
							$('#th_umum').show();
							$('#th_khusus').hide();
							$('#th_perdata').hide();
							$('#p_jadwal').hide();
							$('#p_umum').show();
							$('#p_khusus').hide();
							$('#p_perdata').hide();
						});
						$('.btnC').click(function() {
							$(this).addClass('actived');
							$('.btnB').removeClass('actived');
							$('.btnA').removeClass('actived');
							$('.btnD').removeClass('actived');
							$('#th_jadwal').hide();
							$('#th_umum').hide();
							$('#th_khusus').show();
							$('#th_perdata').hide();
							$('#p_jadwal').hide();
							$('#p_umum').hide();
							$('#p_khusus').show();
							$('#p_perdata').hide();
						});
						$('.btnD').click(function() {
							$(this).addClass('actived');
							$('.btnB').removeClass('actived');
							$('.btnC').removeClass('actived');
							$('.btnA').removeClass('actived');
							$('#th_jadwal').hide();
							$('#th_umum').hide();
							$('#th_perdata').show();
							$('#th_khusus').hide();
							$('#p_jadwal').hide();
							$('#p_umum').hide();
							$('#p_perdata').show();
							$('#p_khusus').hide();
						});
					});

					$(document).ready(function() {
						var itemsMainDiv = ('.MultiCarousel');
						var itemsDiv = ('.MultiCarousel-inner');
						var itemWidth = "";

						$('.leftLst, .rightLst').click(function() {
							var condition = $(this).hasClass("leftLst");
							if (condition)
								click(0, this);
							else
								click(1, this)
						});

						ResCarouselSize();
						$(window).resize(function() {
							ResCarouselSize();
						});

						//this function define the size of the items
						function ResCarouselSize() {
							var incno = 0;
							var dataItems = ("data-items");
							var itemClass = ('.item');
							var id = 0;
							var btnParentSb = '';
							var itemsSplit = '';
							var sampwidth = $(itemsMainDiv).width();
							var bodyWidth = $('body').width();
							$(itemsDiv).each(function() {
								id = id + 1;
								var itemNumbers = $(this).find(itemClass).length;
								btnParentSb = $(this).parent().attr(dataItems);
								itemsSplit = btnParentSb.split(',');
								$(this).parent().attr("id", "MultiCarousel" + id);


								if (bodyWidth >= 1200) {
									incno = itemsSplit[3];
									itemWidth = sampwidth / incno;
								} else if (bodyWidth >= 992) {
									incno = itemsSplit[2];
									itemWidth = sampwidth / incno;
								} else if (bodyWidth >= 768) {
									incno = itemsSplit[1];
									itemWidth = sampwidth / incno;
								} else {
									incno = itemsSplit[0];
									itemWidth = sampwidth / incno;
								}
								$(this).css({
									'transform': 'translateX(0px)',
									'width': itemWidth * itemNumbers
								});
								$(this).find(itemClass).each(function() {
									$(this).outerWidth(itemWidth);
								});

								$(".leftLst").addClass("over");
								$(".rightLst").removeClass("over");

							});
						}


						//this function used to move the items
						function ResCarousel(e, el, s) {
							var leftBtn = ('.leftLst');
							var rightBtn = ('.rightLst');
							var translateXval = '';
							var divStyle = $(el + ' ' + itemsDiv).css('transform');
							var values = divStyle.match(/-?[\d\.]+/g);
							var xds = Math.abs(values[4]);
							if (e == 0) {
								translateXval = parseInt(xds) - parseInt(itemWidth * s);
								$(el + ' ' + rightBtn).removeClass("over");

								if (translateXval <= itemWidth / 2) {
									translateXval = 0;
									$(el + ' ' + leftBtn).addClass("over");
								}
							} else if (e == 1) {
								var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
								translateXval = parseInt(xds) + parseInt(itemWidth * s);
								$(el + ' ' + leftBtn).removeClass("over");

								if (translateXval >= itemsCondition - itemWidth / 2) {
									translateXval = itemsCondition;
									$(el + ' ' + rightBtn).addClass("over");
								}
							}
							$(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
						}

						//It is used to get some elements from btn
						function click(ell, ee) {
							var Parent = "#" + $(ee).parent().attr("id");
							var slide = $(Parent).attr("data-slide");
							ResCarousel(ell, Parent, slide);
						}

					});
				</script>
				<?= $this->endSection(); ?>