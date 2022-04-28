<?= $this->extend('template/visitor'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Pidana Umum</div>
            </div>
            <div class="section_content">
              <?= $pager->links('umum', 'kejari_pagination') ?>
              <table class="table table-bordered table-light">
                <thead>
                  <tr style=" font-weight:bold; color:black">
                    <th>no</th>
                    <th>Hari / Tanggal</th>
                    <th>Nama Terdakwa</th>
                    <th>Nama Jaksa</th>
                    <th>Hakim</th>
                    <th>No. Perkara</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1 + (10 * ($page - 1));
                  foreach ($umum as $data) : ?>
                    <tr style="font-weight:bold; color:black">
                      <th><?= $no++; ?></th>
                      <th><?= $data['tanggal']; ?></th>
                      <th><?= $data['nama_terdakwa']; ?></th>
                      <th><?= $data['nama_jaksa']; ?></th>
                      <th><?= $data['nama_hakim']; ?></th>
                      <th><?= $data['no_perkara']; ?></th>
                      <th><?= $data['keterangan']; ?></th>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>