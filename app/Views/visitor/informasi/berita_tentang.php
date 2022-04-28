<?= $this->extend('template/visitor'); ?>
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
$months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$tgl = strtotime($berita['tanggal']);
$hari = day(date('l', $tgl));
$date = date('d ', $tgl);
$mon = $months[date('n', $tgl)];
$year = date(' Y', $tgl);
$tanggal = $hari . ', ' . $date . $mon . $year;
?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel flex-row align-items-center justify-content-start" style="text-align: center">
              <div class="section_header"><?= $berita['judul_berita']; ?></div>
              <div class=""><?= $tanggal; ?></div>
            </div>
            <div class="section_content">

              <div style="text-align:center">
                <img src="<?= base_url() ?>/uploads/berita/<?= $berita['img_berita']; ?>" class="panel_content">

              </div>
              <div class="main_section">
                <p><?= $berita['teks_berita']; ?></p>
              </div>

            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>