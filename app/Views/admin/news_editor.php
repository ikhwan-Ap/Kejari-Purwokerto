<?= $this->extend('template/admin') ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Editor</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Moduls</div>
            <div class="breadcrumb-item">Editor</div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="section-body" id="appBerita">
        <div class="card-header">
            <h4>Halaman Kreasi Berita</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" v-model="judul">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penulis</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" v-model="penulis">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Berita</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Unggah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pilih Gambar</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" class="dropzone" id="mydropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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

<?= $this->endsection(); ?>