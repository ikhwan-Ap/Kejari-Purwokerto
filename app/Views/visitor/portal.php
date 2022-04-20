<!DOCTYPE html>
<html lang="en">

<head>
	<title>Website Resmi Kejaksaan Negeri Purwokerto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Demo project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/visitor/styles/portal.css">
	<link href="<?= base_url() ?>/template/visitor/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" />
</head>

<body>
	<div style="text-align: left; margin-left:15px">
		<a href="<?= base_url() ?>/home" class="btn btn-danger">&#60; Kembali</a>
	</div>
	<img src="<?= base_url() ?>/template/visitor/images/logoportal.png" alt=""><br><br>
	<h1 style="color: black; font-size: xx-large; font-weight: bolder;">Portal Layanan Kejari Purwokerto</h1>
	<hr>
	<div class="container">
		<div class="row">
			<?php $i = 0;
			foreach ($pelayanan as $data) :  ?>
				<div class="col-md-4">
					<a href="<?= $data['url_pelayanan']; ?>">
						<div class="card card_default card_small_with_background grid-item" style="width: 100%;">
							<div class="card_background" style="background-image: linear-gradient(45deg, <?= $data['warna_pelayanan']; ?>, <?= $data['gradiasi_pelayanan']; ?>)"></div>
							<div class="card-body">
								<img src="<?= base_url() ?>/img_pelayanan/<?= $data['img_pelayanan']; ?>" alt="" height="60px">
								<div class="card-title card-title-small md-sm" style="font-weight: 900; color: white;"><?= $data['nama_pelayanan']; ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php $i++;
			endforeach; ?>

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