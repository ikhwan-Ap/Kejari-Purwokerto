<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kepala Kejaksaan </h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addKepala()">
                Tambah <i class="ion ion-plus-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Kepala Kejaksaan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Kepala Kejaksaan</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Kejaksaan" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Nama Kepala Kejaksaan</th>
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

    <div class="modal fade" data-backdrop="false" role="dialog" id="modalKejaksaan">
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
                        <?php echo form_open_multipart('', ['id' => 'formKejaksaan']); ?>
                        <div class="card-body Method">
                            <input type="hidden" value="" id="id_kepala_kejaksaan" name="id_kepala_kejaksaan" />
                            <div class="col">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="nama_banner">Nama Kepala Kejaksaan</label>
                                        <input id="nama_kepala_kejaksaan" type="text" class="form-control" value="" name="nama_kepala_kejaksaan">
                                        <div class="invalid-feedback errorNama">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <div class="dropzone" id="mydropzone">
                                            <div class="fallback">
                                                <input type="file" id="img_kepala_kejaksaan" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_kepala_kejaksaan">
                                                <img src="" id="image" alt="Preview Image" style="width: 280px; height:280px;">
                                                <div class="invalid-feedback errorImage">
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
        table = $('#Kejaksaan').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('kejaksaan/getKepalaKejaksaan'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('uploads/kepala_kejaksaan'); ?>/' + full[1] + '"/>';
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

    function addKepala() {
        save_method = 'Add';
        $('#modalKejaksaan').modal('show');
        $('.modal-title').text('Tambah Data Kepala Kejaksaan');
    }

    function editKejaksaan(id_kepala_kejaksaan) {
        save_method = 'Update';
        $.ajax({
            type: "GET",
            url: "<?= site_url('kejaksaan/get_id/'); ?>" + id_kepala_kejaksaan,
            dataType: "json",
            success: function(data) {
                $('#id_kepala_kejaksaan').val(data.id_kepala_kejaksaan);
                $('#nama_kepala_kejaksaan').val(data.nama_kepala_kejaksaan);
                $('#image').attr('src', '<?= base_url('uploads/kepala_kejaksaan'); ?>/' + data.img_kepala_kejaksaan);
                $('#modalKejaksaan').modal('show');
                $('.modal-title').text('Edit Data Kepala Kejaksaan');
            }
        });
    }

    function save() {
        let form = $('#formKejaksaan')[0];
        let data = new FormData(form);
        if (save_method == 'Add') {
            url = "<?= base_url('kejaksaan/tambah_kepala_kejaksaan'); ?>";
        } else {
            url = "<?= base_url('kejaksaan/edit_kepala_kejaksaan'); ?>";
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
                        $('#nama_kepala_kejaksaan').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_kepala_kejaksaan').removeClass('is-invalid');
                        $('#nama_kepala_kejaksaan').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_kepala_kejaksaan').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_kepala_kejaksaan').removeClass('is-invalid');
                        $('#img_kepala_kejaksaan').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Kepala Kejaksaan Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            $('#modalKejaksaan').modal('hide');
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function reset() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_kepala_kejaksaan').removeClass('is-invalid');
        $('#img_kepala_kejaksaan').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_kepala_kejaksaan').removeClass('is-invalid');
        $('#nama_kepala_kejaksaan').removeClass('is-valid');
    }

    function reset_data() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_kepala_kejaksaan').removeClass('is-invalid');
        $('#img_kepala_kejaksaan').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_kepala_kejaksaan').removeClass('is-invalid');
        $('#nama_kepala_kejaksaan').removeClass('is-valid');
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delKejaksaan(id_kepala_kejaksaan) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('kejaksaan/del_kepala_kejaksaan/'); ?>" + id_kepala_kejaksaan,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Data Kepala Kejaksaan Berhasil Di Delete',
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