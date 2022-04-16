<?= $this->extend('layout/visitor_template'); ?>
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
              <div class="table table-responsive table-bordered">
                <table class="display" id="tableKasus" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>No Perkara</th>
                      <th>Nama Terdakwa</th>
                      <th>Nama Hakim</th>
                      <th>Nama Jaksa</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>



      <?= $this->endSection(); ?>