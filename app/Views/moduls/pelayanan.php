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
                            <input type="hidden" value="" name="id_pelayanan" />
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

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_terdakwa">Nama Terdakwa</label>
                                    <input id="nama_terdakwa" type="text" class="form-control" value="" name="nama_terdakwa">
                                    <div class="invalid-feedback errorNama">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_hakim">Majelis Hakim</label>
                                    <input id="nama_hakim" type="text" class="form-control" value="" name="nama_hakim">
                                    <div class="invalid-feedback errorHakim">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="panitia_pengganti">Panitia Pengganti</label>
                                    <input id="panitia_pengganti" type="text" class="form-control" value="" name="panitia_pengganti">
                                    <div class="invalid-feedback errorPengganti">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value="" hidden>== Kategori ==</option>
                                        <option value="Pidana Umum">Pidana Umum</option>
                                        <option value="Pidana Khusus">Pidana Khusus</option>
                                        <option value="Perdata Dan Tata Usaha Negara">Perdata Dan Tata Usaha Negara</option>
                                    </select>
                                    <div class="invalid-feedback errorKategori">

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

    function delAgenda(id_agenda) {
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
                    url: "<?= site_url('modul/del_agenda/'); ?>" + id_agenda,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Agenda Berhasil Di Delete',
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


    function reload_table() {
        table.ajax.reload(null, false);
    }



    function resetForm() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $(".summernote").summernote('code', '');
        $('#judul_agenda').removeClass('is-invalid');
        $('#judul_agenda').removeClass('is-valid');
        $('#tanggal_agenda').removeClass('is-invalid');
        $('#tanggal_agenda').removeClass('is-valid');
        $('#tanggal_agenda').removeClass('is-invalid');
        $('#teks_agenda').removeClass('is-valid');
    }

    function save() {

        let form = $('#formAgenda')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('modul/tambah_agenda') ?>",
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
                    if (data.errorJudul) {
                        $('#judul_agenda').addClass('is-invalid');
                        $('.errorJudul').html(data.errorJudul);
                    } else {
                        $('#judul_agenda').removeClass('is-invalid');
                        $('#judul_agenda').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal_agenda').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal_agenda').removeClass('is-invalid');
                        $('#tanggal_agenda').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_agenda').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_agenda').removeClass('is-invalid');
                        $('#teks_agenda').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            resetForm();
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function editAgenda(id_agenda) {
        $.ajax({
            type: "GET",
            url: "<?= site_url('modul/get_id/'); ?>" + id_agenda,
            dataType: "json",
            success: function(data) {
                $('#judul_agenda').val(data.judul_agenda);
                $('#tanggal_agenda').val(data.tanggal_agenda);
                $("#teks_agenda").summernote('code', data.teks_agenda);
                $('#id_agenda').val(data.id_agenda);
                $('#btnEdit').show();
                $('#btnSave').hide();
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function edit() {
        let form = $('#formAgenda')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('modul/edit_agenda') ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnEdit').prop('disabled', true);
                $('#btnEdit').html('Loading');
            },
            complete: function() {
                $('#btnEdit').prop('disabled', false);
                $('#btnEdit').html('Unggah');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorJudul) {
                        $('#judul_agenda').addClass('is-invalid');
                        $('.errorJudul').html(data.errorJudul);
                    } else {
                        $('#judul_agenda').removeClass('is-invalid');
                        $('#judul_agenda').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal_agenda').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal_agenda').removeClass('is-invalid');
                        $('#tanggal_agenda').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_agenda').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_agenda').removeClass('is-invalid');
                        $('#teks_agenda').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di Edit`,
                    }).then((result) => {
                        if (result.value) {
                            resetForm();
                            reload_table();
                            $('#btnEdit').hide();
                            $('#btnSave').show();
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>