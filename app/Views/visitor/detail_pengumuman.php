<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Baca Pengumuman</div>
            </div>
            <div class="section_content">
              <div class="container" style="background-color: white; border-radius: 10px; border: 1px solid grey; padding-left: 25px;"><br>
                <h2 style="color: black; text-align: left;"><b><?= $pengumuman['nama_pengumuman']; ?></b></h2>
                <p style="color: black; text-align: left;"><i class="fa fa-calendar"></i> <?= $pengumuman['tgl_pengumuman']; ?></p>
                <p style="color: black; text-align: left;"><?= $pengumuman['teks_pengumuman']; ?></p>
                <?php
                $data = explode(".", $pengumuman['file_pengumuman']);
                ?>
                <?php if ($data[1] == 'pdf') : ?>
                  <a class="btn btn-sm btn-primary" target="_blank" href="/beranda/download_pengumuman/<?= $pengumuman['file_pengumuman']; ?>">Download <i class="fa fa-download"></i></a>
                <?php else :  ?>
                  <img src="<?= base_url() ?>/dokumen/pengumuman/<?= $pengumuman['file_pengumuman']; ?>">
                <?php endif; ?>
                <br><br><br>
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
                          <a href=""></a>
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

      <?= $this->endSection(); ?>