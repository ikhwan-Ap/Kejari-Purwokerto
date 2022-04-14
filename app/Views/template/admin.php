<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?> | KEJARI - PURWOKERTO</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- CSS Libraries -->

    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/dropzone.min.css">

    
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/components.css">
    <!-- Icon -->

    <link rel="stylesheet" href="<?= base_url() ?>/ionicons201/css/ionicons.min.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            <!-- Topnav -->
            <?= $this->include('layout/topnav'); ?>

            <!-- Sidenav -->
            <?= $this->include('layout/sidenav'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y'); ?> <div class="bullet"></div> KEJARI - Purwokerto <a href="https://nauval.in/">Kejaksaan Replubik Indonesia Purwokerto</a>
                </div>
                <div class="footer-right">
                    1.0.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <script src="<?= base_url() ?>/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>


    <script src="<?= base_url() ?>/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/summernote-bs4.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url() ?>/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>/js/modules-datatables.js"></script>

    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalProfil">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body Del">
                    <form action="#" id="formProfil" class="form-horizontal">
                        <input type="text" name="id" id="id" value="" hidden>
                        <div class="form-group col">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" value="" class="form-control">

                            <div class="invalid-feedback errorPassword">

                            </div>

                        </div>

                        <div class="form-group col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="showpass" class="custom-control-input" tabindex="3" id="showpass" onclick="myFunction()">
                                <label class="custom-control-label" for="showpass">Show Password</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="editProfil()" class="btn btn-primary Terima">Edit</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function btnLogout(id) {
        Swal.fire({
            title: 'Apakah anda akan logout?',
            showDenyButton: true,
            icon: 'warning',
            confirmButtonText: 'Yakin?',
            denyButtonText: `Kembali`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('auth/logout/'); ?>/" + id,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                html: `Anda Berhasil Logout`,
                            }).then((result) => {
                                if (result.value) {
                                    window.location.replace('/')
                                }
                            })

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }
        })
    }

    function btnProfil(id) {
        $('#formProfil')[0].reset();
        $('#modalProfil').modal('show');
        $('.modal-title').text('Edit Profil');

        $.ajax({
            type: "GET",
            url: "<?= site_url('admin/getProfil/'); ?>/" + id,
            dataType: "json",
            success: function(data) {
                $('[name=id]').val(data.id);
                $('[name=name]').val(data.name);
                $('[name=password]').val(data.password);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function editProfil() {
        Swal.fire({
            title: 'Apakah anda yakin mengganti profil?',
            showDenyButton: true,
            icon: 'warning',
            confirmButtonText: 'Yakin?',
            denyButtonText: `Kembali`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('admin/edit_profil'); ?>",
                    data: $('#formProfil').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                html: `Data berhasil di edit`,
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }
        })
    }
</script>

</html>