<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="<?= base_url(); ?>/kasus">
                <div class="card card-statistic-1 imageClick">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pidana Umum</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_umum; ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="<?= base_url(); ?>/kasus">
                <div class="card card-statistic-1 imageClick">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pidana Khusus</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_khusus; ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="<?= base_url(); ?>/dpo">
                <div class="card card-statistic-1 imageClick">
                    <div class="card-icon bg-dark">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Daftar Pencarian Orang</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_buron; ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="<?= base_url(); ?>/kasus">
                <div class="card card-statistic-1 imageClick">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Perdata Dan Tata Usaha Negara</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_perdata; ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="<?= base_url(); ?>/incraht">
                <div class="card card-statistic-1 imageClick">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-alt-slash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Incraht</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_incraht; ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>