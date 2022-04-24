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
            <?= $pager->links('pengumuman', 'kejari_pagination') ?>
            <?php $i = 0;
            foreach ($pengumuman as $data) : ?>
              <a href="/beranda/pengumuman/<?= $data['id_pengumuman']; ?>">
                <div class="section_content" style="background-color: white; border-radius: 10px; margin-left: 15px;">
                  <p style="font-weight: bold; font-size:large;"><?= $data['nama_pengumuman']; ?></p>
                  <p><?= $data['teks_pengumuman']; ?></p>
                  <p><?= $data['tgl_pengumuman']; ?></p>
                </div>
              </a>
              <br>
            <?php $i++;
            endforeach;  ?>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>