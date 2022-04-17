<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Visi Dan Misi</h1>
        <div class="col">
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Visi Dan Misi</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'form_visiMisi']); ?>
    <div class="section-body">
        <div class="card-header">
            <h4>Detail Visi</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="visi" id="visi"></textarea>
                        </div>
                        <div class="invalid-feedback errorVisi">

                        </div>
                        <input type="text" value="" name="id_visiMisi" id="id_visiMisi" hidden>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-header">
            <h4>Detail Misi</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="misi" id="misi"></textarea>
                        </div>
                        <div class="invalid-feedback errorMisi">

                        </div>
                    </div>
                    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                    <!-- <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center> -->
                </div>

            </div>

        </div>
    </div>
    <?php form_close();  ?>
</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btnEdit').hide();

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
        $.ajax({
            type: "GET",
            url: "<?= site_url('visi_misi/get_data'); ?>",
            dataType: "json",
            success: function(data) {
                $('#id_visiMisi').val(data.id);
                $('#visi').summernote('code', data.visi);
                $('#misi').summernote('code', data.misi);
            }
        });

    });

    function save() {

        let form = $('#form_visiMisi')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('visi_misi/edit') ?>",
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
                    if (data.errorVisi) {
                        $('#visi').addClass('is-invalid');
                        $('.errorVisi').html(data.errorVisi);
                    } else {
                        $('#visi').removeClass('is-invalid');
                        $('#visi').addClass('is-valid');
                    }
                    if (data.errorMisi) {
                        $('#misi').addClass('is-invalid');
                        $('.errorMisi').html(data.errorMisi);
                    } else {
                        $('#misi').removeClass('is-invalid');
                        $('#misi').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di Ubah`,
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    })
                }

            }
        });
    }

    function editBidang(id_bidang) {
        var textareaValue = $('#teks_bidang').summernote('code');
        $.ajax({
            type: "GET",
            url: "<?= site_url('bidang/get_id/'); ?>" + id_bidang,
            dataType: "json",
            success: function(data) {
                $('#nama_pengurus').val(data.nama_pengurus);
                $('#jabatan_pengurus').val(data.jabatan_pengurus);
                $('#nip').val(data.nip);
                $('[name=id_kategori]').val(data.id_kategori);
                $('[name=id_bidang]').val(data.id_bidang);
                $('#img_bidang').attr('src', '<?= base_url('uploads/bidang'); ?>/' + data.image_pengurus);
                $("#teks_bidang").summernote('code', data.teks_bidang);
                $('#btnEdit').show();
                $('#btnSave').hide();
            }
        });
    }

    function edit() {
        let form = $('#formBidang')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('bidang/edit_bidang') ?>",
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
                        $('#nama_pengurus').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pengurus').removeClass('is-invalid');
                        $('#nama_pengurus').addClass('is-valid');
                    }
                    if (data.errorJabatan) {
                        $('#jabatan_pengurus').addClass('is-invalid');
                        $('.errorJabatan').html(data.errorJabatan);
                    } else {
                        $('#jabatan_pengurus').removeClass('is-invalid');
                        $('#jabatan_pengurus').addClass('is-valid');
                    }
                    if (data.errorNip) {
                        $('#nip').addClass('is-invalid');
                        $('.errorNip').html(data.errorNip);
                    } else {
                        $('#nip').removeClass('is-invalid');
                        $('#nip').addClass('is-valid');
                    }
                    if (data.error_kategoriBidang) {
                        $('#id_kategori').addClass('is-invalid');
                        $('.error_kategoriBidang').html(data.error_kategoriBidang);
                    } else {
                        $('#id_kategori').removeClass('is-invalid');
                        $('#id_kategori').addClass('is-valid');
                    }
                    if (data.errorImage) {
                        $('#image_pengurus').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#image_pengurus').removeClass('is-invalid');
                        $('#image_pengurus').addClass('is-valid');
                    }
                    if (data.errorTeks) {
                        $('#teks_bidang').addClass('is-invalid');
                        $('.errorTeks').html(data.errorTeks);
                    } else {
                        $('#teks_bidang').removeClass('is-invalid');
                        $('#teks_bidang').addClass('is-valid');
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