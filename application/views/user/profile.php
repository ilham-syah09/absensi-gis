<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Hai, <?= $this->dt_user->name; ?></h2>
        <div class="alert alert-info" role="alert">
            Jika anda lupa password bisa hubungi Administrator penanggung jawab
        </div>
        <?php if (password_verify($this->dt_user->username, $this->dt_user->password)) : ?>
            <div class="alert alert-danger" role="alert">
                Anda belum mengganti password, segera ganti password anda!</a>
            </div>
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="text-center mt-2">
                            <img src="<?= base_url('uploads/profiles/' . $this->dt_user->image); ?>" alt="" width="200" class="img-fluid rounded-circle text-center">
                        </div>
                        <form method="post" action="<?= base_url('user/update_profile'); ?>" enctype="multipart/form-data" id="update_profile">
                            <!-- <input type="hidden" class="csrf_token" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>NISN</label>
                                        <input type="text" class="form-control" value="<?= $this->dt_user->username; ?>" name="username" readonly>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Fullname<span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" value="<?= $this->dt_user->name; ?>" name="name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Password<span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Retype Password<span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control" name="retype_again" id="retype_again">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Picture</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="text-center mt-2">
                            <img src="<?= base_url('uploads/profiles/' . $this->dt_user->image); ?>" alt="" width="200" class="img-fluid rounded-circle text-center">
                        </div>
                        <form method="post" action="<?= base_url('user/update_profile'); ?>" enctype="multipart/form-data" id="update_profile">
                            <input type="hidden" class="csrf_token" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?= $this->dt_user->username; ?>" name="username" readonly>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Fullname<span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" value="<?= $this->dt_user->name; ?>" name="name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md">
                                        <label>Current Password<span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control" name="current_pass" id="current_pass">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Password<span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Retype Password<span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control" name="retype_again" id="retype_again">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Picture</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>