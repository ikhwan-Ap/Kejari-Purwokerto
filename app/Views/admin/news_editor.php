<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<?php
$date = date('Y-m-d');
$arr = explode("-", $date);
$tgl = $arr[2];
$mon = date('F');
$year = $arr[0];
?>

<section class="section">
    <div class="section-header">
        <h1>Berita</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Berita</div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="section-body" id="appBerita">
        <div class="card-header">
            <h4>Halaman Kreasi Berita</h4>
        </div>
        <div class="row">
            <div class="col-12 " title="halo">
                <div class="card">
                    <?php echo form_open_multipart('', ['id' => 'formBerita']); ?>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="tanggal" value="<?= $date ?>"></div>
                                <p><?= $tgl . ' ' . $mon . ' ' . $year ?></p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" v-model="judul" id="judul_berita">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Berita</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" id="text"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="card" style="left: 25%;">
                                <div class="card-header">
                                    <h4>Pilih Gambar</h4>
                                </div>
                                <div class="card-body">
                                    <div action="#" class="dropzone" id="mydropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple id="img_berita" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary" id="btnSave" onclick="save()" >Unggah</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Preview</h5>
                    </div>
                    <div class="card-body">
                        <div class="preview">
                            <div class="judul">
                                <h1 v-text="judul"></h1>
                            </div>
                            <div class="gambar-berita">
                            </div>
                            <div class="penulis">
                                <h5 v-text="penulis"></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page Specific JS File -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="<?= base_url(); ?>/assets/js/dropzone.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/page/components-multiple-upload.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote-simple').summernote({
            height: "300px",
            styleWithSpan: false
        });
    });
    const artikel = {
        judul: 'Tulis Judul Berita',
        penulis: 'Nama Berita'

    }
    const art = new Vue({
        el: '#appBerita',
        data: artikel
    })
</script>
<script>
    $(document).ready(function(){
        var save_method;
        
        function addberita() {
            save_method = 'add';
            $('#formBerita')[0].reset();
        }
        
        function save() {
            let form = $('#formBerita')[0];
            let data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "<?= site_url('buron/tambah_berita'); ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
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
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `Data Berhasil Di tambahkan`,
                        }).then((result) => {
                            if (result.value) {
                                $('#modalBerita').modal('hide');
                                $('#filterJenis').val("");
                                reload_table();
                                reset();
                            }
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }
    
    })

</script>
<?= $this->endsection(); ?>