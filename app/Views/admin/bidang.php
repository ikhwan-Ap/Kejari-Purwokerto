<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Bidang</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="btnKategori()">
                Tambah
            </button>
            <button class="btn btn-primary" onclick="cekKategori()">
                Cek Kategori
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Bidang</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="section-body">

                        <div class="form-group col-6">
                            <label for="nama_pengurus">Nama Pengurus</label>
                            <input type="text" class="form-control" name="jabatan_pengurus" id="nama_pengurus" placeholder="nama_pengurus">
                            <div class="invalid-feedback errorNama">

                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="jabatan_pengurus">Jabatan Pengurus</label>
                            <input type="text" class="form-control" name="jabatan_pengurus" id="jabatan_pengurus" placeholder="jabatan_pengurus">
                            <div class="invalid-feedback errorJabatan">

                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="nip">NIP</label>
                            <input type="number" name="nip" class="form-control" id="nip" placeholder="nip">
                            <div class="invalid-feedback errorNip">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="nip">Kategori</label>
                            <select class="form-control" name="kategori_bidang" id="kategori_bidang">
                                <option value="" hidden>Pilih Kategori</option>
                                <option value="PIDUM">PIDUM</option>
                                <option value="DATUN">DATUN</option>
                                <option value="Barang Bukti">Barang Bukti</option>
                                <option value="Pembinaan">Pembinaan</option>
                                <option value="Intelejen">Intelejen</option>
                                <option value="Pidsus">Pidsus</option>
                            </select>
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
                                    <input id="image_bidang" type="file" value="" accept="image/*,png/" class="form-control" onchange="previewFile(this);" name="image_bidang">
                                    <img src="" id="img_bidang" alt="Preview Image" style="width: 280px; height:280px;">
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
            <h4>Kreasi Bidang</h4>
        </div>
        <div class="card">
            <div class="col">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="summernote" name="teks_bidang" id="teks_bidang"></textarea>
                        </div>
                    </div>
                    <center> <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Unggah</button></center>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalBidang">
        <div class="modal-dialog modal-sm kategori_kecil" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="reset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body Del">
                    <form action="#" id="formKategori" class="form-horizontal">
                        <div class="form-group col">
                            <label for="name">Kategori</label>
                            <input type="text" name="kategori" id="kategori" value="" class="form-control">
                            <div class="invalid-feedback errorKategori">
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="tambahKategori()" class="btn btn-primary Terima">Tambah</button>
                    <button type="button" class="btn btn-light" onclick="reset()" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
        <div class="modal-dialog modal-lg kategori_besar" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="reset()" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body Del">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Incrahft" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" onclick="reset()" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
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

    function cekKategori() {
        $('#modalBidang').modal('show');
        $('.modal-title').text('Data Kategori')
        $('.kategori_kecil').hide();
        $('.kategori_besar').show();
    }

    function reset() {

        $('#kategori').removeClass('is-invalid');
        $('#kategori').removeClass('is-valid');
    }

    function btnKategori() {
        $('#formKategori')[0].reset();
        $('#modalBidang').modal('show');
        $('.modal-title').text('Tambah Kategori')
        $('.kategori_kecil').show();
        $('.kategori_besar').hide();
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
                    data: $('#formBidang').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let data = response.error
                            if (data.errorKategori) {
                                $('#kategori').addClass('is-invalid');
                                $('.errorKategori').html(data.errorKategori);
                            } else {
                                $('#kategori').removeClass('is-invalid');
                                $('#kategori').addClass('is-valid');
                            }

                        }
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Data Berhasil Di Hapus',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                    $('#modalBidang').modal('hide');
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