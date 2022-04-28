<?= $this->extend('template/visitor'); ?>
<?= $this->section('content'); ?>

<?php
function waktu($date)
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
function cutter($string)
{
    if (strlen($string) >= 40) {
        $string = substr($string, 0, 36);
        $string = $string . ' ...';
    }
    return $string;
}
?>

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="main_content">
                    <div class="blog_section" id="<?= count($berita) ?>">
                        <div class="section_panel">
                            <div class="section_title"> Berita Terbaru</div>
                        </div>
                        <div class="section_content">
                            <div class="container">
                                <div class="mini_content row">
                                    <?php if (count($berita) >= 4) : ?>
                                        <?php for ($i = 0; $i < 4; $i++) : ?>
                                            <div class="panel-sm-1">
                                                <a href="<?= base_url() ?>/berita_tentang/<?= $berita[$i]['id_berita']; ?>">
                                                    <div class="card imageClick" style="border-radius: 10px;">
                                                        <img class="img-pan" height="200px" src="<?= base_url() ?>/uploads/berita/<?= $berita[$i]['img_berita']; ?>" alt="" style="border-radius: 10px;">
                                                        <div class="card-body">
                                                            <div class="card-title" style="color: black; font-weight: bold;"><?= cutter($berita[$i]['judul_berita']); ?></div>
                                                            <div class="post-meta" style="color: black; font-weight: lighter; font-size: 9pt">Kejari Purwokerto– </br><?= waktu($berita[$i]['tanggal']); ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endfor; ?>
                                    <?php elseif (count($berita) < 4) : ?>
                                        <?php $data = count($berita);  ?>
                                        <?php for ($i = 0; $i < $data; $i++) :  ?>
                                            <div class="panel-sm-1">
                                                <a href="<?= base_url() ?>/berita_tentang/<?= $berita[$i]['id_berita']; ?>">
                                                    <div class="card imageClick" style="border-radius: 10px;">
                                                        <img class="img-pan" height="200px" src="<?= base_url() ?>/uploads/berita/<?= $berita[$i]['img_berita']; ?>" alt="" style="border-radius: 10px;">
                                                        <div class="card-body">
                                                            <div class="card-title" style="color: black; font-weight: bold;"><?= cutter($berita[$i]['judul_berita']); ?></div>
                                                            <div class="post-meta" style="color: black; font-weight: lighter; font-size: 9pt">Kejari Purwokerto– </br><?= waktu($berita[$i]['tanggal']); ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endfor; ?>

                                    <?php endif; ?>
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
            <?= $this->endSection(); ?>