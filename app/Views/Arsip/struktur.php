<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Struktur </h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addStruktur()">
                Tambah <i class="ion ion-plus-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Struktur</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Struktur</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Struktur" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Nama Struktur</th>
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

    <div class="modal fade" data-backdrop="false" role="dialog" id="modalStruktur">
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
                        <?php echo form_open_multipart('', ['id' => 'formStruktur']); ?>
                        <div class="card-body Method">
                            <input type="hidden" value="" id="id_struktur" name="id_struktur" />
                            <div class="row">
                                <div class="form-group col">
                                    <label for="nama_struktur">Nama Struktur</label>
                                    <input id="nama_struktur" type="text" class="form-control" value="" name="nama_struktur">
                                    <div class="invalid-feedback errorNama">

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
                                                        <input type="file" id="img_struktur" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_struktur">
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
        table = $('#Struktur').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('struktur/getStruktur'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('uploads/struktur'); ?>/' + full[1] + '"/>';
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

    function addStruktur() {
        save_method = 'Add';
        $('#modalStruktur').modal('show');
        $('.modal-title').text('Tambah Data Struktur');
    }

    function editStruktur(id_struktur) {
        save_method = 'Update';
        $.ajax({
            type: "GET",
            url: "<?= site_url('struktur/get_id/'); ?>" + id_struktur,
            dataType: "json",
            success: function(data) {
                $('#id_struktur').val(data.id_struktur);
                $('#nama_struktur').val(data.nama_struktur);
                $('#image').attr('src', '<?= base_url('uploads/struktur'); ?>/' + data.img_struktur);
                $('#modalStruktur').modal('show');
                $('.modal-title').text('Edit Data Struktur');
            }
        });
    }

    function save() {
        let form = $('#formStruktur')[0];
        let data = new FormData(form);
        if (save_method == 'Add') {
            url = "<?= base_url('struktur/tambah_struktur'); ?>";
        } else {
            url = "<?= base_url('struktur/edit_struktur'); ?>";
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
                        $('#nama_struktur').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_struktur').removeClass('is-invalid');
                        $('#nama_struktur').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#img_struktur').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_struktur').removeClass('is-invalid');
                        $('#img_struktur').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Struktur Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            $('#modalStruktur').modal('hide');
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function reset() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_struktur').removeClass('is-invalid');
        $('#img_struktur').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_struktur').removeClass('is-invalid');
        $('#nama_struktur').removeClass('is-valid');
    }

    function reset_data() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('#img_struktur').removeClass('is-invalid');
        $('#img_struktur').removeClass('is-valid');
        $("#image").attr("src", '');
        $('#nama_struktur').removeClass('is-invalid');
        $('#nama_struktur').removeClass('is-valid');
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delStruktur(id_struktur) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Banner Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('struktur/del_struktur/'); ?>" + id_struktur,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Struktur Berhasil Di Delete',
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