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

                <div class="container" style="padding: 0;">
                  <div class="row">

                    <?php $i = 1;
                    foreach ($foto as $data) :  ?>
                      <div class="col-md-4" style="text-align: center; margin-bottom: 25px;" onclick="cekFoto(<?= $data['id_arsip_foto']; ?>)">
                        <img src="<?= base_url() ?>/img_arsip/foto/<?= $data['img_arsip_foto'] ?>" alt="" width="100%" height="150px" style="border-radius: 10px;">
                        <p style="font-size: large;"><?= $data['nama_arsip_foto']; ?></p>
                      </div>
                    <?php $i++;
                    endforeach; ?>

                  </div>
                </div>
                <div class="modal fade" data-backdrop="false" role="dialog" id="modalFoto">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title"></h5>
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

                  function cekFoto(id_arsip_foto) {
                    $.ajax({
                      type: "GET",
                      url: "<?= site_url('arsip/get_id'); ?>/" + id_arsip_foto,
                      dataType: "json",
                      success: function(data) {
                        $('#id_arsip_foto').val(data.id_arsip_foto);
                        $('#image').attr('src', '<?= base_url('img_arsip/foto'); ?>/' + data.img_arsip_foto);
                        $('#modalFoto').modal('show');
                        $('.modal-title').text('Foto Galeri');
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