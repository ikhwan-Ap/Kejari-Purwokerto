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
                <div class="section_title">Nama profil</div>
              </div>
              <div class="section_content">

                <div style="text-align:center">
                  <img src="<?= base_url('/uploads/logo.jpg'); ?>" class="panel_content" alt="gambar">

                </div>
                <div class="main_section">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ducimus dolor mollitia hic necessitatibus dolore, ut iste nostrum unde, harum ipsa earum quas, a error. Maiores nulla dicta reprehenderit quae.</p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>