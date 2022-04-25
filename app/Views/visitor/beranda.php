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
									foreach ($berita as $data) :  ?>
										<?php if ($i == 0) : ?>
											<?php $card = 'card_largest_with_image';  ?>
											<div class="card <?= $card; ?> grid-item">
												<img class="card-img-top" height="600px" src="<?= base_url() ?>/uploads/berita/<?= $data['img_berita']; ?>" alt="https://unsplash.com/@cjtagupa">
												<div class="card-body">
													<div class="card-title"><a href="post.html"><?= $data['judul_berita']; ?></a></div>
													<p class="card-text"><?= $data['teks_berita']; ?></p>
													<small class="post_meta"><a href="#">Katy Liu</a><span><?= $data['tanggal']; ?></span></small>
												</div>
											</div>
										<?php else :  ?>
											<?php $card = 'card_small_no_image' ?>
											<div class="card card_default <?= $card; ?> grid-item">
												<div class="card-body">
													<div class="card-title card-title-small"><a href="post.html"><?= $data['judul_berita']; ?></a></div>
													<img class="card-img-top" src="<?= base_url() ?>/uploads/berita/<?= $data['img_berita']; ?>" alt="https://unsplash.com/@cjtagupa">
													<small class="post_meta"><a href="#">Katy Liu</a><span><?= $data['tanggal']; ?></span></small>
												</div>
											</div>
										<?php endif; ?>
									<?php $i++;
									endforeach; ?>

								</div><br>
								<p>
									<a href="<?= base_url() ?>/home/portal" target="_blank" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
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
												<div id="P1" class="player" data-property="{videoURL:'<?= session()->get('video_cover'); ?>',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
												</div>
											</div>
											<div class="playlist">
												<div class="playlist_background"></div>

												<?php $i = 1;
												foreach ($video as $data) :  ?>
													<!-- Video -->
													<div class="video_container video_command <?= ($i == 1) ? 'active' : '' ?>" onclick="jQuery('#P1').YTPChangeVideo({videoURL: '<?= $data['url']; ?>', mute:false, addRaster:true})">
														<div class="video d-flex flex-row align-items-center justify-content-start">
															<div class="video_image">
																<div><img src="https://img.youtube.com/vi/<?= $data['url']; ?>/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
															</div>
															<div class="video_content">
																<div class="video_title"><?= $data['judul_video']; ?></div>
																<div class="video_info"><span>1.2M views</span><span>Sep 29</span></div>
															</div>
														</div>
													</div>
												<?php $i++;
												endforeach; ?>

											</div>
										</div>
									</div>
								</div>
								<br>
								<p>
									<a href="#" target="_blank" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>
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
												<?php $i = 0;
												foreach ($_SESSION['foto'] as $data) :
												?>
													<div class="item">
														<div class="pad15" onclick="cekFoto(<?= $data['id_arsip_foto']; ?>)">
															<img src="<?= base_url() ?>/img_arsip/foto/<?= $data['img_arsip_foto']; ?>" alt="" width="100%" height="150px">
															<p><i class="fa fa-clock-o"></i> <?= $data['tanggal_arsip_foto']; ?></p>
															<p style="font-weight: bold;"><?= $data['nama_arsip_foto']; ?></p>
														</div>
													</div>
												<?php $i++;
												endforeach; ?>
											</div>
											<button class="carousel-control-prev-icon leftLst"></button>
											<button class="carousel-control-next-icon rightLst"></button>
										</div>
									</div>
								</div>

								<p>
									<a href="#" target="_blank" class="btn btn-success">
										<span class="label label-default">Selengkapnya...</span>
									</a>
								</p>

								<div class="modal fade" data-backdrop="false" role="dialog" id="modalFoto">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"></h5>
												<button type="button" onclick="reset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body form_kasus">
												<div class="card-body Proses ">
													<div class="card-body Method">
														<input type="hidden" value="" id="id_arsip_foto" name="id_arsip_foto" />
														<div class="dropzone" id="mydropzone">
															<div class="fallback">
																<img src="" id="image" alt="Preview Image" style="width: 100%; ">
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="modal-footer Foot">
										</div>
									</div>
								</div>
							</div>

							<div class="grid clearfix">

								<!-- Default Card With Background -->
								<div class="card card_default card_default_with_background grid-item"></div>
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

						$.ajax({
							type: "GET",
							url: "<?= site_url('home/berita'); ?>",
							dataType: "json",
							success: function(data) {
								$('.berita').html(data.nama_buron);
							}
						});

						$('#modalFoto').modal('hide');
					})



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

					function cekFoto(id_arsip_foto) {
						$.ajax({
							type: "GET",
							url: "<?= site_url('arsip/get_id'); ?>/" + id_arsip_foto,
							dataType: "json",
							success: function(data) {
								$('#id_arsip_foto').val(data.id_arsip_foto);
								$('#image').attr('src', '<?= base_url('img_arsip/foto'); ?>/' + data.img_arsip_foto);
								$('#modalFoto').modal('show');
								$('.modal-title').text('Foto Galeri');
							}
						});
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