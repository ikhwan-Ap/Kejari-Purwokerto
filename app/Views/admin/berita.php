<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>

<?php
$date = date('Y-m-d');
$arr = explode("-",$date);
$tgl = $arr[2];
$mon = date('F');
$year = $arr[0]; 
?>

<section class="section">
    <div class="section-header">
        <h1>Editor Berita</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addBerita()">
                <i class="ion ion-plus-circled"></i> Buat Baru
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Modul</div>
            <div class="breadcrumb-item">Berita</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Berita</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Berita" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
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

    <div class="modal fade" data-backdrop="false" role="dialog" id="modalBerita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="reset()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body form_berita">
                    <?php echo form_open_multipart('', ['id' => 'formBerita']); ?>
                    <div class="card-body Proses">
                        <input type="hidden" value="" name="id_berita" />
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="tanggal" class="col-form-label text-md-left col-4 col-md-3">Tanggal</label>
                                <div id="tanggal" value="<?= $date ?>" class="col-8 pl-0" style="display:inline-block">
                                    <p><?= $tgl.' '.$mon.' '.$year ?></p>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="judul_berita" class="col-form-label text-md-left col-4 col-md-3">Judul</label>
                                <input type="text" name="judul_berita" id="judul_berita" class="col-8 form-control" value="" style="display:inline-block">
                                <div class="invalid-feedback errorNama">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="col-form-label text-md-left col-4 col-md-3">Isi Berita</label>
                                <div class="form control">
                                    <textarea class="summernote-simple" name="isi_berita" id="isi_berita" class="form-control" value=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="card" style="left: 25%;">
                                <div class="card-header">
                                    <h4>Pilih Gambar</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#" class="dropzone" id="mydropzone">
                                        <div class="fallback">
                                            <input id="image" type="file" value="" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="image">
                                            <div class="invalid-feedback errorImage">
                                        </div>
                                    </form
                            </div>
                        </div>
                        <div class="row">
<!--  
                        <div class="preview">
                            <img src="" id="img_buron" alt="Placeholder" style="width: 30%; height:50%;">
                        </div> -->

                    </div>
                    <?php echo form_close(); ?>
                    <div class="card-body Detail">
                        <div class="row">
                            <div class="col">
                                <h6 id="judul_berita">
                                    AA
                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="tanggal">

                                </h6>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col">
                                <h6 id="jenis">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="alamat">

                                </h6>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col">
                                <img src="" id="img_preview" alt="Image_Berita" style="height: 65%; width:50%;">
                            </div>
                        </div>
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
    var save_method;
    var table;
    $(document).ready(function() {
        table = $('#Berita').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('berita/getBerita'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.id_berita = 1;
                }

            },
            "columnDefs": [{
                "targets": [0],
                "orderable" : false
            }]
        });

        $('#filterJenis').change(function() {
            table.draw();
        })
    });

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#img_buron").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function detailBerita(id_berita) {
        $('#formBerita')[0].reset();
        $('.Foot').hide();
        $('.Proses').hide();
        $('.Detail').show();
        $.ajax({
            url: "<?= site_url('berita/get_id/'); ?>" + id_berita,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#judul_berita').html("Judul Berita :" + data.judul_berita);
                $('#tanggal').html("Tanggal :" + data.tanggal);
                $('#img_preview').attr('src', '<?= base_url('uploads/berita'); ?>/' + data.image);
                $('#modalBerita').modal('show');
                $('.modal-title').text('Detail Berita');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
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
            text: "Anda Akan Menghapus Data Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('berita/del_berita/'); ?>" + id_berita,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Data Berhasil Di Hapus',
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

    function addBerita() {
        save_method = 'add';
        $('#formBerita')[0].reset();
        $('#modalBerita').modal('show');
        $('.modal-title').text('Tambah Berita Terbaru');
        $('.Foot').show();
        $('.Proses').show();
        $('.Detail').hide();
    }

    function save() {
        let form = $('#formBerita')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('berita/tambah_berita'); ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html('Tunggu');
            },
            complete: function() {
                $('#btnSave').prop('disabled', false);
                $('#btnSave').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error;
                    if (data.errorNama) {
                        $('#nama_buron').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_buron').removeClass('is-invalid');
                        $('#nama_buron').addClass('is-valid');
                    }
                    if (data.errorUsia) {
                        $('#usia').addClass('is-invalid');
                        $('.errorUsia').html(data.errorUsia);
                    } else {
                        $('#usia').removeClass('is-invalid');
                        $('#usia').addClass('is-valid');
                    }
                    
                    if (data.errorImage) {
                        $('#image').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#image').removeClass('is-invalid');
                        $('#image').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalBuron').modal('hide');
                            $('#filterJenis').val("");
                            reload_table();
                            reset();
                        }
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function reset() {
        $("#img_berita").attr("src", '');
        $('#judul_berita').removeClass('is-invalid');
        $('#judul_berita').removeClass('is-valid');
        $('#tanggal').removeClass('is-invalid');
        $('#tanggal').removeClass('is-valid');
        $('#image').removeClass('is-invalid');
        $('#image').removeClass('is-valid');
    }
</script>
<?= $this->endsection(); ?>