<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title">Baca Agenda</div>
            </div>
            <div class="section_content">
              <div class="container" style="background-color: white; border-radius: 10px; border: 1px solid grey; padding-left: 25px;"><br>
                <h2 style="color: black; text-align: left;"><b><?= $agenda['nama_agenda']; ?></b></h2>
                <p style="color: black; text-align: left;"><?= $agenda['tanggal_agenda']; ?></p>
                <p style="color: black; text-align: left;"><?= $agenda['teks_agenda']; ?></p><br>
                <br><br><br>
                <h4 style="color: black; text-align: left;"><b>Agenda Lainnya:</b></h4>
                <table class="table table-bordered table-light">
                  <?php
                  $i = 0;
                  foreach ($_SESSION['agenda'] as $data) : ?>
                    <tr>
                      <td>
                        <a href="/beranda/agenda/<?= $data['id_agenda']; ?>">
                          <div class="tgl_agenda"><i class="fa fa-calendar"></i> <?= $data['tanggal_agenda']; ?></div>
                          <div class="isi_agenda"><?= $data['nama_agenda']; ?></div>
                        </a>
                      </td>
                    </tr>
                  <?php $i++;
                  endforeach; ?>
                </table>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>