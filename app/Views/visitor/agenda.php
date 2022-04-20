<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<!-- <script>
  function() {}
</script> -->

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title"><?= $title; ?></div>
            </div><br>
            <?= $pager->links() ?>
            <?php $i = 0;
            foreach ($agenda as $data) : ?>
              <a href="/beranda/agenda/<?= $data['id_agenda']; ?>">
                <div class="section_content" style="background-color: white; border-radius: 10px; margin-left: 15px;">
                  <p style="font-weight: bold; font-size:large;"><?= $data['nama_agenda']; ?></p>
                  <p><?= $data['teks_agenda']; ?></p>
                  <p><?= $data['tanggal_agenda']; ?></p>
                </div>
              </a>
              <br>
            <?php $i++;
            endforeach;  ?>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>