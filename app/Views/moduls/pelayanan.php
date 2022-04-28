<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Pelayanan</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addPelayanan()">
                <i class="ion ion-plus-circled"></i> Tambah
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Pelayanan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Pelayanan</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Pelayanan" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelayanan</th>
                                        <th>Url Pelayanan</th>
                                        <th>Img/Icon</th>
                                        <th>Warna Dasar</th>
                                        <th>Gradiasi</th>
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
    </div>


    <div class="modal fade" data-backdrop="false" role="dialog" id="modalPelayanan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="reset()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body form_kasus">
                    <div class="card-body Proses ">
                        <?php echo form_open_multipart('', ['id' => 'formPelayanan']); ?>
                        <div class="card-body Method">
                            <input type="hidden" value="" id="id_pelayanan" name="id_pelayanan" />
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_pelayanan">Nama Pelayanan</label>
                                    <input id="nama_pelayanan" type="text" class="form-control" value="" name="nama_pelayanan">
                                    <div class="invalid-feedback errorNama">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="url_pelayanan">Url Pelayanan</label>
                                    <input type="text" name="url_pelayanan" id="url_pelayanan" class="form-control" value="">
                                    <div class="invalid-feedback errorUrl">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="warna_pelayanan">Warna Dasar</label>
                                    <input id="warna_pelayanan" type="color" class="form-control" value="" name="warna_pelayanan">
                                    <div class="invalid-feedback errorWarna">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="gradiasi_pelayanan">Warna Gradiasi</label>
                                    <input id="gradiasi_pelayanan" type="Color" class="form-control" value="" name="gradiasi_pelayanan">
                                    <div class="invalid-feedback errorGradiasi">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropzone" id="mydropzone">
                                    <div class="fallback">
                                        <input type="file" id="img_pelayanan" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_pelayanan">
                                        <img src="" id="image_pelayanan" alt="Preview Image" style="width: 280px; height:280px;">
                                        <div class="invalid-feedback errorImage">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php form_close();  ?>
                    </div>
                </div>


                <div class="modal-footer Foot">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-light" onclick="reset()" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>


</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var table;
    var save_method;
    $(document).ready(function() {
        table = $('#Pelayanan').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('modul/getPelayanan'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                    "targets": 3,
                    "data": "img",
                    "render": function(url, type, full) {
                        var img = '<img height="50%" width="50%" src="<?= base_url('img_pelayanan'); ?>/' + full[3] + '"/>';
                        return img;
                    }
                },
                {
                    "targets": 4,
                    "data": "color",
                    "render": function(url, type, full) {
                        var color = '<badge style="background-color:' + full[4] + ';padding: 15px 32px;"/>';
                        return color;
                    },
                },
                {
                    "targets": 5,
                    "data": "color",
                    "render": function(url, type, full) {
                        var color = '<badge style="background-color:' + full[5] + ';padding: 15px 32px;"/>';
                        return color;
                    },
                },
            ],
        });
    });

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image_pelayanan").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }



    function addPelayanan() {
        save_method = 'Add';
        $('#modalPelayanan').modal('show');
        $('.modal-title').text('Tambah Pelayanan');
    }

    function editPelayanan(id_pelayanan) {
        save_method = 'Update';
        $('#modalPelayanan').modal('show');
        $('.modal-title').text('Edit Data Pelayanan');
        $.ajax({
            type: "GET",
            url: "<?= site_url('modul/get_pelayanan/'); ?>" + id_pelayanan,
            dataType: "json",
            success: function(data) {
                $('#id_pelayanan').val(data.id_pelayanan);
                $('#nama_pelayanan').val(data.nama_pelayanan);
                $('#url_pelayanan').val(data.url_pelayanan);
                $('#warna_pelayanan').val(data.warna_pelayanan);
                $('#gradiasi_pelayanan').val(data.gradiasi_pelayanan);
                $('#img_pelayanan').attr(data.img_pelayanan);
                $('#image_pelayanan').attr('src', '<?= base_url('img_pelayanan'); ?>/' + data.img_pelayanan);
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function save() {
        let form = $('#formPelayanan')[0];
        let data = new FormData(form);
        if (save_method == 'Add') {
            url = "<?= site_url('modul/tambah_pelayanan'); ?>";
        } else {
            url = "<?= site_url('modul/edit_pelayanan'); ?>";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html('Loading');
            },
            complete: function() {
                $('#btnSave').prop('disabled', false);
                $('#btnSave').html('Unggah');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorNama) {
                        $('#nama_pelayanan').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pelayanan').removeClass('is-invalid');
                        $('#nama_pelayanan').addClass('is-valid');
                    }
                    if (data.errorUrl) {
                        $('#url_pelayanan').addClass('is-invalid');
                        $('.errorUrl').html(data.errorUrl);
                    } else {
                        $('#url_pelayanan').removeClass('is-invalid');
                        $('#url_pelayanan').addClass('is-valid');
                    }
                    if (data.errorWarna) {
                        $('#warna_pelayanan').addClass('is-invalid');
                        $('.errorWarna').html(data.errorWarna);
                    } else {
                        $('#warna_pelayanan').removeClass('is-invalid');
                        $('#warna_pelayanan').addClass('is-valid');
                    }
                    if (data.errorGradiasi) {
                        $('#gradiasi_pelayanan').addClass('is-invalid');
                        $('.errorGradiasi').html(data.errorGradiasi);
                    } else {
                        $('#gradiasi_pelayanan').removeClass('is-invalid');
                        $('#gradiasi_pelayanan').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_pelayanan').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_pelayanan').removeClass('is-invalid');
                        $('#img_pelayanan').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Pelayanan Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            $('#modalPelayanan').modal('hide');
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function reset() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#image_pelayanan').removeClass('is-invalid');
        $('#image_pelayanan').removeClass('is-valid');
        $("#image_pelayanan").attr("src", '');
        $('#nama_pelayanan').removeClass('is-invalid');
        $('#nama_pelayanan').removeClass('is-valid');
        $('#url_pelayanan').removeClass('is-invalid');
        $('#url_pelayanan').removeClass('is-valid');
        $('#warna_pelayanan').removeClass('is-invalid');
        $('#warna_pelayanan').removeClass('is-valid');
        $('#gradiasi_pelayanan').removeClass('is-invalid');
        $('#gradiasi_pelayanan').removeClass('is-valid');;
    }

    function delPelayanan(id_pelayanan) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Agenda Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('modul/del_pelayanan/'); ?>" + id_pelayanan,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Pelayanan Berhasil Di Delete',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    reload_table();
                                }
                            })
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data Tidak Jadi Di Hapus :)',
                    'error'
                )
            }
        })
    }
</script>

<?= $this->endsection(); ?>