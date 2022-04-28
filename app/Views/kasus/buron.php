<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>DPO</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addBuron()">
                <i class="ion ion-plus-circled"></i> Tambah
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Master Data</div>
            <div class="breadcrumb-item">DPO</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Image Ukuran 600x400</h4>
                        <div class="card-header-action">
                            <select name="kategori" id="filterJenis" class="form-control">
                                <option value="">All</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Buron" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
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



    <div class="modal fade" data-backdrop="false" role="dialog" id="modalBuron">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="reset()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body form_kasus">
                    <?php echo form_open_multipart('', ['id' => 'formBuron']); ?>
                    <div class="card-body Proses">
                        <input type="hidden" value="" name="id_buron" />
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nama_buron">Nama</label>
                                <input type="text" name="nama_buron" id="nama_buron" class="form-control" value="">
                                <div class="invalid-feedback errorNama">

                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="usia">Usia</label>
                                <input id="usia" type="number" class="form-control" value="" name="usia">
                                <div class="invalid-feedback errorUsia">

                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="form-group col-6">
                                <label for="alamat_buron">Alamat</label>
                                <input id="alamat_buron" type="text" class="form-control" value="" name="alamat_buron">
                                <div class="invalid-feedback errorAlamat">

                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="" hidden>Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback errorJenis">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="image">Image</label>
                                <input id="image" type="file" value="" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="image">
                                <div class="invalid-feedback errorImage">

                                </div>
                            </div>
                        </div>

                        <div class="preview">
                            <img src="" id="img_buron" alt="Placeholder" style="width: 30%; height:50%;">
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                    <div class="card-body Detail">
                        <div class="row">
                            <div class="col">
                                <h6 id="nama">
                                    AA
                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="usia_buron">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="jenis">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="alamat">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img src="" id="img_preview" alt="Image_buron" style="height: 65%; width:50%;">
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
        table = $('#Buron').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('buron/getBuron'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.jenis_kelamin = $('#filterJenis').val();
                }
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('uploads/buron'); ?>/' + full[1] + '"/>';
                    return img;
                },
            }, ],
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



    function detailBuron(id_buron) {
        $('#formBuron')[0].reset();
        $('.Foot').hide();
        $('.Proses').hide();
        $('.Detail').show();
        $.ajax({
            url: "<?= site_url('buron/get_id/'); ?>" + id_buron,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#nama').html("Nama buron :" + data.nama_buron);
                $('#usia_buron').html("Usia :" + data.usia);
                $('#jenis').html("jenis kelamin :" + data.jenis_kelamin);
                $('#alamat').html("alamat :" + data.alamat_buron);
                $('#img_preview').attr('src', '<?= base_url('uploads/buron'); ?>/' + data.image);
                $('#modalBuron').modal('show');
                $('.modal-title').text('Detail Buron');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function delBuron(id_buron) {
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
                    url: "<?= site_url('buron/del_buron/'); ?>" + id_buron,
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

    function editBuron(id_buron) {
        save_method = 'edit';
        $('#formBuron')[0].reset();
        $('.Foot').show();
        $('.Proses').show();
        $('.Detail').hide();
        $.ajax({
            url: "<?= site_url('buron/get_id/'); ?>" + id_buron,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('[name=id_buron]').val(data.id_buron);
                $('[name=nama_buron]').val(data.nama_buron);
                $('[name=usia]').val(data.usia);
                $('[name=alamat_buron]').val(data.alamat_buron);
                $('[name=jenis_kelamin]').val(data.jenis_kelamin);
                $('[name=image]').attr(data.image);
                $('#img_buron').attr('src', '<?= base_url('uploads/buron'); ?>/' + data.image);
                $('#modalBuron').modal('show');
                $('.modal-title').text('Edit DPO');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function addBuron() {
        save_method = 'add';
        $('#formBuron')[0].reset();
        $('#modalBuron').modal('show');
        $('.modal-title').text('Tambah DPO Terbaru');
        $('.Foot').show();
        $('.Proses').show();
        $('.Detail').hide();
    }

    function save() {
        let form = $('#formBuron')[0];
        let data = new FormData(form);
        if (save_method == 'add') {
            url = "<?= site_url('buron/tambah_buron'); ?>";
        } else {
            url = "<?= site_url('buron/edit_buron'); ?>";
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
                    if (data.errorJenis) {
                        $('#jenis_kelamin').addClass('is-invalid');
                        $('.errorJenis').html(data.errorJenis);
                    } else {
                        $('#jenis_kelamin').removeClass('is-invalid');
                        $('#jenis_kelamin').addClass('is-valid');
                    }
                    if (data.errorAlamat) {
                        $('#alamat_buron').addClass('is-invalid');
                        $('.errorAlamat').html(data.errorAlamat);
                    } else {
                        $('#alamat_buron').removeClass('is-invalid');
                        $('#alamat_buron').addClass('is-valid');
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
        $("#img_buron").attr("src", '');
        $('#nama_buron').removeClass('is-invalid');
        $('#nama_buron').removeClass('is-valid');
        $('#usia').removeClass('is-invalid');
        $('#usia').removeClass('is-valid');
        $('#jenis_kelamin').removeClass('is-invalid');
        $('#jenis_kelamin').removeClass('is-valid');
        $('#alamat_buron').removeClass('is-invalid');
        $('#alamat_buron').removeClass('is-valid');
        $('#image').removeClass('is-invalid');
        $('#image').removeClass('is-valid');
    }
</script>
<?= $this->endsection(); ?>