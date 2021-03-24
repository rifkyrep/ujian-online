<?php

/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 15.11
 */
$siswa = $pdo->prepare("select ts.*,tk.nama_kelas from tb_kelas as tk INNER join tb_siswa as ts where ts.kelas=tk.id_kelas ORDER BY nama asc ");
$siswa->execute();

$tingkat = $pdo->prepare("select * from tb_tingkat");
$tingkat->execute();

$tingkat2 = $pdo->prepare("select * from tb_tingkat");
$tingkat2->execute();
?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        tampilkelas();
        loadkelas();
    })
</script>
<script>
    $(document).ready(function() {
        $('#tingkat').change(function() {
            tampilkelas();
        })
    });
    $(document).ready(function() {
        $('#tingkat_tambah').change(function() {
            loadkelas();
        })
    });
    $(document).ready(function() {
        $('#tingkat_edit').change(function() {
            loadkelas2();
        })
    });
</script>
<script>
    function loadkelas() {
        var id_tingkat = $('#tingkat_tambah').val();

        $.ajax({
            type: 'post',
            url: 'ajax/siswa/tampil_kelas.php',
            data: 'id_tingkat=' + id_tingkat,
            cache: false,
            success: function(e) {
                $('#kelas_tambah').html(e);
            }
        })
    }
</script>
<script>
    function loadkelas2() {
        var id_tingkat = $('#tingkat_edit').val();

        $.ajax({
            type: 'post',
            url: 'ajax/siswa/tampil_kelas.php',
            data: 'id_tingkat=' + id_tingkat,
            cache: false,
            success: function(e) {
                $('#kelas_edit').html(e);
            }
        })
    }
</script>
<script>
    $(document).ready(function() {
        $('#kelas').change(function() {
            tampilsiswa();
        })
    })
</script>
<script>
    function tampilkelas() {
        var id_tingkat = $('#tingkat').val();

        $.ajax({
            type: 'post',
            url: 'ajax/siswa/tampil_kelas.php',
            data: 'id_tingkat=' + id_tingkat,
            cache: false,
            success: function(e) {
                $('#kelas').html(e);
                tampilsiswa();
            }
        })
    }
</script>
<script>
    function tampilsiswa() {
        var id_kelas = $('#kelas').val();

        $.ajax({
            type: 'post',
            url: 'ajax/siswa/tampil_siswa.php',
            data: 'id_kelas=' + id_kelas,
            cache: false,
            success: function(e) {
                $('#siswa').html(e);
            }
        })
    }
</script>
<script>
    $(document).on('click', '#edit_siswa', function() {
        var id = $(this).data('id');
        var data = 'id=' + id;

        $.ajax({
            type: 'POST',
            url: 'ajax/siswa/edit.php',
            data: data,
            cache: false,
            success: function(e) {
                $('.data').html(e);
            }
        })
    });
</script>

<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Data Siswa</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button id="sample_editable_1_new" data-toggle="modal" data-target="#tambah" class="btn sbold blue"> Tambah Data
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="portlet box purple">
                                <div class="portlet-title">
                                    <div class="caption">Filter Data</div>
                                </div>
                                <div class="portlet-body">
                                    <form action="" class="form-horizontal" role="form">
                                        <label for="">Tingkat</label>
                                        <select class="form-control" name="" id="tingkat">
                                            <?php
                                            while ($rt = $tingkat->fetch()) {
                                            ?>
                                                <option value="<?php echo $rt['id_tingkat'] ?>"><?php echo $rt['keterangan'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <label for="">Kelas</label>
                                        <select class="form-control" name="" id="kelas">
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div id="siswa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div id="edit" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="data"></div>
                </div>
                <div class="modal-footer">
                    <button name="update" class="btn sbold blue">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div id="tambah" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required="">
                    </div>
                    <div class="form-group">
                        <label for="">NIS</label>
                        <input type="text" name="nis" class="form-control" placeholder="NIS" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <select name="tingkat" id="tingkat_tambah" class="form-control">
                            <?php
                            while ($rt = $tingkat2->fetch()) {
                            ?>
                                <option value="<?php echo $rt['id_tingkat'] ?>"><?php echo $rt['keterangan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="kelas" id="kelas_tambah" class="form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="simpan" class="btn sbold blue">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_GET['aktif'])) {
    $aktif = $_GET['aktif'];
    $status = 1;
    $q = $pdo->prepare('update tb_siswa set status=:stts where id_siswa=:aktif');
    $q->bindParam(':stts', $status);
    $q->bindParam(':aktif', $aktif);
    $q->execute();


    $nn = $pdo->prepare("select * from tb_siswa where id_siswa='$aktif'");
    $nn->execute();
    $r = $nn->fetch();
    $nis = $r['nis'];
    $md5nis = md5($nis);
    $level = 'siswa';
    $id_siswa = $r['id_siswa'];

    $qr = $pdo->prepare("insert into tb_user (username, password, level, user_id) VALUES (:usr,:pass,:lvl,:user_id)");
    $qr->bindParam(':usr', $nis);
    $qr->bindParam(':pass', $md5nis);
    $qr->bindParam(':lvl', $level);
    $qr->bindParam(':user_id', $id_siswa);
    $qr->execute();

    echo "<script>window.location='?page=data_siswa'</script>";
} elseif (isset($_POST['simpan'])) {
    # code...
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $status = 0;
    $ceknis = $pdo->prepare("select * from tb_siswa where nis='$nis'");
    $ceknis->execute();
    $count = $ceknis->rowCount();
    if ($count >= 1) {
        echo "<script>alert('Data Siswa Dengan NIS Tersebut Sudah Ada')</script>";
    } else {
        $query = $pdo->prepare("INSERT INTO tb_siswa (nama,nis,kelas,status) VALUES (:nama,:nis,:jurusan,:status)");
        $query->bindParam(':nama', $nama);
        $query->bindParam(':nis', $nis);
        $query->bindParam(':jurusan', $kelas);
        $query->bindParam(':status', $status);
        $query->execute();
        echo "<script>window.location='?page=data_siswa'</script>";
    }
} elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $q = $pdo->prepare("update tb_siswa set nama=:nama,kelas=:kelas where id_siswa=:id ");
    $q->bindParam(':nama', $nama);
    $q->bindParam(':kelas', $kelas);
    $q->bindParam(':id', $id);
    $q->execute();
    echo "<script>window.location='?page=data_siswa'</script>";
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $nis = $pdo->prepare("select * from tb_siswa where id_siswa=$id");
    $nis->execute();
    $r = $nis->fetch();
    $r_nis = $r['nis'];
    $r_id = $r['id_siswa'];

    $cek_nis = $pdo->prepare("select * from tb_user where username=$r_nis");
    $cek_nis->execute();
    $cek = $cek_nis->rowCount();

    $cek_ikut_ujian = $pdo->prepare("select * from set_ikut_ujian where id_siswa='$r_id'");
    $cek_ikut_ujian->execute();
    while ($cek_iu = $cek_ikut_ujian->fetch()) {
        $del_id = $cek_iu['id_siswa'];
        $qdel = $pdo->prepare("delete from set_ikut_ujian WHERE id_siswa='$del_id'");
        $qdel->execute();
    }

    if ($cek >= 1) {
        $q = $pdo->prepare("delete from tb_siswa where id_siswa=$id");
        $q->execute();
        $n = $pdo->prepare("delete from tb_user where username = $r_nis");
        $n->execute();
    } else {
        $q = $pdo->prepare("delete from tb_siswa where id_siswa=$id");
        $q->execute();
    }
    echo "<script>window.location='?page=data_siswa'</script>";
} elseif (isset($_GET['nonaktif'])) {
    $id_non = $_GET['nonaktif'];
    $status = 0;
    $q = $pdo->prepare("update tb_siswa set status=:stts WHERE id_siswa=:id_non");
    $q->bindParam(':stts', $status);
    $q->bindParam(':id_non', $id_non);
    $q->execute();

    $nis = $pdo->prepare("select * from tb_siswa where id_siswa=$id_non");
    $nis->execute();
    $r_nis = $nis->fetch();
    $nis_siswa = $r_nis['nis'];

    $q_del = $pdo->prepare("delete from tb_user where username='$nis_siswa'");
    $q_del->execute();
    echo "<script>window.location='?page=data_siswa'</script>";
} elseif (isset($_GET['reset_pass'])) {
    $id_reset = $_GET['reset_pass'];

    $a = $pdo->prepare("select * from tb_siswa where id_siswa='$id_reset'");
    $a->execute();
    $b = $a->fetch();
    $idsiswa = $b['id_siswa'];
    $nis = $b['nis'];
    $md5nyanis = md5($nis);
    $lvl = 'siswa';

    $c = $pdo->prepare("update tb_user set password=:md5nis where user_id=:idsiswa and level=:lvl");
    $c->bindParam(':md5nis', $md5nyanis);
    $c->bindParam(':idsiswa', $idsiswa);
    $c->bindParam(':lvl', $lvl);
    $c->execute();
    echo "<script>alert('Password berhasil direset')</script>";
    echo "<script>window.location='?page=data_siswa'</script>";
}
