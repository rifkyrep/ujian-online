<?php
session_start();
require_once './config/koneksi.php';
if (@$_SESSION['admin'] || @$_SESSION['guru'] || @$_SESSION['siswa']) {
    echo "<script>window.location='index.php'</script>";
}
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>MBi Ujian | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #3 for " name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<!-- END HEAD -->

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="#">
            <img src="assets/images/logo.png" alt="" style="height: 40px;" /> </a>
    </div>
    <!-- END LOGO -->

 
    <div class="modal modal-primary fade" id="baca" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Panduan</h2>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <p>Berikut panduan singkat penggunaan program ini :</p>
                            <ul>
                                <li>Aplikasi ini memiliki 3 level user dalam mengelola data, antara lain :</li>
                                <ol>
                                    <li><strong>Administrator</strong> : Mengelola data User(Guru & Siswa), semua data mapel, semua data soal, hasil ujian, dll.</li>
                                    <li><strong>Guru</strong> : Mengelola Data soal dan data ujian sesuai guru yang login.</li>
                                    <li><strong>Siswa</strong> : User yang berhak mengikuti Ujian yang sudah dibuat Guru.</li>
                                </ol>
                                <li>
                                    Halaman Login ini bisa dipakai login untuk 3 user (Administrator,Guru,dan Siswa) sekaligus, asal username dan password sudah benar.
                                </li>
                                <li>
                                    Login ke dalam aplikasi sebagai Administrator terlebih dahulu untuk menambah user (Siswa/Guru) di Data Siswa atau Data Guru.
                                </li>
                                <li>
                                    Setelah membuat user baru,aktifkan user tsb agar bisa digunakan untuk login kembali di halaman login ini.
                                </li>
                                <li>
                                    <strong><i>Username dan Password secara default sama dengan NIS atau NIP saat menambah user Siswa atau user Guru kemudian mengaktifkannya.</i></strong>
                                </li>
                            </ul>
                            <p>Username dan password untuk Administrator : Username : <strong>admin</strong>,Password : <strong>admin</strong>.</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="" class="" data-dismiss="modal"><input class="btn sbold blue" type="button" value="OK, Saya mengerti"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN LOGIN -->
    <div class="content">
        <?php
        if (isset($_POST['login'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            $q = $pdo->prepare("select * from tb_user where username='$user' and password=md5('$pass')");
            $q->execute();
            $row = $q->fetch();
            $cek = $q->rowCount();

            if ($cek >= 1) {
                if ($row['level'] == 'admin') {
                    $_SESSION['admin'] = $row['id_user'];
                    echo "<script>window.location='index.php'</script>";
                } elseif ($row['level'] == 'siswa') {
                    $_SESSION['siswa'] = $row['id_user'];
                    $_SESSION['nis'] = $row['username'];
                    echo "<script>window.location='index.php'</script>";
                } elseif ($row['level'] == 'guru') {
                    $_SESSION['guru'] = $row['id_user'];
                    $_SESSION['nip'] = $row['username'];
                    echo "<script>window.location='index.php'</script>";
                }
            } else {
                echo "<script>alert('Username atau Password Salah!!')</script>";
            }
        }
        ?>
        <!-- BEGIN LOGIN FORM -->
        <form class="" action="" method="post">
            <h3 class="form-title font-green">Login</h3>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="">Username</label>
                <input class="form-control" type="text" autocomplete="off" placeholder="Username" name="username" required />
            </div>
            <div class="form-group">
                <label class="">Password</label>
                <input class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" required/>
            </div>
                <button type="submit" name="login" class="btn green uppercase">Login</button>
                <button class="float-right btn btn-primary" type="button" data-target="#baca" data-toggle="modal">Petunjuk Program</button>
            <!-- <div class="login-options">
                <h4>Or login with</h4>
                <ul class="social-icons">
                    <li>
                        <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                    </li>
                </ul>
            </div> -->
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <!-- END FORGOT PASSWORD FORM -->
        <!-- BEGIN REGISTRATION FORM -->

        <!-- END REGISTRATION FORM -->
    </div>
    <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<script src="assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/login.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>