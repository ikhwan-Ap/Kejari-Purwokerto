<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Navbar</h1>
        <div class="col">
            <button type="submit" class="btn btn-primary">
                <i class="ion ion-ios-cloud-download"></i> Template
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Menu</div>
            <div class="breadcrumb-item">Navbar</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formNavbar']); ?>
    <div class="section-body">
        <div class="card-header">
            <h4>Ukuran 1600x100 px</h4>
        </div>
        <input type="text" name="id_navbar" id="id_navbar" value="id_navbar">
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="section-body">
                        <div class="form-group">
                            <div class="dropzone" id="mydropzone">
                                <div class="fallback">
                                    <input type="file" id="img_navbar" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_navbar">
                                    <img src="" id="image" alt="Preview Image" style="width: 100%; height:100%;">
                                    <div class="invalid-feedback errorImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php form_close();  ?>
</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var table;

    $(document).ready(function() {

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

    function save() {

        let form = $('#formNavbar')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('menu/tambah_navbar') ?>",
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
                        $('#nama_pengurus').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pengurus').removeClass('is-invalid');
                        $('#nama_pengurus').addClass('is-valid');
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
                        }
                    })
                }

            }
        });
    }

    function editBidang(id_bidang) {
        $.ajax({
            type: "GET",
            url: "<?= site_url('bidang/get_id/'); ?>" + id_bidang,
            dataType: "json",
            success: function(data) {
                $('#image').attr('src', '<?= base_url('uploads/bidang'); ?>/' + data.img_navbar);
            }
        });
    }

    function edit() {
        let form = $('#formNavbar')[0];
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
                    if (data.errorImage) {
                        $('#img_navbar').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_navbar').removeClass('is-invalid');
                        $('#img_navbar').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Image Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>