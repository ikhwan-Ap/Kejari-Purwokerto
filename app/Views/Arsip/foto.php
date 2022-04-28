<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Arsip Foto </h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addArsip()">
                Tambah <i class="ion ion-plus-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Arsip</div>
            <div class="breadcrumb-item">Foto</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Arsip Foto</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Arsip_foto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Nama Arsip</th>
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

    <div class="modal fade" data-backdrop="false" role="dialog" id="modalArsip">
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
                        <?php echo form_open_multipart('', ['id' => 'formArsip']); ?>
                        <div class="card-body Method">
                            <input type="hidden" value="" id="id_arsip_foto" name="id_arsip_foto" />
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_arsip_foto">Nama Arsip</label>
                                    <input id="nama_arsip_foto" type="text" class="form-control" value="" name="nama_arsip_foto">
                                    <div class="invalid-feedback errorNama">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="tanggal_arsip_foto">Tanggal Arsip</label>
                                    <input type="date" name="tanggal_arsip_foto" id="tanggal_arsip_foto" class="form-control" value="">
                                    <div class="invalid-feedback errorTanggal">
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
                                                        <input type="file" id="img_arsip_foto" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_arsip_foto">
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
                        <?php form_close();  ?>
                    </div>
                </div>
                <div class="modal-footer Foot">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-light" onclick="reset_data()" data-dismiss="modal">Tidak</button>
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
        table = $('#Arsip_foto').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('arsip/getFoto'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('img_arsip/foto'); ?>/' + full[1] + '"/>';
                    return img;
                }
            }, ],
        });
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

    function addArsip() {
        save_method = 'Add';
        $('#modalArsip').modal('show');
        $('.modal-title').text('Tambah Data Arsip Foto');
    }

    function editArsip(id_arsip_foto) {
        save_method = 'Update';
        $.ajax({
            type: "GET",
            url: "<?= site_url('arsip/get_id/'); ?>" + id_arsip_foto,
            dataType: "json",
            success: function(data) {
                $('#id_arsip_foto').val(data.id_arsip_foto);
                $('#nama_arsip_foto').val(data.nama_arsip_foto);
                $('#tanggal_arsip_foto').val(data.tanggal_arsip_foto);
                $('#image').attr('src', '<?= base_url('img_arsip/foto'); ?>/' + data.img_arsip_foto);
                $('#modalArsip').modal('show');
                $('.modal-title').text('Edit Data Arsip');
            }
        });
    }

    function save() {
        let form = $('#formArsip')[0];
        let data = new FormData(form);
        if (save_method == 'Add') {
            url = "<?= base_url('arsip/tambah_foto'); ?>";
        } else {
            url = "<?= base_url('arsip/edit_foto'); ?>";
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
                        $('#nama_arsip_foto').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_arsip_foto').removeClass('is-invalid');
                        $('#nama_arsip_foto').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal_arsip_foto').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal_arsip_foto').removeClass('is-invalid');
                        $('#tanggal_arsip_foto').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_arsip_foto').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_arsip_foto').removeClass('is-invalid');
                        $('#img_arsip_foto').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Arsip Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            $('#modalArsip').modal('hide');
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function reset() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_arsip_foto').removeClass('is-invalid');
        $('#img_arsip_foto').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_arsip_foto').removeClass('is-invalid');
        $('#nama_arsip_foto').removeClass('is-valid');
        $('#tanggal_arsip_foto').removeClass('is-invalid');
        $('#tanggal_arsip_foto').removeClass('is-valid');
    }

    function reset_data() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_arsip_foto').removeClass('is-invalid');
        $('#img_arsip_foto').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_arsip_foto').removeClass('is-invalid');
        $('#nama_arsip_foto').removeClass('is-valid');
        $('#tanggal_arsip_foto').removeClass('is-invalid');
        $('#tanggal_arsip_foto').removeClass('is-valid');
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delArsip(id_arsip_foto) {
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
                    url: "<?= site_url('arsip/del_foto/'); ?>" + id_arsip_foto,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Arsip Berhasil Di Delete',
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