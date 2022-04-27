<?= $this->extend('layout/visitor_template'); ?>
<?= $this->section('content'); ?>

<?php function waktu($date)
{
    $datetime = DateTime::createFromFormat('Y-m-d', $date);

    $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $day = ['', 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $hari =  $day[$datetime->format('N')];
    $bulan = $months[$datetime->format('n')];
    $year = $datetime->format(' Y');
    $tgl = $datetime->format(' d');
    return $hari . ', ' . $tgl . ' ' . $bulan .   $year;
}
?>

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="main_content">
                    <div class="blog_section" id="<?= count($listBerita) ?>">
                        <div class="section_panel">
                            <div class="section_title"> Berita Terbaru</div>
                        </div>
                        <div class="section_content">
                            <div class="container">
                                <div class="row">
                                    <?php for ($i = 0; $i < count($listBerita); $i++) {  ?>
                                        <div class="<?= ($i == 0) ? 'col-12' : 'col-md-4' ?>">
                                            <a href="<?= base_url() ?>/berita_tentang/<?= $listBerita[$i]['id_berita']; ?>">
                                                <div class="card imageClick" style="border-radius: 10px;">
                                                    <img class="<?= ($i == 0) ? 'beritaUtama' : 'beritaSampingan' ?>" src="<?= base_url() ?>/uploads/berita/<?= $listBerita[$i]['img_berita']; ?>" alt="" style="border-radius: 10px;">
                                                    <div class="card-body">
                                                        <div class="card-title" style="color: black; font-weight: bold;"><?= $listBerita[$i]['judul_berita']; ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Berita Lainnya</div>
                        </div>
                        <?= $pager->links('berita', 'kejari_pagination') ?>
                        <br><br>
                        <?php foreach ($berita as $data) : ?>
                            <a href="/berita_tentang/<?= $data['id_berita']; ?>">
                                <div class="section_content pengumuman row" style="border-radius: 10px; margin-left: 15px;">
                                    <div class="col-2">
                                        <img src="<?= base_url() ?>/uploads/berita/<?= $data['img_berita'] ?>" alt="">
                                    </div>
                                    <div class="col-10">
                                        <p style="font-weight: bold; font-size:large;"><?= $data['judul_berita']; ?></p>
                                        <p><?= waktu($data['tanggal']); ?></p>
                                    </div>
                                </div>
                            </a>
                            <br>
                        <?php endforeach;  ?>
                    </div>
                </div>

            </div>


            <script type="text/javascript">
                console.log('hai');
                let num = document.getElementsByClassName('blog_section')[0].id;
                console.log(num);
                if (num < 4) {
                    document.getElementsByClassName('blog_section')[0].style = 'display: none';
                    console.log('done');
                }
            </script>
            <?= $this->endSection(); ?>