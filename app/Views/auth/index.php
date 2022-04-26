<?= $this->extend('template/login') ?>
<?= $this->section('content_login'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <!-- <div class="login-brand">
                    <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div> -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
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
                                <button type="submit" id="login" onclick="btnLogin()" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    <div class="text-center mt-5 text-small">
                        Copyright &copy; <?= date('Y'); ?> | KEJARI PURWOKERTO - Kejaksaan Replubik Indonesia Purwokerto
                    </div>
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