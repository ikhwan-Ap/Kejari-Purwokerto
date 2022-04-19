<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>
<?php

function day($day){
  switch ($day) {
      case 'Sunday':
          return 'Minggu';
          break;
      case 'Monday':
          return 'Senin';
          break;
      case 'Tuesday':
          return 'Selasa';
          break;
      case 'Wednesday':
          return 'Rabu';
          break;
      case 'Thursday':
          return 'Kamis';
          break;
      case 'Friday':
          return 'Jumat';
          break;
      case 'Saturday':
          return 'Sabtu';
          break;
  }
}

function mon($mon){
  switch ($mon) {
      case 'January':
          return 'Januari';
          break;
      case 'February':
          return 'Februari';
          break;
      case 'March':
          return 'Maret';
          break;
      case 'April':
          return 'April';
          break;
      case 'May':
          return 'Mei';
          break;
      case 'June':
          return 'Juni';
          break;
      case 'July':
          return 'Juli';
          break;
      case 'August':
          return 'Agustus';
          break;
      case 'September':
          return 'September';
          break;
      case 'October':
          return 'Oktober';
          break;
      case 'November':
          return 'November';
          break;
      case 'December':
          return 'Desember';
          break;
  }
}

$tgl = strtotime($berita['tanggal']);
$hari = day(date('l', $tgl));
$mon = mon(date('F', $tgl));
$d = date(', d ', $tgl);
$th = date(' Y', $tgl);
$tanggal = $hari.$d.$mon.$th;
?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel flex-row align-items-center justify-content-start">
              <div class="section_header"><?= $berita['judul_berita']; ?></div>
              <div class=""><?= $tanggal; ?></div>
            </div>
            <div class="section_content">

              <div style="text-align:center">
                <img src="<?= base_url() ?>/uploads/berita/<?= $berita['img_berita']; ?>" alt="" width="300px">

              </div>
              <div class="main_section">
                <p><?= $berita['tanggal'] ?><?= $berita['teks_berita']; ?></p>
              </div>

            </div>
          </div>
        </div>
      </div>

<?= $this->endSection(); ?>