<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Registrasi Pasien Baru</h4>
                </div>
                <div class="card-body">

                    <?php Flasher::flash(); ?>

                    <form action="<?= BASEURL; ?>/auth/prosesRegister" method="post">

                        <h6 class="text-muted mb-3">Informasi Akun (Login)</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-muted mb-3">Data Pribadi Pasien</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Identitas (NIK/KTP)</label>
                                <input type="number" name="nik" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" selected disabled>Pilih...</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon / WA</label>
                                <input type="number" name="no_hp" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Pernikahan</label>
                            <select name="status_pernikahan" class="form-select" required>
                                <option value="" selected disabled>Pilih Status...</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Daftar Sekarang</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <small>Sudah punya akun? <a href="<?= BASEURL; ?>/auth">Login disini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>