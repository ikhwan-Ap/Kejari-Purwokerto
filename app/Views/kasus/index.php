<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kasus</h1>
        <div class="col">
            <button class="btn btn-primary" onclick="addKasus()">
                <i class="ion ion-plus-circled"></i> Tambah
            </button>
            <button class="btn btn-primary" onclick="addKasus()">
                <i class="ion ion-ios-cloud-upload"></i> Excel
            </button>
            <button class="btn btn-primary">
                <i class="ion ion-ios-cloud-download"></i> Template
            </button>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Kasus</h4>
                        <div class="card-header-action">
                            <select name="filter" id="filter" class="form-control text-color primary">
                                <option value="" hidden>Filter</option>
                                <option value="Umum">Umum</option>
                                <option value="Khusus">Khusus</option>
                                <option value="Datun">Datun</option>
                                <option value="Buron">Buron</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="tableKasus" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Perkara</th>
                                        <th>Nama Terdakwa</th>
                                        <th>Nama Hakim</th>
                                        <th>Nama Jaksa</th>
                                        <th>Keterangan</th>
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



    <div class="modal fade" data-backdrop="false" role="dialog" id="modalKasus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" onclick="reset()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body form_kasus">
                    <div class="card-body Proses ">
                        <form action="#" id="formKasus" class="form-horizontal">
                            <div class="card-body Method">
                                <input type="hidden" value="" name="id_kasus" />
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nama_terdakwa">Nama Terdakwa</label>
                                        <input id="nama_terdakwa" type="text" class="form-control" value="" name="nama_terdakwa">
                                        <div class="invalid-feedback errorNama">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="no_perkara">No Perkara</label>
                                        <input id="no_perkara" type="text" class="form-control" value="" name="no_perkara">
                                        <div class="invalid-feedback erorrNomor">

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea id="keterangan" type="text" class="form-control" value="" name="keterangan">
                                    </textarea>
                                        <div class="invalid-feedback errorKeterangan">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="alamat_terdakwa">Alamat Terdakwa</label>
                                        <input id="alamat_terdakwa" class="form-control" value="" name="alamat_terdakwa">
                                        <tex class="invalid-feedback errorAlamat">

                                    </div>
                                    <div class="form-group col">
                                        <label for="nama_saksi">Nama Saksi</label>
                                        <input id="nama_saksi" class="form-control" value="" name="nama_saksi">
                                        <tex class="invalid-feedback errorSaksi">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="jenis_perkara">Jenis Perkara</label>
                                        <textarea id="jenis_perkara" type="jenis_perkara" class="form-control" value="" name="jenis_perkara">
                                    </textarea>
                                        <div class="invalid-feedback errorJenis">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nama_hakim">Nama Hakim</label>
                                        <input id="nama_hakim" type="text" class="form-control" value="" name="nama_hakim">
                                        <div class="invalid-feedback errorHakim">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="nama_jaksa">Nama Jaksa</label>
                                        <input id="nama_jaksa" type="text" class="form-control" value="" name="nama_jaksa">
                                        <div class="invalid-feedback errorJaksa">

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="kategori">Kategori</label>
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value="" hidden>== Kategori ==</option>
                                            <option value="Umum">Umum</option>
                                            <option value="Khusus">Khusus</option>
                                            <option value="Datun">Datun</option>
                                            <option value="Buron">Buron</option>
                                        </select>
                                        <div class="invalid-feedback errorKategori">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="">
                                    </div>
                                    <div class="invalid-feedback errorTanggal">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body Detail">
                        <div class="row">
                            <div class="col">
                                <h6 id="nama">
                                    AA
                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="no">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="alamat">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="tgl">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="hakim">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="jaksa">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="saksi">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="perkara">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="ket">

                                </h6>
                            </div>

                            <div class="col">
                                <h6 id="kategori_terdakwa">

                                </h6>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer Foot">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-light" onclick="reset()" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>



</section>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    var save_method;
    var table;
    $(document).ready(function() {
        table = $('#tableKasus').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('kasus/getKasus'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function reset() {
        $('#nama_terdakwa').removeClass('is-invalid');
        $('#nama_terdakwa').removeClass('is-valid');
        $('#no_perkara').removeClass('is-invalid');
        $('#no_perkara').removeClass('is-valid');
        $('#alamat_terdakwa').removeClass('is-invalid');
        $('#alamat_terdakwa').removeClass('is-valid');
        $('#keterangan').removeClass('is-invalid');
        $('#keterangan').removeClass('is-valid');
        $('#nama_hakim').removeClass('is-invalid');
        $('#nama_hakim').removeClass('is-valid');
        $('#nama_jaksa').removeClass('is-invalid');
        $('#nama_jaksa').removeClass('is-valid');
        $('#nama_saksi').removeClass('is-invalid');
        $('#nama_saksi').removeClass('is-valid');
        $('#tanggal').removeClass('is-invalid');
        $('#tanggal').removeClass('is-valid');
        $('#jenis_perkara').removeClass('is-invalid');
        $('#jenis_perkara').removeClass('is-valid');
        $('#kategori').removeClass('is-invalid');
        $('#kategori').removeClass('is-valid');
    }

    function addKasus() {
        save_method = 'add';
        $('#formKasus')[0].reset();
        $('#modalKasus').modal('show');
        $('.modal-title').text('Tambah Kasus Terbaru');
        $('.Foot').show();
        $('.Proses').show();
        $('.Detail').hide();
    }

    function editKasus(id_kasus) {
        save_method = 'edit';
        $('#formKasus')[0].reset();
        $('.Foot').show();
        $('.Proses').show();
        $('.Detail').hide();
        $.ajax({
            url: "<?= site_url('kasus/get_id/'); ?>" + id_kasus,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('[name=id_kasus]').val(data.id_kasus);
                $('[name=nama_terdakwa]').val(data.nama_terdakwa);
                $('[name=no_perkara]').val(data.no_perkara);
                $('[name=alamat_terdakwa]').val(data.alamat_terdakwa);
                $('[name=keterangan]').val(data.keterangan);
                $('[name=nama_hakim]').val(data.nama_hakim);
                $('[name=nama_jaksa]').val(data.nama_jaksa);
                $('[name=nama_saksi]').val(data.nama_saksi);
                $('[name=kategori]').val(data.kategori);
                $('[name=jenis_perkara]').val(data.jenis_perkara);
                $('[name=tanggal]').val(data.tanggal);
                $('#modalKasus').modal('show');
                $('.modal-title').text('Edit Kasus');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        if (save_method == 'add') {
            url = "<?= site_url('kasus/tambah_kasus'); ?>";
        } else {
            url = "<?= site_url('kasus/edit_kasus'); ?>";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: $('#formKasus').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html('Tunggu');
            },
            complete: function() {
                $('#btnSave').prop('disabled', false);
                $('#btnSave').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error;
                    if (data.errorNama) {
                        $('#nama_terdakwa').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_terdakwa').removeClass('is-invalid');
                        $('#nama_terdakwa').addClass('is-valid');
                    }
                    if (data.erorrNomor) {
                        $('#no_perkara').addClass('is-invalid');
                        $('.erorrNomor').html(data.erorrNomor);
                    } else {
                        $('#no_perkara').removeClass('is-invalid');
                        $('#no_perkara').addClass('is-valid');
                    }
                    if (data.errorAlamat) {
                        $('#alamat_terdakwa').addClass('is-invalid');
                        $('.errorAlamat').html(data.errorAlamat);
                    } else {
                        $('#alamat_terdakwa').removeClass('is-invalid');
                        $('#alamat_terdakwa').addClass('is-valid');
                    }
                    if (data.errorHakim) {
                        $('#nama_hakim').addClass('is-invalid');
                        $('.errorHakim').html(data.errorHakim);
                    } else {
                        $('#nama_hakim').removeClass('is-invalid');
                        $('#nama_hakim').addClass('is-valid');
                    }
                    if (data.errorJaksa) {
                        $('#nama_jaksa').addClass('is-invalid');
                        $('.errorJaksa').html(data.errorJaksa);
                    } else {
                        $('#nama_jaksa').removeClass('is-invalid');
                        $('#nama_jaksa').addClass('is-valid');
                    }
                    if (data.errorSaksi) {
                        $('#nama_saksi').addClass('is-invalid');
                        $('.errorSaksi').html(data.errorSaksi);
                    } else {
                        $('#nama_saksi').removeClass('is-invalid');
                        $('#nama_saksi').addClass('is-valid');
                    }
                    if (data.errorKeterangan) {
                        $('#keterangan').addClass('is-invalid');
                        $('.errorKeterangan').html(data.errorKeterangan);
                    } else {
                        $('#keterangan').removeClass('is-invalid');
                        $('#keterangan').addClass('is-valid');
                    }
                    if (data.errorKategori) {
                        $('#kategori').addClass('is-invalid');
                        $('.errorKategori').html(data.errorKategori);
                    } else {
                        $('#kategori').removeClass('is-invalid');
                        $('#kategori').addClass('is-valid');
                    }
                    if (data.errorJenis) {
                        $('#jenis_perkara').addClass('is-invalid');
                        $('.errorJenis').html(data.errorJenis);
                    } else {
                        $('#jenis_perkara').removeClass('is-invalid');
                        $('#jenis_perkara').addClass('is-valid');
                    }
                    if (data.errorTanggal) {
                        $('#tanggal').addClass('is-invalid');
                        $('.errorTanggal').html(data.errorTanggal);
                    } else {
                        $('#tanggal').removeClass('is-invalid');
                        $('#tanggal').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            reload_table();
                            $('#modalKasus').modal('hide');
                        }
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function delKasus(id_kasus) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('kasus/del_kasus/'); ?>/" + id_kasus,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
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
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }

    function detailKasus(id_kasus) {
        $('#formKasus')[0].reset();
        $('.Foot').hide();
        $('.Proses').hide();
        $('.Detail').show();
        $.ajax({
            url: "<?= site_url('kasus/get_id/'); ?>" + id_kasus,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#nama').html("Nama terdakwa :" + data.nama_terdakwa);
                $('#no').html("Nomor Perkara :" + data.no_perkara);
                $('#alamat').html("Alamat :" + data.alamat_terdakwa);
                $('#ket').html("Keterangan :" + data.keterangan);
                $('#hakim').html("Nama Hakim :" + data.nama_hakim);
                $('#jaksa').html("Nama Jaksa :" + data.nama_jaksa);
                $('#saksi').html("Nama Saksi :" + data.nama_saksi);
                $('#kategori_terdakwa').html("Kategori :" + data.kategori);
                $('#perkara').html("Jenis Perkara :" + data.jenis_perkara);
                $('#tgl').html("Tanggal :" + data.tanggal);
                $('#modalKasus').modal('show');
                $('.modal-title').text('Detail Kasus');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function incrahft(id_kasus) {}
</script>
<?= $this->endsection(); ?>