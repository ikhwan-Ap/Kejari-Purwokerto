<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Jadwal Sidang</div>
            </div>
            <div class="section_content">

              <table class="table table-responsive table-bordered table-light">
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
                  <?php $no = 1;
                  foreach ($jadwal as $data) : ?>
                    <tr style="font-weight:bold; color:black">
                      <th><?= $no++; ?></th>
                      <th><?= $data['tanggal']; ?></th>
                      <th><?= $data['nama_terdakwa']; ?></th>
                      <th><?= $data['nama_jaksa']; ?></th>
                      <th><?= $data['nama_hakim']; ?></th>
                      <th><?= $data['no_perkara']; ?></th>
                      <th><?= $data['agenda']; ?></th>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <?= $pager->links() ?>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>