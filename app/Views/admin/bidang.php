<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Bidang</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="btnKategori()">
                Tambah <i class="ion ion-plus-circled"></i>
            </button>
            <button class="btn btn-primary" onclick="cekKategori()">
                Cek Kategori <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Bidang</div>
        </div>
    </div>
    <?php echo form_open_multipart('', ['id' => 'formBidang']); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">

                        <div class="form-group col">
                            <label for="nama_pengurus">Nama Pengurus</label>
                            <input type="text" class="form-control" name="nama_pengurus" id="nama_pengurus" placeholder="nama_pengurus">
                            <div class="invalid-feedback errorNama">

                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="jabatan_pengurus">Jabatan Pengurus</label>
                            <input type="text" class="form-control" name="jabatan_pengurus" id="jabatan_pengurus" placeholder="jabatan_pengurus">
                            <div class="invalid-feedback errorJabatan">

                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="nip">NIP</label>
                            <input type="number" name="nip" class="form-control" id="nip" placeholder="nip">
                            <div class="invalid-feedback errorNip">

                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="nip">Kategori</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                <option value="" hidden>Pilih Kategori</option>
                                <?php foreach ($kategori as $informasi) :  ?>
                                    <option value="<?= $informasi['id_kategori']; ?>"><?= $informasi['nama_kategori']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                            <div class="invalid-feedback error_kategoriBidang">

                            </div>
                        </div>
                    </div>
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
                                    <input type="file" id="image_pengurus" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="image_pengurus">
                                    <img src="" id="img_bidang" alt="Preview Image" style="width: 280px; height:280px;">
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
    <div class="section-body">
        <div class="card-header">
            <h4>Detail Bidang</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" value="" name="teks_bidang" id="teks_bidang"></textarea>
                        </div>
                        <div class="invalid-feedback errorTeks">

                        </div>
                    </div>
                    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
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
                                        <th>Image</th>
                                        <th>NIP</th>
                                        <th>Nama Pengurus</th>
                                        <th>Jabatan Pengurus</th>
                                        <th>Kategori</th>
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


    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalBidang">
        <div class="modal-dialog modal-sm kategori_kecil" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="modalReset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body Del">
                    <?php form_open('', ['id' => 'form_tambahKategori']) ?>
                    <div class="form-group col">
                        <label for="name">Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="" class="form-control">
                        <div class="invalid-feedback errorKategori">
                        </div>

                    </div>
                    <?php form_close();  ?>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="tambahKategori()" class="btn btn-primary Terima">Tambah</button>
                    <button type="button" class="btn btn-light" onclick="modalReset()" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
        <div class="modal-dialog modal-lg kategori_besar" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="modalReset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body Del">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kategori as $informasi) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $informasi['nama_kategori']; ?></td>
                                            <td>
                                                <button class="btn btn-danger" onclick="delKategori(<?= $informasi['id_kategori']; ?>)">
                                                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" onclick="modalReset()" data-dismiss="modal">Kembali</button>
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
                "url": "<?= site_url('bidang/getBidang'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": 1,
                "data": "img",
                "render": function(url, type, full) {
                    var img = '<img height="50%" width="50%" src="<?= base_url('uploads/bidang'); ?>/' + full[1] + '"/>';
                    return img;
                },
            }, ],
        });

    });

    function cekKategori() {
        $('#modalBidang').modal('show');
        $('.modal-title').text('Data Kategori')
        $('.kategori_kecil').hide();
        $('.kategori_besar').show();
    }

    function btnKategori() {
        $('#form_tambahKategori')[0];
        $('#modalBidang').modal('show');
        $('.modal-title').text('Tambah Kategori')
        $('.kategori_kecil').show();
        $('.kategori_besar').hide();
    }

    function delKategori(id_kategori) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Kategori Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('bidang/delKategori/'); ?>" + id_kategori,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Kategori Berhasil Di Delete',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
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

    function tambahKategori() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menambah Data Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Simpan Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('bidang/tambah_kategori'); ?>",
                    data: $('#form_tambahKategori').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let data = response.error
                            if (data.errorKategori) {
                                $('#nama_kategori').addClass('is-invalid');
                                $('.errorKategori').html(data.errorKategori);
                            } else {
                                $('#nama_kategori').removeClass('is-invalid');
                                $('#nama_kategori').addClass('is-valid');
                            }
                        }
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Added!',
                                'Kategori Berhasil Di Tambahkan',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $('#modalBidang').modal('hide');
                                    window.location.reload();
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

    function modalReset() {
        $('#kategori').removeClass('is-invalid');
        $('#kategori').removeClass('is-valid');
    }

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#img_bidang").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    function resetForm() {
        $('#image_pengurus').removeClass('is-invalid');
        $('#image_pengurus').removeClass('is-valid');
        $('input').val('').removeAttr('checked').removeAttr('selected')
        $('select').val('').removeAttr('checked').removeAttr('selected');
        $("#img_bidang").attr("src", '');
        $(".summernote").summernote('code', '');
        $('#nama_pengurus').removeClass('is-invalid');
        $('#nama_pengurus').removeClass('is-valid');
        $('#jabatan_pengurus').removeClass('is-invalid');
        $('#jabatan_pengurus').removeClass('is-valid');
        $('#nip').removeClass('is-invalid');
        $('#nip').removeClass('is-valid');
        $('#id_kategori').removeClass('is-invalid');
        $('#id_kategori').removeClass('is-valid');
    }

    function save() {
        let form = $('#formBidang')[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "<?= site_url('bidang/tambah_bidang') ?>",
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
                        }
                    })
                }

            }
        });
    }
</script>

<?= $this->endsection(); ?>