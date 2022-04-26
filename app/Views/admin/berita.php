<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>

<?php
$date = date('Y-m-d');
$arr = explode("-", $date);
$tgl = $arr[2];
$mon = date('F');
$year = $arr[0];
?>

<section class="section">
    <div class="section-header">
        <h1>Berita</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="showForm()" id="btnOpen">
                Buat Berita <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" onclick="hideForm()" id="btnClose">
                Tutup Form <i class="ion ion-close-circled"></i>
            </button>
        </div>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Berita</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formBerita']); ?>
    <div class="row col-12 hid-form" id="form-top">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_berita" value="" id="id_berita" hidden>
                        <div class="form-group col p-right">
                            <label for="tanggal" class="md-sm5">Tanggal</label>
                            <input type="text" id="tanggal" class="form-control" name="tanggal" placeholder="" value="" hidden>
                            <p class="inline-space"><?= $tgl . ' ' . $mon . ' ' . $year ?></p>
                            <div class="invalid-feedback errorTanggal">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="judul_berita">Judul Berita</label>
                            <input type="text" class="form-control" name="judul_berita" id="judul_berita" placeholder="">
                            <div class="invalid-feedback errorJudul">
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
                                    <input type="file" id="img_berita" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_berita" hidden>
                                    <div style="height: 210px; width: 200px">
                                        <img src="" id="image_berita" alt="Preview Image" style="width: 200px; height:200px; visibility: hidden">
                                    </div>
                                    <div class="invalid-feedback errorImage"></div>
                                    <label for="img_berita" class="btn btn-primary">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body hid-form" id="form-bot">
        <div class="card-header">
            <h4>Isi Berita</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="teks_berita" id="teks_berita"></textarea>
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

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Berita</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Berita" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Judul Berita</th>
                                        <th>Tanggal</th>
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

    var date = new Date();
    var hari = date.getDate();
    var mon = date.getMonth();
    var yer = date.getFullYear()
    if (mon < 10) {
        mon = '0' + mon;
    }
    var tanggal = yer + '-' + mon + '-' + hari;
    $(document).ready(function() {
        table = $('#Berita').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('berita/getBerita'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="150px" width="auto" src="<?= base_url('uploads/berita'); ?>/' + full[1] + '"/>';
                    return img;
                },
            }, ],
        });

        $('#btnEdit').hide();
        $('#btnClose').hide();
        $('#judul_berita').focus();
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
        $('.summernote').summernote('code', '<b>Kejaksaan Negeri Purwokerto –</b>')
    });

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image_berita").attr("src", reader.result);
                $("#image_berita").css("visibility", "visible");
            }
            reader.readAsDataURL(file);
        }
    }

    function showForm() {
        $("#form-top").css("display", "flex");
        $("#form-bot").show();
        $("#btnClose").show();
        $("#btnOpen").hide();
        $('#judul_berita').focus();
        $('.summernote').summernote('code', '<b>Kejaksaan Negeri Purwokerto –</b>');
    }

    function save() {
        $('#tanggal').val(tanggal);
        let form = $('#formBerita')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('berita/tambah_berita') ?>",
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
                        $('#judul_berita').addClass('is-invalid');
                        $('#judul_berita').attr('autofocus', true);
                        $('.errorJudul').html(data.errorJudul);
                    } else {
                        $('#judul_berita').removeClass('is-invalid');
                        $('#judul_berita').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal').removeClass('is-invalid');
                        $('#tanggal').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_berita').addClass('is-invalid');
                        $('#img_berita').attr('autofocus', true);
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_berita').removeClass('is-invalid');
                        $('#img_berita').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_berita').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_berita').removeClass('is-invalid');
                        $('#teks_berita').addClass('is-valid');
                    }
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Ditambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            resetForm();
                            reload_table();
                            hideForm();
                        }
                    })
                }

            }
        });
    }

    function hideForm() {
        $("#form-top").hide();
        $("#form-bot").hide();
        $("#btnClose").hide();
        $("#btnOpen").show();
        $("#btnEdit").hide();
        $("#btnSave").show();
        resetForm();
    }

    function delBerita(id_berita) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Berita Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('berita/delBerita/'); ?>" + id_berita,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Berita Berhasil Di Hapus',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    reload_table();
                                    $('#del' + id).parent().parent().remove();

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
                    'Data Tidak Jadi Dihapus :P',
                    'error'
                )
            }
        })
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function modalReset() {
        $('#kategori').removeClass('is-invalid');
        $('#kategori').removeClass('is-valid');
    }

    function resetForm() {
        $('#img_berita').removeClass('is-invalid');
        $('#img_berita').removeClass('is-valid');
        $("#image_berita").attr("src", '');
        $("#image_berita").css("visibility", "hidden");
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $(".summernote").summernote('code', '');
        $('#judul_berita').removeClass('is-invalid');
        $('#judul_berita').removeClass('is-valid');
        $('#tanggal').removeClass('is-invalid');
        $('#tanggal').removeClass('is-valid');

    }

    function editBerita(id_berita) {
        $('#tanggal').val(tanggal);
        var textareaValue = $('#teks_berita').summernote('code');
        $.ajax({
            type: "GET",
            url: "<?= site_url('berita/get_id/'); ?>" + id_berita,
            dataType: "json",
            success: function(data) {
                showForm();
                $('#judul_berita').val(data.judul_berita);
                $('#tanggal').val(data.tanggal);
                $('[name=id_berita]').val(data.id_berita);
                $('#image_berita').attr('src', '<?= base_url('uploads/berita'); ?>/' + data.img_berita);
                $('#image_berita').css("visibility", "visible")
                $("#teks_berita").summernote('code', data.teks_berita);
                $('#btnEdit').show();
                $('#btnSave').hide();
                $('#judul_berita').focus();
            }
        });
    }

    function edit() {
        let form = $('#formBerita')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('berita/editBerita') ?>",
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
                $('#btnEdit').html('Ubah');
            },
            success: function(response) {
                if (response.error) {
                    console.log("respon = ", response);
                    let data = response.error
                    if (data.errorJudul) {
                        $('#judul_berita').addClass('is-invalid');
                        $('.errorJudul').html(data.errorJudul);
                        $('#judul_berita').focus();
                    } else {
                        $('#judul_berita').removeClass('is-invalid');
                        $('#judul_berita').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal').removeClass('is-invalid');
                        $('#tanggal').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_berita').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_berita').removeClass('is-invalid');
                        $('#teks_berita').addClass('is-valid');
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
                        console.log("hasil sukses ", result);
                        if (result.value) {
                            resetForm();
                            reload_table();
                            $('#btnEdit').hide();
                            $('#btnSave').show();
                            hideForm();
                            document.body.scrollTop = 0;
                            document.documentElement.scrollTop = 0;
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>