<section class="section">
    <div class="section-header">

        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        </div>

    </div>
    <div class="section-body">
        <?php if (password_verify($this->dt_user->username, $this->dt_user->password)) : ?>
            <div class="alert alert-danger" role="alert">
                Anda masih menggunakan password default, segera ganti password anda dihalaman <a href="<?= base_url('profile'); ?>">My Profile</a>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>example</h4>
                        </div>
                        <div class="card-body">
                            content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>