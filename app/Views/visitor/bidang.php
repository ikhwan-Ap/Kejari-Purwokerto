<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section">
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title"><?= $title['nama_kategori']; ?></div>
              </div>
              <div class="section_content">

                <div style="text-align:center">
                  <img src="<?= base_url() ?>/uploads/bidang/<?= $bidang['image_pengurus']; ?>" alt="" width="300px" class="panel_content">

                  <p style="font-weight: bold; font-size:large;"><?= $bidang['nama_pengurus']; ?></p>
                  <p style="font-weight: bold; font-size:large;"><?= $bidang['jabatan_pengurus']; ?></p>
                  <p style="font-weight: bold; font-size:large;"><?= $bidang['nip']; ?></p>

                </div>
                <div class="main_section">
                  <p><?= $bidang['teks_bidang']; ?></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>