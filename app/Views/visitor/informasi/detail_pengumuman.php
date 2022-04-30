<?= $this->extend('template/visitor'); ?>
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
                    <a class="btn btn-sm btn-primary" target="_blank" href="/download_pengumuman/<?= $pengumuman['file_pengumuman']; ?>">Download <i class="fa fa-download"></i></a>
                  <?php else :  ?>
                    <img class="imageClick" width="100%" style="border-radius: 10px;" src="<?= base_url() ?>/dokumen/pengumuman/<?= $pengumuman['file_pengumuman']; ?>" onclick="cekFoto(<?= $pengumuman['id_pengumuman']; ?>)">
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
                          <a href="/pengumuman/<?= $data['id_pengumuman']; ?>">
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
              <div class="modal fade" data-backdrop="false" role="dialog" id="modalFoto">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 style="color: black; font-weight: bold;" class="modal-title"></h4>
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
                              <img src="" id="image" alt="Preview Image" style="width: 100%; border-radius: 10px;">
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
              <script>
                $(document).ready(function() {
                  $('#modalFoto').modal('hide');
                })

                function cekFoto(id_pengumuman) {
                  $.ajax({
                    type: "GET",
                    url: "<?= site_url('pengumuman/get_id'); ?>/" + id_pengumuman,
                    dataType: "json",
                    success: function(data) {
                      $('#id_pengumuman').val(data.id_pengumuman);
                      $('#image').attr('src', '<?= base_url('dokumen/pengumuman'); ?>/' + data.file_pengumuman);
                      $('#modalFoto').modal('show');
                      $('.modal-title').text(data.nama_pengumuman);
                    }
                  });
                }
              </script>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>