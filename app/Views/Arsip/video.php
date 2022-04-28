<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Video</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="showForm()" id="btnOpen">
                Hubungkan Video Youtube <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" onclick="hideForm()" id="btnClose">
                Tutup Form <i class="ion ion-close-circled"></i>
            </button>
        </div>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Arsip</div>
            <div class="breadcrumb-item">Video</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formVideo']); ?>
    <div class="row col-12 hid-form" id="form-top">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_video" value="" id="id_video" hidden>
                        <div class="form-group col">
                            <label for="judul_video">Judul Video</label>
                            <input type="text" class="form-control" name="judul_video" id="judul_video" placeholder="">
                            <div class="invalid-feedback errorJudul">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="url">Link Video</label>
                            <input type="text" class="form-control" name="url" id="url" placeholder="" onchange="filter()">
                            <div class="invalid-feedback errorUrl">
                            </div>
                        </div>
                        <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button></center>
                        <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center>
                    </div>
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
                        <h4>Video</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Video" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Video</th>
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

    function filter(urel) {
        let filter = document.getElementById('url').value;
        // filter = filter.replace(/[^a-zA-Z0-9]/g,' ');
        filter = filter.substr(filter.length - 11);
        document.getElementById('url').value = filter;
    }
    $(document).ready(function() {

        table = $('#Video').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('video/getVideo'); ?>",
                "type": "POST",
            },
        });
        $('#btnEdit').hide();
        $('#btnClose').hide();
        $('#judul_video').focus();
    });

    function showForm() {
        $("#form-top").css("display", "flex");
        $("#btnClose").show();
        $("#btnOpen").hide();
        $('#judul_video').focus();
        resetForm();
    }

    function save() {

        let form = $('#formVideo')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('video/tambah_video') ?>",
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
                $('#btnSave').prop('0led', false);
                $('#btnSave').html('Unggah');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorJudul) {
                        $('#judul_video').addClass('is-invalid');
                        $('#judul_video').attr('autofocus', true);
                        $('.errorJudul').html(data.errorJudul);
                    } else {
                        $('#judul_video').removeClass('is-invalid');
                        $('#judul_video').addClass('is-valid');
                    }
                    if (data.errorUrl) {
                        $('#url').addClass('is-invalid');
                        $('#judul_video').attr('autofocus', true);
                        $('.errorUrl').html(data.errorUrl);
                    } else {
                        $('#url').removeClass('is-invalid');
                        $('#url').addClass('is-valid');
                    }
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
        $("#btnClose").hide();
        $("#btnOpen").show();
    }

    function delVideo(id_video) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Video Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('video/delVideo/'); ?>" + id_video,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Video Berhasil Di Hapus',
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

    function resetForm() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $('#judul_video').removeClass('is-invalid');
        $('#judul_video').removeClass('is-valid');
        $('#url').removeClass('is-invalid');
        $('#url').removeClass('is-valid');

    }

    function editVideo(id_video) {
        $.ajax({
            type: "GET",
            url: "<?= site_url('video/get_id/'); ?>" + id_video,
            dataType: "json",
            success: function(data) {
                showForm();
                $('#judul_video').val(data.judul_video);
                $('#url').val(data.url);
                $('[name=id_video]').val(data.id_video);
                $('#btnEdit').show();
                $('#btnSave').hide();
                $('#judul_video').focus();
            }
        });
    }

    function edit() {
        let form = $('#formVideo')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('video/editVideo') ?>",
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
                        $('#judul_video').addClass('is-invalid');
                        $('.errorJudul').html(data.errorJudul);
                        $('#judul_video').focus();
                    } else {
                        $('#judul_video').removeClass('is-invalid');
                        $('#judul_video').addClass('is-valid');
                    }
                    if (data.errorUrl) {
                        $('#url').addClass('is-invalid');
                        $('.errorUrl').html(data.errorUrl);
                    } else {
                        $('#url').removeClass('is-invalid');
                        $('#url').addClass('is-valid');
                    }
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
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>