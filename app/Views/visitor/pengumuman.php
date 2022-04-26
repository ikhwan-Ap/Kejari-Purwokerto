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
            </div>
            <?= $pager->links('pengumuman', 'kejari_pagination') ?>
            <br><br>
            <?php $i = 0;
            foreach ($pengumuman as $data) : ?>
              <a href="/beranda/pengumuman/<?= $data['id_pengumuman']; ?>">
                <div class="section_content pengumuman" style="border-radius: 10px; margin-left: 15px;">
                  <p style="font-weight: bold; font-size:large;"><?= $data['nama_pengumuman']; ?></p>
                  <?php if (strlen($data['teks_pengumuman']) >= 100) : ?>
                    <p><?= substr($data['teks_pengumuman'], 0, 175); ?>...</p>
                  <?php else : ?>
                    <p><?= $data['teks_pengumuman']; ?></p>
                  <?php endif;  ?>
                  <p><?= $data['tgl_pengumuman']; ?></p>
                </div>
              </a>
              <hr>
            <?php $i++;
            endforeach;  ?>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>