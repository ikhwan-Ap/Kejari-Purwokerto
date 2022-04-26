<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>
<?php function waktu($date)
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

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title"><?= $title; ?></div>
            </div>
            <?= $pager->links('pengumuman', 'kejari_pagination') ?>
            <br><br>
            <?php $i = 0;
            foreach ($pengumuman as $data) : ?>
              <a href="/beranda/pengumuman/<?= $data['id_pengumuman']; ?>">
                <div class="section_content pengumuman" style="border-radius: 10px; margin-left: 15px;">
                  <div class="container">
                    <div class="row">
                      <div class="col-1"><i style=" font-size: x-large; padding-top: 5px;" class="fa fa-file"></i></div>
                      <div class="col-11">
                        <p style="font-weight: bold; font-size:large;"><?= $data['nama_pengumuman']; ?></p>
                        <?php if (strlen($data['teks_pengumuman']) >= 175) : ?>
                          <p><?= substr($data['teks_pengumuman'], 0, 175) ?>...</p>
                        <?php else : ?>
                          <p><?= $data['teks_pengumuman'] ?></p>
                        <?php endif; ?>
                        <p><?= waktu($data['tgl_pengumuman']); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <hr>
            <?php $i++;
            endforeach;  ?>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>