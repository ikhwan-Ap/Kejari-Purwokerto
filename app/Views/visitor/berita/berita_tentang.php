<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>
<?php

function day($day)
{
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

$tgl = strtotime($berita['tanggal']);
$hari = day(date('l', $tgl));
<<<<<<< HEAD
$bulan = date(',d F Y', $tgl);
$tanggal = $hari . $bulan;
=======
$bulan = date(', F Y', $tgl);
$tanggal = $hari.$bulan;
>>>>>>> aa46912abbf5611edc3f251d66fdea0b90551b1d
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