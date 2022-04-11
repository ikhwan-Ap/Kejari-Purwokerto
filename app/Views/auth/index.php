<?= $this->extend('template/login') ?>
<?= $this->section('content_login'); ?>
<section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
            <div class="p-4 m-3">
                <img src="<?= base_url(); ?>/assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Login Admin</span></h4>
                <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>
                <form action="#" class="form-horizontal" id="loginForm">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" tabindex="1">
                        <div class="invalid-feedback errorUsername">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2">
                        <div class="invalid-feedback errorPassword">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="showpass" class="custom-control-input" tabindex="3" id="showpass" onclick="myFunction()">
                            <label class="custom-control-label" for="showpass">Show Password</label>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" id="login" onclick="btnLogin()" class="btn btn-success btn-lg btn-icon icon-right" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-5 text-small">
                    Copyright &copy; <?= date('Y'); ?> | KEJARI PURWOKERTO - Kejaksaan Replubik Indonesia Purwokerto
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url(); ?>/assets/img/unsplash/login-bg.jpg">
            <div class="absolute-bottom-left index-2">
                <div class="text-light p-5 pb-2">
                    <div class="mb-5 pb-3">
                        <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
                        <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                    </div>
                    Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function btnLogin() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('auth/login'); ?>",
            data: $('#loginForm').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#login').prop('disabled', true);
                $('#login').html('Loading');
            },
            complete: function() {
                $('#login').prop('disabled', false);
                $('#login').html('Login');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorUsername) {
                        $('#username').addClass('is-invalid');
                        $('.errorUsername').html(data.errorUsername);
                    } else {
                        $('#username').removeClass('is-invalid');
                        $('#username').addClass('is-valid');
                    }
                    if (data.errorPassword) {
                        $('#password').addClass('is-invalid');
                        $('.errorPassword').html(data.errorPassword);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('#password').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Anda Berhasil Login`,
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace("<?= base_url('/dashboard'); ?>")
                        }
                    })
                }
                if (response.gagal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Username atau password salah',
                    })
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>