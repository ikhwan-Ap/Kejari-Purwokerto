<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Inchraft</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Inchraft</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="Incrahft" style="width:100%">
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



    <div class="modal fade" data-backdrop="false" role="dialog" id="modalIncraht">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body form_kasus">
                    <form action="" id="formIncraht" class="form-horizontal">
                        <div class="card-body Detail">
                            <div class="row">
                                <div class="col">
                                    <h6 id="nama">

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
                    </form>
                </div>


                <div class="modal-footer Foot">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
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
        table = $('#Incrahft').DataTable({
            "processing": true,
            "serverSide": true,
            'destroy': true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('incraht/get_incraht'); ?>",
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

    function btnDetail(id_kasus) {
        $('#formIncraht')[0].reset();
        $.ajax({
            url: "<?= site_url('incraht/get_id/'); ?>" + id_kasus,
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
                $('#modalIncraht').modal('show');
                $('.modal-title').text('Detail Data Incraht');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>
<?= $this->endsection(); ?>