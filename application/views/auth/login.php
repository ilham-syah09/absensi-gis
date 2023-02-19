<div class="card card-primary">

    <div class="card-body">
        <form method="post" action="<?= base_url('auth/proses'); ?>" id="form-login">
            <input type="hidden" class="csrf_token" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="row">
                <div class="form-group col-md">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md">
                    <label>Password</label>
                    <input type="password" class="form-control hide-pass" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input show-pass" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Show Password</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>