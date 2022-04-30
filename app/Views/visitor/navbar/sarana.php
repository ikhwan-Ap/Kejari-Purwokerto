<?= $this->extend('template/visitor'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section">
              <div class="section_panel flex-row align-items-center justify-content-start">
                <div class="section_title"><?= $sarana['nama_kategori_sarana']; ?></div>
              </div>
              <div class="section_content">

                <div style="text-align:center">
                  <img src="<?= base_url(); ?>/uploads/sarana/<?= $sarana['img_sarana']; ?>" class="panel_content" alt="gambar">

                </div>
                <div class="section_content post">
                  <p><?= $sarana['teks_sarana']; ?></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>