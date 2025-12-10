<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login Aplikasi GERD</h3>

                    <?php Flasher::flash(); ?>

                    <form action="<?= BASEURL; ?>/auth/login" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <small>Belum punya akun? <a href="<?= BASEURL; ?>/auth/register">Daftar disini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>