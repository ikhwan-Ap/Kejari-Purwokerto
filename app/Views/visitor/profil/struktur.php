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
                <div class="section_title">Struktur Organisasi Kejaksaan Negeri Purwokerto</div>
              </div>
              <div class="section_content">
                <div class="container">
                  <div class="row">
                    <?php foreach ($struktur as $data) : ?>
                      <div class="col-md-6">
                        <div class="imageClick" style="text-align:center">
                          <img src="<?= base_url(); ?>/uploads/struktur/<?= $data['img_struktur']; ?>" class="panel_content" alt="gambar" width="100%" onclick="cekFoto(<?= $data['id_struktur']; ?>)">
                          <p style="font-size: large;"><?= $data['nama_struktur']; ?></p>
                        </div>
                      </div>
                      <hr>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="modal fade" data-backdrop="false" role="dialog" id="modalFoto">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 style="color: black; font-weight: bold;" class="modal-title"></h4>
                        <button type="button" onclick="reset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body form_kasus">
                        <div class="card-body Proses ">
                          <div class="card-body Method">
                            <input type="hidden" value="" id="id_arsip_foto" name="id_arsip_foto" />
                            <div class="dropzone" id="mydropzone">
                              <div class="fallback">
                                <img src="" id="image" alt="Preview Image" style="width: 100%; ">
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer Foot">
                    </div>
                  </div>
                </div>
                <script>
                  $(document).ready(function() {
                    $('#modalFoto').modal('hide');
                  })

                  function cekFoto(id_struktur) {
                    $.ajax({
                      type: "GET",
                      url: "<?= site_url('struktur/get_id'); ?>/" + id_struktur,
                      dataType: "json",
                      success: function(data) {
                        $('#id_struktur').val(data.id_struktur);
                        $('#image').attr('src', '<?= base_url('uploads/struktur'); ?>/' + data.img_struktur);
                        $('#modalFoto').modal('show');
                        $('.modal-title').text(data.nama_struktur);
                      }
                    });
                  }
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>