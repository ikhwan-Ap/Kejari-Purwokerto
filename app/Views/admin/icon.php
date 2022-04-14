<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Icon</h1>
        <div class="col">
            <a href="/download" class="btn btn-primary" target="_blank">
                <span class="ion ion-archive" data-pack="android" data-tags="plus, include, invite">
                    Template
                </span>
            </a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Menu</div>
            <div class="breadcrumb-item">Icon</div>
        </div>
    </div>

    <div class="section-body">
        <div class="col">
            <div class="row">
                <div class="card-header col-6">
                    <h4>Icon Beranda Ukuran XX</h4>
                </div>
                <div class="card-header col-6">
                    <h4>Icon Contact Ukuran XX</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="section-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <?php echo form_open_multipart('', ['id' => 'formIcon']); ?>
                                <input type="text" name="id_icon_beranda" id="id_icon_beranda" value="" hidden>
                                <div class="dropzone" id="mydropzone">
                                    <div class="fallback">
                                        <input type="file" id="img_icon" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_icon">
                                        <img src="" id="image" alt="Preview Image" style="width: 100%; height:250px">
                                        <div class="invalid-feedback errorImage">
                                        </div>
                                    </div>
                                </div>
                                <center> <button type="submit" id="btnBeranda" onclick="save_beranda()" class="btn btn-primary">Unggah</button></center>
                                <?php form_close();  ?>
                            </div>

                            <div class="form-group col-6">
                                <?php echo form_open_multipart('', ['id' => 'formIcon']); ?>
                                <div class="dropzone" id="mydropzone">
                                    <div class="fallback">
                                        <input type="file" id="img_contact" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="img_contact">
                                        <img src="" id="image_contact" alt="Preview Image" style="width: 100%; height:250px;">
                                        <div class="invalid-feedback errorImage">
                                        </div>
                                    </div>
                                </div>
                                <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                                <?php form_close();  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "<?= site_url('menu/get_icon_beranda'); ?>",
            dataType: "json",
            success: function(data) {
                $('[name=id_icon_beranda]').val(data.id_icon);
                $('#image').attr('src', '<?= base_url('icon-icon'); ?>/' + data.img_icon);
            }
        });
    })

    function previewFile(input) {
        var file = $("#img_icon").get(0).files[0];
        var img = $("#img_contact").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
        if (img) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image_contact").attr("src", reader.result);
            }
            reader.readAsDataURL(img);
        }
    }

    function save_beranda() {
        let form = $('#formIcon')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('menu/edit_icon_beranda') ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnBeranda').prop('disabled', true);
                $('#btnBeranda').html('Loading');
            },
            complete: function() {
                $('#btnBeranda').prop('disabled', false);
                $('#btnBeranda').html('Unggah');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorImage) {
                        $('#img_icon').addClass('is-invalid');
                        $('.errorImage').html(data.errorImage);
                    } else {
                        $('#img_icon').removeClass('is-invalid');
                        $('#img_icon').addClass('is-valid');
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