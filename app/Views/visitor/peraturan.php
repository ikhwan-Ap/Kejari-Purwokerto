<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title"><?= $title['nama_kategori_peraturan']; ?></div>
            </div>
            <div class="section_content">
              <div class="container">
                <table class="table table-bordered table-light" style="width: 100%;">
                  <thead>
                    <tr style="font-weight:bold; color:black">
                      <th style="width: 15px;">No</th>
                      <th>Nama Peraturan</th>
                      <th>File</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($peraturan as $data) : ?>
                      <tr style="font-weight:bold; color:black">
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_peraturan']; ?></td>
                        <td><a target="_blank" href="<?= base_url('/beranda/download_peraturan'); ?>/<?= $data['file_peraturan']; ?>">Download <i class="fa fa-download"></i></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>