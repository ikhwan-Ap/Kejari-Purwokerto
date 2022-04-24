<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section">
              <div class="section_panel flex-row align-items-center justify-content-start">
                <div class="section_title"><?= $data_profil['nama_kategori_profil']; ?></div>
              </div>
              <div class="section_content">

                <div style="text-align:center">
                  <img src="<?= base_url(); ?>/uploads/profil/<?= $data_profil['img_profil']; ?>" class="panel_content" alt="gambar">

                </div>
                <div class="main_section">
                  <p><?= $data_profil['teks_profil']; ?></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>