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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/components.css">
    <!-- Start GA -->

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
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <h3><?= $title; ?></h3>
                        </div>

                        <?= $this->session->flashdata('message'); ?>
                        <div class="toastr-sukses" data-flashdata="<?= $this->session->flashdata('toastr-sukses'); ?>"></div>
                        <div class="toastr-eror" data-flashdata="<?= $this->session->flashdata('toastr-eror'); ?>"></div>

                        <?php $this->load->view($page); ?>
                    </div>
                </div>
            </div>
        </section>
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
    <script src="<?= base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url(); ?>assets/js/page/auth-register.js"></script>
    <script src="<?= base_url(); ?>assets/js/page/modules-toastr.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
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

        $('.show-pass').click(function() {
            if ($(this).is(':checked')) {
                $('.hide-pass').attr('type', 'text');
            } else {
                $('.hide-pass').attr('type', 'password');
            }
        });

        $('#form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email harus diisi!",
                    email: "Format email salah!"
                },
                password: {
                    required: "Password harus diisi!",
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('arrow text-danger');
                label.insertAfter(element);
            },
            wrapper: 'span'
        });

        $('#form-register').validate({
            rules: {
                nama_lengkap: {
                    required: true,
                },
                tempat_lahir: {
                    required: true,
                },
                tanggal_lahir: {
                    required: true,
                },
                jenis_kelamin: {
                    required: true,
                },
                asal_sekolah: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                no_handphone: {
                    required: true,
                    number: true,
                    maxlength: 13,
                },
                alamat: {
                    required: true,
                },
                jurusan: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                password_again: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                nama_lengkap: {
                    required: "Nama lengkap tidak boleh kosong!",
                },
                tempat_lahir: {
                    required: "Tempat lahir tidak boleh kosong!",
                },
                tanggal_lahir: {
                    required: "Tanggal lahir tidak boleh kosong!",
                },
                jenis_kelamin: {
                    required: "Jenis kelamin tidak boleh kosong!",
                },
                asal_sekolah: {
                    required: "Asal sekolah tidak boleh kosong!",
                },
                email: {
                    required: "Email harus diisi!",
                    email: "Format email salah!"
                },
                no_handphone: {
                    required: "No Handphone tidak boleh kosong!",
                    number: "No Handphone hanya diisi dengan angka!",
                    maxlength: "Maksimal no handphone 13 karakter"
                },
                jurusan: {
                    required: "Jurusan tidak boleh kosong!",
                },
                alamat: {
                    required: "Alamat tidak boleh kosong!",
                },
                password: {
                    required: "Password harus diisi!",
                    min_length: "Password harus berisi 6 karakter"
                },
                password_again: {
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
    </script>
</body>

</html>