<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Pengumuman</h1>
        <div class="col">
            <button class="btn btn-primary" id="btnPengumuman" onclick="btnPengumuman()">
                Pengumuman <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" id="btnClose" onclick="btnClose()">
                Close Form <i class="ion ion-close-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Pengumuman</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formPengumuman']); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_pengumuman" value="" id="id_pengumuman" hidden>
                        <div class="form-group col">
                            <label for="nama_pengumuman">Nama Pengumuman</label>
                            <input type="text" class="form-control" id="nama_pengumuman" value="" name="nama_pengumuman">
                            <div class="invalid-feedback errorNama">

                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="tgl_pengumuman">Tanggal Pengumuman</label>
                            <input type="date" class="form-control" id="tgl_pengumuman" value="" name="tgl_pengumuman">
                            <div class="invalid-feedback errorTanggal">

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
                                    <input type="file" id="file_pengumuman" accept="image/*,png/,.pdf" class="form-control" onchange="previewFile(this);" name="file_pengumuman">
                                    <img src="" id="image" alt="Preview Image" style="width: 280px; height:280px;">
                                    <div class="invalid-feedback errorFile">
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
            <h4>Detail Pengumuman</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="teks_pengumuman" id="teks_pengumuman"></textarea>
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
<div class="section-body">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Pengumuman</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="Pengumuman" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File Pengumuman</th>
                                    <th>Nama Pengumuman</th>
                                    <th>Tanggal Pengumuman</th>
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
        table = $('#Pengumuman').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('pengumuman/getPengumuman'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "render": function(url, type, full) {

                    var ext = full[1].split('.')[1];

                    if (ext == 'pdf') {
                        return '<a href="/admin/download_pengumuman/' + full[1] + '" target="_blank">Download<i class="fa fa-download"></i></a>';
                    } else {
                        return '<img height="50%" width="50%" src="<?= base_url('dokumen/pengumuman'); ?>/' + full[1] + '"/>';
                    }

                },
            }, ],
        });
        $('#btnClose').hide();
        $('#btnEdit').hide();
        $('#formPengumuman').hide();
        $('#Pengumuman').show();

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

    function btnPengumuman() {
        $('#formPengumuman').show();
        $('#btnPengumuman').hide();
        $('#btnClose').show();
    }

    function btnClose() {
        $('#formPengumuman').hide();
        $('#btnPengumuman').show();
        $('#btnClose').hide();
        $('#btnEdit').hide();
        $('#btnSave').show();
        resetForm();
    }

    function delPengumuman(id_pengumuman) {
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
                    url: "<?= site_url('pengumuman/delPengumuman/'); ?>" + id_pengumuman,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Pengumuman Berhasil Di Delete',
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

    function resetForm() {
        $('#file_pengumuman').removeClass('is-invalid');
        $('#file_pengumuman').removeClass('is-valid');
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $("#image").attr("src", '');
        $(".summernote").summernote('code', '');
        $('#nama_pengumuman').removeClass('is-invalid');
        $('#nama_pengumuman').removeClass('is-valid');
        $('#tgl_pengumuman').removeClass('is-invalid');
        $('#tgl_pengumuman').removeClass('is-valid');
    }

    function save() {

        let form = $('#formPengumuman')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('pengumuman/tambah_pengumuman') ?>",
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
                        $('#nama_pengumuman').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pengumuman').removeClass('is-invalid');
                        $('#nama_pengumuman').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tgl_pengumuman').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tgl_pengumuman').removeClass('is-invalid');
                        $('#tgl_pengumuman').addClass('is-valid');
                    }
                    if (data.errorFile) {
                        $('#file_pengumuman').addClass('is-invalid');
                        $('.errorFile').html(data.errorFile);
                    } else {
                        $('#file_pengumuman').removeClass('is-invalid');
                        $('#file_pengumuman').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_pengumuman').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_pengumuman').removeClass('is-invalid');
                        $('#teks_pengumuman').addClass('is-valid');
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
                            $('#formPengumuman').hide();
                            $('#btnClose').hide();
                            $('#btnPengumuman').show();
                            resetForm();
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function editPengumuman(id_pengumuman) {
        $('#formPengumuman').show();
        $('#btnPengumuman').hide();
        $('#btnClose').show();
        $('#btnEdit').show();
        $('#btnSave').hide();
        var textareaValue = $('#teks_pengumuman').summernote('code');
        $.ajax({
            type: "GET",
            url: "<?= site_url('pengumuman/get_id/'); ?>" + id_pengumuman,
            dataType: "json",
            success: function(data) {
                $('[name=id_pengumuman]').val(data.id_pengumuman);
                $('[name=nama_pengumuman]').val(data.nama_pengumuman);
                $('[name=tgl_pengumuman]').val(data.tgl_pengumuman);
                $('#image').attr('src', '<?= base_url('dokumen/pengumuman'); ?>/' + data.file_pengumuman);
                $("#teks_pengumuman").summernote('code', data.teks_pengumuman);
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function edit() {
        let form = $('#formPengumuman')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('pengumuman/edit_pengumuman') ?>",
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
                    if (data.errorNama) {
                        $('#nama_pengumuman').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pengumuman').removeClass('is-invalid');
                        $('#nama_pengumuman').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tgl_pengumuman').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tgl_pengumuman').removeClass('is-invalid');
                        $('#tgl_pengumuman').addClass('is-valid');
                    }
                    if (data.errorFile) {
                        $('#file_pengumuman').addClass('is-invalid');
                        $('.errorFile').html(data.errorFile);
                    } else {
                        $('#file_pengumuman').removeClass('is-invalid');
                        $('#file_pengumuman').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_pengumuman').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_pengumuman').removeClass('is-invalid');
                        $('#teks_pengumuman').addClass('is-valid');
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
                            $('#formPengumuman').hide();
                            $('#btnClose').hide();
                            $('#btnPengumuman').show();
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