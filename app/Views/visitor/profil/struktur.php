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
                <div class="section_title">Struktur Organisasi Kejaksaan Negeri Purwokerto</div>
              </div>
              <div class="section_content">
                <?php foreach ($struktur as $data) : ?>
                  <div style="text-align:center">
                    <img src="<?= base_url(); ?>/uploads/struktur/<?= $data['img_struktur']; ?>" class="panel_content" alt="gambar">
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>