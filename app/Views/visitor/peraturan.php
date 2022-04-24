<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Peraturan</div>
            </div>
            <div class="section_content">
              <div class="container">
                <table class="table table-bordered" style="width: 100%;">
                  <thead>
                    <tr>
                      <th style="width: 15px;">No</th>
                      <th>Nama</th>
                      <th style="width: 100px;">File</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>No</td>
                      <td>Nama</td>
                      <td>File</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>