<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

    <script src="<?= base_url(); ?>assets/modules/jquery.min.js"></script>
</head>

<body>
    <div class="toastr-sukses" data-flashdata="<?= $this->session->flashdata('toastr-sukses'); ?>"></div>
    <div class="toastr-eror" data-flashdata="<?= $this->session->flashdata('toastr-eror'); ?>"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <?php if ($this->session->userdata('log_admin')) : ?>
                                <img alt="image" src="<?= base_url('uploads/profiles/' . $this->dt_admin->image); ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?= $this->dt_admin->name; ?></div>
                            <?php elseif ($this->session->userdata('log_pegawai')) : ?>
                                <img alt="image" src="<?= base_url('uploads/profiles/' . $this->dt_pegawai->image); ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?= $this->dt_pegawai->nama; ?></div>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('profile'); ?>" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <?php $this->load->view($navbar); ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?php $this->load->view($page); ?>
            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div><a href="#">Presensi Karyawan</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- logout modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ALERT!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Kamu akan meninggalkan halaman ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>assets/modules/popper.js"></script>
    <script src="<?= base_url(); ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script src="<?= base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

    <!-- tinymce -->
    <script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var sukses = $('.toastr-sukses').data('flashdata');
            var eror = $('.toastr-eror').data('flashdata');

            if (sukses) {
                iziToast.success({
                    title: 'Sukses',
                    message: sukses,
                    position: 'topRight'
                });
            }

            if (eror) {
                iziToast.error({
                    title: 'Gagal',
                    message: eror,
                    position: 'topRight'
                });
            }

            $('#example').DataTable();
        });
    </script>
</body>

</html>