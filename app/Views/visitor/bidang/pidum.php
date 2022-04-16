<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="blog_section">
            <div class="section_panel d-flex flex-row align-items-center justify-content-start">
              <div class="section_title"><?= $bidang['nama_pengurus ']; ?></div>
            </div>
            <div class="post_content">
              <div class="post_body">

                <div style="text-align:center">
                  <img src="<?= base_url() ?>/template/visitor/images/kepala.jpg" alt="" width="300px">

                  <p style="font-weight: bold; font-size:large;"></p>
                  <p style="font-weight: bold; font-size:large;">Jaksa Madya</p>
                  <p style="font-weight: bold; font-size:large;">NIP. 19811010 200603 1 001</p>

                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit deleniti, blanditiis consectetur nihil natus modi nesciunt inventore fuga numquam esse laudantium quia animi exercitationem expedita incidunt eaque eos omnis accusantium.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $.ajax({
      type: "POS",
      url: "url",
      data: "data",
      dataType: "dataType",
      success: function(response) {

      }
    });
  })
</script>


<?= $this->endSection(); ?>