<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Agenda</h1>
        <div class="col">
            <button class="btn btn-primary" id="btnAgenda" onclick="btnAgenda()">
                Tambah <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-danger" id="btnClose" onclick="btnClose()">
                Close Form <i class="ion ion-close-circled"></i>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Agenda</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formAgenda']); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_agenda" value="" id="id_agenda" hidden>
                        <div class="form-group col">
                            <label for="nama_agenda">Nama Agenda</label>
                            <input type="text" class="form-control" name="nama_agenda" id="nama_agenda" placeholder="Nama Agenda">
                            <div class="invalid-feedback errorAgenda">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="tanggal_agenda">Tanggal Agenda</label>
                            <input type="date" class="form-control" name="tanggal_agenda" id="tanggal_agenda">
                            <div class="invalid-feedback errorTanggal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <h4>Detail Agenda</h4>
            </div>
            <div class="card">
                <div class="col">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <div class="col-sm-12">
                                <textarea class="summernote" value="" name="teks_agenda" id="teks_agenda"></textarea>
                            </div>
                            <div class="invalid-feedback errorTeks">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
    <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center>


    <?php form_close();  ?>
</section>


<div class="section-body">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Agenda</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="Agenda" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Agenda</th>
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

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#Agenda').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('modul/getAgenda'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
            }, ],
        });
        $('#btnEdit').hide();
        $('#btnClose').hide();
        $('#formAgenda').hide();
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

    function delAgenda(id_agenda) {
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
                    url: "<?= site_url('modul/del_agenda/'); ?>" + id_agenda,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Agenda Berhasil Di Delete',
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

    function btnAgenda() {
        $('#formAgenda').show();
        $('#btnAgenda').hide();
        $('#btnClose').show();
    }

    function btnClose() {
        $('#formAgenda').hide();
        $('#btnAgenda').show();
        $('#btnClose').hide();
        resetForm();
    }


    function reload_table() {
        table.ajax.reload(null, false);
    }



    function resetForm() {
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $(".summernote").summernote('code', '');
        $('#nama_agenda').removeClass('is-invalid');
        $('#nama_agenda').removeClass('is-valid');
        $('#tanggal_agenda').removeClass('is-invalid');
        $('#tanggal_agenda').removeClass('is-valid');
        $('#tanggal_agenda').removeClass('is-invalid');
        $('#teks_agenda').removeClass('is-valid');
    }

    function save() {
        let form = $('#formAgenda')[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "<?= site_url('modul/tambah_agenda') ?>",
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
                    if (data.errorAgenda) {
                        $('#nama_agenda').addClass('is-invalid');
                        $('.errorAgenda').html(data.errorAgenda);
                    } else {
                        $('#nama_agenda').removeClass('is-invalid');
                        $('#nama_agenda').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal_agenda').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal_agenda').removeClass('is-invalid');
                        $('#tanggal_agenda').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_agenda').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_agenda').removeClass('is-invalid');
                        $('#teks_agenda').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            resetForm();
                            reload_table();
                            $('#btnAgenda').show();
                            $('#btnClose').hide();
                            $('#formAgenda').hide();
                            document.body.scrollTop = 0;
                            document.documentElement.scrollTop = 0;
                        }
                    })
                }

            }
        });
    }

    function editAgenda(id_agenda) {
        $('#formAgenda').show();
        $('#btnAgenda').hide();
        $('#btnClose').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('modul/get_id/'); ?>" + id_agenda,
            dataType: "json",
            success: function(data) {
                $('#nama_agenda').val(data.nama_agenda);
                $('#tanggal_agenda').val(data.tanggal_agenda);
                $("#teks_agenda").summernote('code', data.teks_agenda);
                $('#id_agenda').val(data.id_agenda);
                $('#btnEdit').show();
                $('#btnSave').hide();
            }
        });
    }

    function edit() {
        let form = $('#formAgenda')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('modul/edit_agenda') ?>",
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
                    if (data.errorAgenda) {
                        $('#nama_agenda').addClass('is-invalid');
                        $('.errorAgenda').html(data.errorAgenda);
                    } else {
                        $('#nama_agenda').removeClass('is-invalid');
                        $('#nama_agenda').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal_agenda').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal_agenda').removeClass('is-invalid');
                        $('#tanggal_agenda').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_agenda').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_agenda').removeClass('is-invalid');
                        $('#teks_agenda').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di Edit`,
                    }).then((result) => {
                        if (result.value) {
                            resetForm();
                            reload_table();
                            $('#btnEdit').hide();
                            $('#btnSave').show();
                            $('#btnAgenda').show();
                            $('#btnClose').hide();
                            $('#formAgenda').hide();
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