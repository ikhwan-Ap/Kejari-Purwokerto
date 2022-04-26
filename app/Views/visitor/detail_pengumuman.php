<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

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
                  <p style="color: black; text-align: left;"><i class="fa fa-calendar"></i> <?= $pengumuman['tgl_pengumuman']; ?></p>
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
                            <div class="tgl_agenda"><i class="fa fa-calendar"></i> <?= $data['tgl_pengumuman']; ?></div>
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