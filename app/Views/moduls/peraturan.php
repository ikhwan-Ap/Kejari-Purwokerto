<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Peraturan</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="btnKategori()">
                Kategori <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-primary" onclick="cekKategori()">
                Cek Kategori <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
            </button>
            <button class="btn btn-primary" id="showPeraturan" onclick="showPeraturan()">
                Peraturan <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" id="btnClose" onclick="btnClose()">
                Close Form <i class="ion ion-close-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Peraturan</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formPeraturan']); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_peraturan" value="" id="id_peraturan" hidden>
                        <div class="form-group col">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="id_kategori_peraturan" id="id_kategori_peraturan">
                                <option value="" hidden>Pilih Kategori</option>
                                <?php foreach ($data_kategori as $kategori) :  ?>
                                    <option value="<?= $kategori['id_kategori_peraturan']; ?>"><?= $kategori['nama_kategori_peraturan']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                            <div class="invalid-feedback error_kategoriPeraturan">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="nama_peraturan">Nama Peraturan</label>
                            <input type="text" name="nama_peraturan" class="form-control" id="nama_peraturan" value="">
                            <div class="invalid-feedback errorNama">

                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="file_peraturan">File Peraturan</label>
                            <input type="file" id="file_peraturan" accept=".pdf" class="form-control" name="file_peraturan">
                            <div class="invalid-feedback errorFile">

                            </div>
                        </div>
                    </div>
                </div>

                <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center>
            </div>
        </div>
    </div>
    <?php form_close();  ?>
</section>




<div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalPeraturan">
    <div class="modal-dialog modal-sm kategori_kecil" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" onclick="modalReset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body Del">
                <form action="#" id="formPeraturan" class="form-horizontal">
                    <div class="form-group col">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="nama_kategori_peraturan" id="nama_kategori_peraturan" value="" class="form-control">
                        <div class="invalid-feedback errorKategori">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="tambahKategori()" class="btn btn-primary Terima">Tambah</button>
                <button type="button" class="btn btn-light" onclick="modalReset()" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
    <div class="modal-dialog modal-lg kategori_besar" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" onclick="modalReset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body Del">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="sortable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kategori_peraturan as $kategori) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $kategori['nama_kategori_peraturan']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="delKategori(<?= $kategori['id_kategori_peraturan']; ?>)">
                                                <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="modalReset()" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Peraturan</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="Peraturan" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File</th>
                                    <th>Kategori</th>
                                    <th>Nama Peraturan</th>
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
</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var table;

    $(document).ready(function() {
        table = $('#Peraturan').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('peraturan/getPeraturan'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "render": function(url, type, full) {
                    return '<a href="/download_peraturan/' + full[1] + '" target="_blank">Download<i class="fa fa-download"></i></a>';
                },
            }, ],
        });
        $('#btnClose').hide();
        $('#btnEdit').hide();
        $('#formPeraturan').hide();
        $('#Profil').show();

        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["fontsize", ["fontsize"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
                ["insert", ["link", "imageList", "hr"]],

            ],
            dialogsInBody: true,
        })
    });

    function showPeraturan() {
        $('#formPeraturan').show();
        $('#showPeraturan').hide();
        $('#btnClose').show();
    }

    function btnClose() {
        $('#formPeraturan').hide();
        $('#showPeraturan').show();
        $('#btnClose').hide();
        resetForm();
    }


    function cekKategori() {
        $('#modalPeraturan').modal('show');
        $('.modal-title').text('Data Kategori')
        $('.kategori_kecil').hide();
        $('.kategori_besar').show();
    }

    function btnKategori() {
        $('#formPeraturan')[0].reset();
        $('#modalPeraturan').modal('show');
        $('.modal-title').text('Tambah Kategori')
        $('.kategori_kecil').show();
        $('.kategori_besar').hide();
    }

    function delKategori(id_kategori_peraturan) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Kategori Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('peraturan/del_kategori_peraturan/'); ?>" + id_kategori_peraturan,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Kategori Berhasil Di Delete',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
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

    function delPeraturan(id_peraturan) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Bidang Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('peraturan/delPeraturan/'); ?>" + id_peraturan,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Peraturan Berhasil Di Delete',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    reload_table();
                                    window.location.reload();
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

    function tambahKategori() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menambah Data Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Simpan Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('peraturan/tambah_kategori_peraturan'); ?>",
                    data: $('#formPeraturan').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let data = response.error
                            if (data.errorKategori) {
                                $('#nama_kategori_peraturan').addClass('is-invalid');
                                $('.errorKategori').html(data.errorKategori);
                            } else {
                                $('#nama_kategori_peraturan').removeClass('is-invalid');
                                $('#nama_kategori_peraturan').addClass('is-valid');
                            }
                        }
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Added!',
                                'Kategori Berhasil Di Tambahkan',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $('#modalPeraturan').modal('hide');
                                    window.location.reload();
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

    function modalReset() {
        $('#nama_kategori_peraturan').removeClass('is-invalid');
        $('#nama_kategori_peraturan').removeClass('is-valid');
    }


    function resetForm() {
        $('#img_profil').removeClass('is-invalid');
        $('#img_profil').removeClass('is-valid');
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $("#image").attr("src", '');
        $(".summernote").summernote('code', '');
        $('#id_kategori_peraturan').removeClass('is-invalid');
        $('#id_kategori_peraturan').removeClass('is-valid');
    }

    function save() {

        let form = $('#formPeraturan')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('peraturan/tambah_peraturan') ?>",
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
                    if (data.error_kategoriPeraturan) {
                        $('#id_kategori_peraturan').addClass('is-invalid');
                        $('.error_kategoriPeraturan').html(data.error_kategoriPeraturan);
                    } else {
                        $('#id_kategori_peraturan').removeClass('is-invalid');
                        $('#id_kategori_peraturan').addClass('is-valid');
                    }
                    if (data.errorFile) {
                        $('#file_peraturan').addClass('is-invalid');
                        $('.errorFile').html(data.errorFile);
                    } else {
                        $('#file_peraturan').removeClass('is-invalid');
                        $('#file_peraturan').addClass('is-valid');
                    }
                    if (data.errorNama) {
                        $('#nama_peraturan').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_peraturan').removeClass('is-invalid');
                        $('#nama_peraturan').addClass('is-valid');
                    }
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            document.body.scrollTop = 1000;
                            document.documentElement.scrollTop = 1000;
                            $('#formPeraturan').hide();
                            $('#btnClose').hide();
                            $('#showPeraturan').show();
                            resetForm();
                            reload_table();
                            window.location.reload();
                        }
                    })
                }

            }
        });
    }

    function editPeraturan(id_peraturan) {
        $('#formPeraturan').show();
        $('#showPeraturan').hide();
        $('#btnClose').show();
        $('#btnSave').hide();
        $('#btnEdit').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('peraturan/get_id/'); ?>" + id_peraturan,
            dataType: "json",
            success: function(data) {
                $('[name=id_kategori_peraturan]').val(data.id_kategori_peraturan);
                $('[name=id_peraturan]').val(data.id_peraturan);
                $('[name=nama_peraturan]').val(data.nama_peraturan);
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function edit() {
        let form = $('#formPeraturan')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('peraturan/edit_peraturan') ?>",
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
                $('#btnEdit').html('Edit');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.error_kategoriPeraturan) {
                        $('#id_kategori_peraturan').addClass('is-invalid');
                        $('.error_kategoriPeraturan').html(data.error_kategoriPeraturan);
                    } else {
                        $('#id_kategori_peraturan').removeClass('is-invalid');
                        $('#id_kategori_peraturan').addClass('is-valid');
                    }
                    if (data.errorFile) {
                        $('#file_peraturan').addClass('is-invalid');
                        $('.errorFile').html(data.errorFile);
                    } else {
                        $('#file_peraturan').removeClass('is-invalid');
                        $('#file_peraturan').addClass('is-valid');
                    }
                    if (data.errorNama) {
                        $('#nama_peraturan').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_peraturan').removeClass('is-invalid');
                        $('#nama_peraturan').addClass('is-valid');
                    }
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di Ubah`,
                    }).then((result) => {
                        if (result.value) {
                            $('#btnEdit').hide();
                            $('#btnSave').show();
                            $('#formPeraturan').hide();
                            $('#btnClose').hide();
                            $('#showPeraturan').show();
                            resetForm();
                            reload_table();
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>