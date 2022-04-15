<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Bidang</h1>
        <div class="col">
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Bidang</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formCarousel']); ?>
    <div class="row">
        <div class="col">
            <div class="card-header">
                <h4>Ukuran Carousel XXX</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="section-body">
                        <input type="text" name="id_carousel" value="" id="id_carousel" hidden>
                        <div class="form-group col">
                            <label for="nama_carousel">Nama Gambar/Carousel</label>
                            <input type="text" class="form-control" name="nama_carousel" id="nama_carousel" placeholder="Nama Gambar/Carousel">
                            <div class="invalid-feedback errorNama">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="dropzone" id="mydropzone">
                                <div class="fallback">
                                    <input type="file" id="image" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="image">
                                    <img src="" id="img_carousel" alt="Preview Image" style="width: 100%; height:100%;">
                                    <div class="invalid-feedback errorImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                    <center> <button type="submit" id="btnEdit" onclick="edit()" class="btn btn-primary">Edit</button></center>
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
                        <h4>Bidang</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Bidang" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Image</th>
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

    $(document).ready(function() {
        table = $('#Bidang').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('menu/getCarousel'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 2,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('img_carousel'); ?>/' + full[2] + '"/>';
                    return img;
                },
            }, ],
        });
        $('#btnEdit').hide();
    });

    function delCarousel(id_carousel) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Gambar/Carousel Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('menu/del_carousel/'); ?>" + id_carousel,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Carousel Berhasil Di Delete',
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


    function reload_table() {
        table.ajax.reload(null, false);
    }


    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#img_carousel").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    function resetForm() {
        $('#image').removeClass('is-invalid');
        $('#image').removeClass('is-valid');
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $("#img_carousel").attr("src", '');
        $('#nama_carousel').removeClass('is-invalid');
        $('#nama_carousel').removeClass('is-valid');
    }

    function save() {

        let form = $('#formCarousel')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('menu/tambah_carousel') ?>",
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
                        $('#nama_carousel').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_carousel').removeClass('is-invalid');
                        $('#nama_carousel').addClass('is-valid');
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
                            resetForm();
                            reload_table();
                        }
                    })
                }

            }
        });
    }

    function editCarousel(id_carousel) {
        $.ajax({
            type: "GET",
            url: "<?= site_url('menu/get_carousel/'); ?>" + id_carousel,
            dataType: "json",
            success: function(data) {
                $('#nama_carousel').val(data.nama_carousel);
                $('#id_carousel').val(data.id_carousel);
                $('#img_carousel').attr('src', '<?= base_url('img_carousel'); ?>/' + data.image);
                $('#btnEdit').show();
                $('#btnSave').hide();
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function edit() {
        let form = $('#formCarousel')[0];
        let data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= site_url('menu/edit_carousel') ?>",
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
                        $('#nama_carousel').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_carousel').removeClass('is-invalid');
                        $('#nama_carousel').addClass('is-valid');
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
                        html: `Data Berhasil Di Edit`,
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