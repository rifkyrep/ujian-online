<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 14.47
 */
?>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).on('click','#edit_profil',function(){
            var id = $(this).data('id');
            var data = 'id='+id;

            $.ajax({
                type: 'POST',
                url: 'ajax/user/edit_pass.php',
                data: data,
                cache: false,
                success: function(e){
                    $('#editpass').html(e);
                }
            })
        })
    </script>

    <div id="editprofil" class="modal modal-primary fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ganti Password</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div id="editpass"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn blue" name="simpanpassword" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editfoto" class="modal modal-primary fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ubah Foto Profil</h4>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width:250px;height: 250px;"></div>
                            <div class="fileinput-preview fileinput-exist thumbnail" style="max-width: 300px;max-height: 300px;line-height: 10px;"></div>
                            <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new">Pilih Gambar</span>
                                        <span class="fileinput-exists">Ganti</span>
                                        <input type="hidden" name="...">
                                        <input type="file" name="foto">
                                    </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn blue" name="simpanpassword" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
if (isset($_POST['simpanpassword'])){
    $iduser = $_POST['id_user'];
    $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $md5passlama = md5($pass_lama);
    $md5passbaru = md5($pass_baru);

    $cek_pass_lama = $pdo->prepare("select * from tb_user where id_user='$iduser' and password='$md5passlama'");
    $cek_pass_lama->execute();
    $ccpl = $cek_pass_lama->rowCount();
    if ($ccpl<1){
        echo "<script>alert('Password Gagal diperbarui!! Password lama tidak sesuai!!')</script>";
    }else{
        $upd = $pdo->prepare("update tb_user set password=:pass_baru where id_user=:id");
        $upd->bindParam(':pass_baru',$md5passbaru);
        $upd->bindParam(':id',$iduser);
        $upd->execute();
        echo "<script>alert('Password berhasil diperbarui')</script>";
        echo "<script>window.location='index.php'</script>";
    }
}

if (isset($_SESSION['admin'])) {
    $id_user = $_SESSION['admin'];
    ?>
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="logo" class="logo-default">
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN TODO DROPDOWN -->

                    <!-- END TODO DROPDOWN -->

                    <!-- BEGIN INBOX DROPDOWN -->

                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="assets/images/admin.jpg" style="width: 41.5px;height: 41.5px">
                            <span class="username username-hide-mobile"><strong>
                                <?php echo isset($_SESSION['siswa']) || isset($_SESSION['guru']) ? $u['nama'] : strtoupper($u['username']) ?>
                            </strong></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a id="edit_profil" data-id="<?php echo $id_user ?><!--" data-target="#editprofil" data-toggle="modal" href="#">
                                   <i class="icon-key"></i> Ganti Password </a>
                            </li>
                            <li>
                                <a onclick="return confirm('Yakin ingin keluar?')" href="logout.php?page=profil">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'dashboard' || @$_GET['page'] == '' ? 'active' : '' ?> ">
                        <a href="?page=dashboard"> Dashboard
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown  <?php echo @$_GET['page'] == 'data_kelas' ? 'active' : '' ?>">
                        <a href="?page=data_kelas"> Data Kelas
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'data_siswa' ? 'active' : '' ?>  ">
                        <a href="?page=data_siswa"> Data Siswa
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'data_guru' ? 'active' : '' ?>">
                        <a href="?page=data_guru"> Data Guru
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown  <?php echo @$_GET['page'] == 'data_mapel' ? 'active' : '' ?>">
                        <a href="?page=data_mapel"> Data Mapel
                        </a>
                    </li>
                    <!--<li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php /*echo @$_GET['page'] == 'soal' ? 'active' : '' */?>">
                        <a href="?page=soal"> Soal
                        </a>
                    </li>-->
                    <!--<li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php /*echo @$_GET['page'] == 'hasil' ? 'active' : '' */?>">
                        <a href="?page=hasil"> Hasil Ujian
                        </a>
                    </li>-->
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <?php
}elseif(isset($_SESSION['guru'])) {
    $id_user = $_SESSION['guru'];
    ?>
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="logo" class="logo-default">
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN TODO DROPDOWN -->

                    <!-- END TODO DROPDOWN -->

                    <!-- BEGIN INBOX DROPDOWN -->

                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="assets/layouts/layout3/img/avatar9.jpg" style="width: 40px;height: 40px">
                            <span class="username username-hide-mobile"><strong>
                                <?php echo isset($_SESSION['siswa']) || isset($_SESSION['guru']) ? $u['nama'] : strtoupper($u['username']) ?>
</strong></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a id="edit_profil" data-id="<?php echo $id_user ?>" data-target="#editprofil" data-toggle="modal" href="#">
                                    <i class="icon-key"></i> Ganti Password </a>
                            </li>
<!--                            <li>-->
<!--                                <a id="edit_foto" data-id="--><?php //echo $id_user ?><!--" data-target="#editfoto" data-toggle="modal" href="#">-->
<!--                                    <i class="icon-user"></i> Ubah Foto </a>-->
<!--                            </li>-->
                            <li>
                                <a onclick="return confirm('Yakin ingin keluar?')"  href="logout.php?page=profil">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'dashboard' || @$_GET['page'] == '' ? 'active' : '' ?> ">
                        <a href="?page=dashboard"> Dashboard
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'soal' ? 'active' : '' ?>">
                        <a href="?page=soal"> Soal
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'ujian' ? 'active' : '' ?>">
                        <a href="?page=ujian"> Ujian
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'hasil' ? 'active' : '' ?>">
                        <a href="?page=hasil"> Hasil Ujian
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
<?php
}elseif(isset($_SESSION['siswa'])){
    $id_user = $_SESSION['siswa'];
    ?>
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="logo" class="logo-default">
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN TODO DROPDOWN -->

                    <!-- END TODO DROPDOWN -->

                    <!-- BEGIN INBOX DROPDOWN -->

                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="assets/layouts/layout3/img/avatar9.jpg">
                            <span class="username username-hide-mobile"><strong>
                                <?php echo isset($_SESSION['siswa']) || isset($_SESSION['guru']) ? $u['nama'] : strtoupper($u['username']) ?>
</strong></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a id="edit_profil" data-id="<?php echo $id_user ?>" data-target="#editprofil" data-toggle="modal" href="#">
                                    <i class="icon-key"></i> Ganti Password </a>
                            </li>
                            <!-- <li>
                                <a id="edit_foto" data-id="--><?php //echo $id_user ?><!--" data-target="#editfoto" data-toggle="modal" href="#">
                                    <i class="icon-user"></i> Ubah Foto </a>
                            </li> -->
                            <li>
                                <a onclick="return confirm('Yakin ingin keluar?')"  href="logout.php?page=profil">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'dashboard' || @$_GET['page'] == '' ? 'active' : '' ?> ">
                        <a href="?page=dashboard"> Dashboard
                        </a>
                    </li>
                    <li aria-haspopup="true"
                        class="menu-dropdown classic-menu-dropdown <?php echo @$_GET['page'] == 'ujian' ? 'active' : '' ?>">
                        <a href="?page=ujian"> Ujian
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
<?php
}

