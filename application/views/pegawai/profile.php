<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-10">
                <?php if (password_verify('pegawai123', $this->dt_pegawai->password)) : ?>
                    <div class="alert alert-danger" role="alert">Anda masih menggunakan password default, segera ganti password anda untuk keamanan!</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header justify-content-center bg-primary text-white">
                        <h4>Profile Anda</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center mb-3">
                                <img src="<?= base_url('uploads/profiles/') . $this->dt_pegawai->image; ?>" alt="Image Profile" class="img-thumbnail" width="200">
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white mb-2">
                                    <span>Nama - <?= $this->dt_pegawai->nama; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white mb-2">
                                    <span>NIP - <?= $this->dt_pegawai->nip; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white">
                                    <span>Email - <?= $this->dt_pegawai->email; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header justify-content-center bg-primary">
                        <h4 class="text-white">Setting</h4>
                    </div>
                    <div class="card-body">
                        <?php if (password_verify('pegawai123', $this->dt_pegawai->password)) : ?>
                            <form action="<?= base_url('pegawai/profile/updateOldProfile'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="previmage" value="<?= $this->dt_pegawai->image; ?>">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confpwd" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>
                        <?php else : ?>
                            <form action="<?= base_url('pegawai/profile/updateNewProfile'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="previmage" value="<?= $this->dt_pegawai->image; ?>">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="curpwd" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confpwd" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>