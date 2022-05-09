<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Sarana</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="btnKategori()">
                Kategori <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-primary" onclick="cekKategori()">
                Cek Kategori <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
            </button>
            <button class="btn btn-primary" id="showSarana" onclick="showSarana()">
                Sarana <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" id="btnClose" onclick="btnClose()">
                Close Form <i class="ion ion-close-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Sarana</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formSarana']); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_sarana" value="" id="id_sarana" hidden>
                        <div class="form-group col">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="id_kategori_sarana" id="id_kategori_sarana">
                                <option value="" hidden>Pilih Kategori</option>
                                <?php foreach ($data_kategori as $kategori) :  ?>
                                    <option value="<?= $kategori['id_kategori_sarana']; ?>"><?= $kategori['nama_kategori_sarana']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                            <div class="invalid-feedback error_kategoriSarana">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="section-body">
                        <div class="form-group">
                            <div class="dropzone" id="mydropzone">
                                <div class="fallback">
                                    <input type="file" id="img_sarana" accept="image/*,png/,.pdf" class="form-control" onchange="previewFile(this);" name="img_sarana">
                                    <img src="" id="image" alt="Preview Image" style="width: 280px; height:280px;">
                                    <div class="invalid-feedback errorImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="card-header">
            <h4>Detail Sarana</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="teks_sarana" id="teks_sarana"></textarea>
                        </div>
                        <div class="invalid-feedback errorTeks">

                        </div>
                    </div>
                    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                    <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center>
                </div>

            </div>
        </div>
    </div>
    <?php form_close();  ?>
</section>

<div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalSarana">
    <div class="modal-dialog modal-sm kategori_kecil" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" onclick="modalReset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body Del">
                <form action="#" id="formSarana" class="form-horizontal">
                    <div class="form-group col">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="nama_kategori_sarana" id="nama_kategori_sarana" value="" class="form-control">
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
                                foreach ($kategori_sarana as $kategori) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $kategori['nama_kategori_sarana']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="delKategori(<?= $kategori['id_kategori_sarana']; ?>)">
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
                    <h4>Sarana</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="Sarana" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Kategori</th>
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
        table = $('#Sarana').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('sarana/getSarana'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('uploads/sarana'); ?>/' + full[1] + '"/>';
                    return img;
                },
            }, ],
        });
        $('#btnClose').hide();
        $('#btnEdit').hide();
        $('#formSarana').hide();
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


    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }


    function showSarana() {
        $('#formSarana').show();
        $('#showSarana').hide();
        $('#btnClose').show();
    }

    function btnClose() {
        $('#formSarana').hide();
        $('#showSarana').show();
        $('#btnClose').hide();
        $('#btnEdit').hide();
        $('#btnSave').show();
        resetForm();
    }

    function cekKategori() {
        $('#modalSarana').modal('show');
        $('.modal-title').text('Data Kategori')
        $('.kategori_kecil').hide();
        $('.kategori_besar').show();
    }

    function btnKategori() {
        $('#formSarana')[0].reset();
        $('#modalSarana').modal('show');
        $('.modal-title').text('Tambah Kategori')
        $('.kategori_kecil').show();
        $('.kategori_besar').hide();
    }

    function delKategori(id_kategori_sarana) {
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
                    url: "<?= site_url('Sarana/del_kategori_sarana/'); ?>" + id_kategori_sarana,
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

    function delSarana(id_sarana) {
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
                    url: "<?= site_url('Sarana/delSarana/'); ?>" + id_sarana,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Sarana Berhasil Di Delete',
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
                    url: "<?= site_url('Sarana/tambah_kategori_sarana'); ?>",
                    data: $('#formSarana').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let data = response.error
                            if (data.errorKategori) {
                                $('#nama_kategori_sarana').addClass('is-invalid');
                                $('.errorKategori').html(data.errorKategori);
                            } else {
                                $('#nama_kategori_sarana').removeClass('is-invalid');
                                $('#nama_kategori_sarana').addClass('is-valid');
                            }
                        }
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Added!',
                                'Kategori Berhasil Di Tambahkan',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $('#modalSarana').modal('hide');
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
        $('#nama_kategori_sarana').removeClass('is-invalid');
        $('#nama_kategori_sarana').removeClass('is-valid');
    }


    function resetForm() {
        $('#img_sarana').removeClass('is-invalid');
        $('#img_sarana').removeClass('is-valid');
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $("#image").attr("src", '');
        $(".summernote").summernote('code', '');
        $('#id_kategori_sarana').removeClass('is-invalid');
        $('#id_kategori_sarana').removeClass('is-valid');
    }

    function save() {

        let form = $('#formSarana')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('Sarana/tambah_sarana') ?>",
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
                    if (data.error_kategoriSarana) {
                        $('#id_kategori_sarana').addClass('is-invalid');
                        $('.error_kategoriSarana').html(data.error_kategoriSarana);
                    } else {
                        $('#id_kategori_sarana').removeClass('is-invalid');
                        $('#id_kategori_sarana').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_sarana').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_sarana').removeClass('is-invalid');
                        $('#img_sarana').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_sarana').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_sarana').removeClass('is-invalid');
                        $('#teks_sarana').addClass('is-valid');
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
                            $('#formSarana').hide();
                            $('#btnClose').hide();
                            $('#showSarana').show();
                            resetForm();
                            window.location.reload();
                        }
                    })
                }

            }
        });
    }

    function editSarana(id_sarana) {
        $('#formSarana').show();
        $('#showSarana').hide();
        $('#btnClose').show();
        $('#btnSave').hide();
        $('#btnEdit').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('Sarana/get_id/'); ?>" + id_sarana,
            dataType: "json",
            success: function(data) {
                $('[name=id_kategori_sarana]').val(data.id_kategori_sarana);
                $('[name=id_sarana]').val(data.id_sarana);
                $('#image').attr('src', '<?= base_url('uploads/sarana'); ?>/' + data.img_sarana);
                $("#teks_sarana").summernote('code', data.teks_sarana);
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function edit() {
        let form = $('#formSarana')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('sarana/edit_sarana') ?>",
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
                    if (data.error_kategoriSarana) {
                        $('#id_kategori_sarana').addClass('is-invalid');
                        $('.error_kategoriSarana').html(data.error_kategoriSarana);
                    } else {
                        $('#id_kategori_sarana').removeClass('is-invalid');
                        $('#id_kategori_sarana').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_sarana').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_sarana').removeClass('is-invalid');
                        $('#img_sarana').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_sarana').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_sarana').removeClass('is-invalid');
                        $('#teks_sarana').addClass('is-valid');
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
                            $('#formSarana').hide();
                            $('#btnClose').hide();
                            $('#showSarana').show();
                            resetForm();
                            reload_table();
                            window.location.reload();
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>