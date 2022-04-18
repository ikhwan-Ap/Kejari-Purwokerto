<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section" style="margin-top:15px">
              <div class="content_title">
                <?= $title; ?>
              </div>
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title">Visi</div>
              </div>
              <div class="section_content">
                <?= $visi['visi']; ?>
              </div>
              <br>
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title">Misi</div>
              </div>
              <div class="section_content">
                <?= $misi['misi']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>