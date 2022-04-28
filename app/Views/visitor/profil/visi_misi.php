<?= $this->extend('template/visitor'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section" style="margin-top:15px">
              <div style="color: black; font-weight: bolder; font-size: x-large; text-align: center;">
                <?= $title; ?>
              </div>
              <br>
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title" style="text-align: center;">Visi</div>
              </div>
              <div class="section_content post" style="color: black; padding-top: 20px; text-align: justify;">
                <?= $visi['visi']; ?>
              </div>
              <br>
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title" style="text-align: center;">Misi</div>
              </div>
              <div class="section_content post" style="color: black; padding-top: 20px;">
                <?= $misi['misi']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>