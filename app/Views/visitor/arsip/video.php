<?= $this->extend('template/visitor'); ?>
<?= $this->section('content'); ?>

<div class="page_content">
  <div class="container">
    <div class="row row-lg-eq-height">
      <div class="col-lg-9">
        <div class="main_content">
          <div class="post_body">
            <div class="blog_section">
              <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                <div class="section_title">Arsip Video</div>
              </div>
              <div class="section_content">

                <div class="container" style="padding: 0;">
                  <div class="row">

                    <?php $i = 1;
                    foreach ($video as $data) :  ?>
                      <div class="col-md-4 imageClick" style="text-align: center; margin-bottom: 25px;">
                        <!-- Video -->
                        <a href="https://www.youtube.com/watch?v=<?= $data['url']; ?>" target="_blank">
                          <div>
                            <div>
                              <div><img style="border-radius: 10px;" width="100%" src="https://img.youtube.com/vi/<?= $data['url']; ?>/default.jpg" alt=""></div><img class="play_img" src="<?= base_url() ?>/template/visitor/images/play.png" alt="">
                            </div>
                            <div>
                              <p><?= $data['judul_video']; ?></p>
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php $i++;
                    endforeach; ?>
                  </div>
                  <?= $pager->links('arsip_video', 'kejari_pagination') ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->endSection(); ?>