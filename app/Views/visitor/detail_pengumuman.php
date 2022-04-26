<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Pengumuman</div>
            </div>
            <div class="section_content">
              <div class="container" style="background-color: white;"><br>
                <h2 style="color: black; text-align: left;"><b><?= $pengumuman['nama_pengumuman']; ?></b></h2>
                <p style="color: black; text-align: left;"><?= $pengumuman['tgl_pengumuman']; ?></p>
                <p style="color: black; text-align: left;"><?= $pengumuman['teks_pengumuman']; ?></p>
                <?php
                $data = explode(".", $pengumuman['file_pengumuman']);
                ?>
                <?php if ($data[1] == 'pdf') : ?>
                  <a target="_blank" href="/beranda/download_pengumuman/<?= $pengumuman['file_pengumuman']; ?>">Download file disini</a>
                <?php else :  ?>
                  <img src="<?= base_url() ?>/dokumen/pengumuman/<?= $pengumuman['file_pengumuman']; ?>">
                <?php endif; ?>
                <br><br>
                <h3 style="color: black; text-align: left;"><b>Pengumuman Lainnya:</b></h3>
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