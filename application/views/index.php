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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

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
                            <?php elseif ($this->session->userdata('log_user')) : ?>
                                <img alt="image" src="<?= base_url('uploads/profiles/' . $this->dt_user->image); ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?= $this->dt_user->name; ?></div>
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
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">PRESENSI KARYAWAN</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">PRS</a>
                    </div>
                    <ul class="sidebar-menu">


                        <!-- admin session -->
                        <?php if ($this->session->userdata('log_admin')) : ?>
                            <li class="<?= ($this->uri->segment(1) === "admin") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin'); ?>"><i class="fas fa-code"></i> <span>Dashboard</span></a></li>


                            <li class="menu-header">User</li>

                            <li class="<?= ($this->uri->segment(1) === "list-user") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('list-user'); ?>"><i class="fas fa-user-cog"></i> <span>List User</span></a></li>

                            <!-- end admin session -->


                            <!-- user session -->
                        <?php elseif ($this->session->userdata('log_user')) : ?>

                            <li class="menu-header">Dashboard</li>

                            <li class="<?= ($this->uri->segment(1) === "user") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('user'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>


                            <li class="menu-header">Admin</li>

                            <li class="<?= ($this->uri->segment(1) === "profile") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('profile'); ?>"><i class="fas fa-user"></i> <span>My Profile</span></a></li>

                            <!-- end user session -->

                        <?php endif; ?>

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">

                <?php $this->load->view($page); ?>

            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div><a href="#">Absensi Karyawan</a>
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
    <script src="<?= base_url(); ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/popper.js"></script>
    <script src="<?= base_url(); ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

    <script src="<?= base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url(); ?>assets/js/page/features-post-create.js"></script>
    <script src="<?= base_url(); ?>assets/js/page/modules-datatables.js"></script>
    <script src="<?= base_url(); ?>assets/js/page/modules-toastr.js"></script>

    <!-- tinymce -->
    <script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>

    <!-- jquery validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var sukses = $('.toastr-sukses').data('flashdata');
            var eror = $('.toastr-eror').data('flashdata');

            if (sukses) {
                iziToast.success({
                    title: 'Success',
                    message: sukses,
                    position: 'topRight'
                });
            }

            if (eror) {
                iziToast.error({
                    title: 'Error',
                    message: eror,
                    position: 'topRight'
                });
            }
        })

        // jquery validation
        $('#update_profile').validate({
            rules: {
                username: {
                    required: true,
                },
                name: {
                    required: true,
                },
                current_pass: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                retype_again: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                username: {
                    required: "Username lengkap tidak boleh kosong!",
                },
                name: {
                    required: "Nama tidak boleh kosong!",
                },
                current_pass: {
                    required: "Password harus diisi!",
                },
                password: {
                    required: "Password harus diisi!",
                    min_length: "Password harus berisi 6 karakter"
                },
                retype_again: {
                    required: "Password harus diisi!",
                    equalTo: "Password tidak sama!"
                },
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger');
                if (element.is(":radio")) {
                    error.appendTo('#jk');
                } else {
                    error.insertAfter(element);
                }
            },
            wrapper: 'span'
        });


        var tombol_submit = $('.btn-edit');

        $(tombol_submit).each(function(i) {
            $(tombol_submit[i]).click(function() {
                var id = $(this).data('id');
                var username = $(this).data('username');

                // gukar
                // var gukarId = $(this).data('gukarid');
                // var previmage = $(this).data('previmage');
                // var name = $(this).data('name');
                // var position = $(this).data('position');

                // testi
                // var testiid = $(this).data('testiid');
                // var badge = $(this).data('badge');
                // var comment = $(this).data('comment');

                // galery
                var galeryid = $(this).data('galeryid');

                $('#id').val(id);
                $('#username').val(username);

                // gukar
                // $('#gukar_id').val(gukarId);
                // $('#previmage').val(previmage);
                // $('#name').val(name);
                // $('#position').val(position);

                //testi
                // $('#testi_id').val(testiid);
                // $('#badge').val(badge);
                // $('#comment').val(comment);

                // galery
                $('#galery_id').val(galeryid);

            })
        });


        // tinymce.init({
        //     selector: '.editor',
        //     plugins: 'preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking toc insertdatetime advlist lists imagetools textpattern noneditable help quickbars emoticons code',
        //     toolbar: 'undo redo | bold italic underline strikethrough superscript subscript | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | image media link codesample | ltr rtl | code',
        //     toolbar_mode: 'sliding',
        // });

        tinymce.init({
            selector: "#tiny",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",
            automatic_uploads: true,
            image_advtab: true,
            images_upload_url: "<?php echo base_url("post/tinymce_upload") ?>",
            file_picker_types: 'image',
            paste_data_images: true,
            relative_urls: false,
            remove_script_host: false,
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'post-image-' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var blobInfo = blobCache.create(id, file, reader.result);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            }
        });
    </script>
</body>

</html>