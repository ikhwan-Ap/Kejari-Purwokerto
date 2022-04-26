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
                <div class="section_title">Arsip Foto</div>
              </div>
              <div class="section_content">

                <div class="container">
                  <div class="row">

                    <?php $i = 1;
                    foreach ($foto as $data) :  ?>
                      <div class="col-md-4" style="text-align: center; margin-bottom: 25px;">
                        <img src="<?= base_url() ?>/img_arsip/foto/<?= $data['img_arsip_foto'] ?>" alt="" width="100%" style="border-radius: 10px;">
                        <p style="font-size: large;"><?= $data['nama_arsip_foto']; ?></p>
                      </div>
                    <?php $i++;
                    endforeach; ?>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>