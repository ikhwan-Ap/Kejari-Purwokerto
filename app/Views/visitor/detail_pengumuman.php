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
            <div class="section_content">
              <div class="card">
                <div class="card-header" style="background-color: #24C632;">
                  <div class="section_title" style="color: white;">Baca Pengumuman</div>
                </div>
                <div class="card-body">
                  <br>
                  <h2 style="color: black; text-align: left;"><b><?= $pengumuman['nama_pengumuman']; ?></b></h2>
                  <p style="color: black; text-align: left;"><i class="fa fa-calendar"></i> <?= waktu($pengumuman['tgl_pengumuman']); ?></p>
                  <hr>
                  <p style="color: black; text-align: left;"><?= $pengumuman['teks_pengumuman']; ?></p>
                  <?php
                  $data = explode(".", $pengumuman['file_pengumuman']);
                  ?>
                  <?php if ($data[1] == 'pdf') : ?>
                    <a class="btn btn-sm btn-primary" target="_blank" href="/beranda/download_pengumuman/<?= $pengumuman['file_pengumuman']; ?>">Download <i class="fa fa-download"></i></a>
                  <?php else :  ?>
                    <img width="100%" style="border-radius: 10px;" src="<?= base_url() ?>/dokumen/pengumuman/<?= $pengumuman['file_pengumuman']; ?>">
                  <?php endif; ?>
                  <br><br><br>
                  <hr>
                  <h4 style="color: black; text-align: left;"><b>Pengumuman Lainnya:</b></h4>
                  <table class="table table-bordered">
                    <?php
                    $i = 0;
                    foreach ($_SESSION['pengumuman'] as $data) : ?>
                      <tr>
                        <td>
                          <a href="/beranda/pengumuman/<?= $data['id_pengumuman']; ?>">
                            <div class="tgl_agenda"><i class="fa fa-calendar"></i> <?= waktu($data['tgl_pengumuman']); ?></div>
                            <div class="isi_agenda"><?= $data['nama_pengumuman']; ?></div>
                          </a>
                        </td>
                      </tr>
                    <?php $i++;
                    endforeach; ?>
                  </table>
                  <br>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>