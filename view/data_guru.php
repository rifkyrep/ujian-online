<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 15.11
 */
$guru = $pdo->prepare("select * from tb_guru order by nama asc");
$guru->execute();

?>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).on('click','#edit_guru',function(){
            var id = $(this).data('id');
            var data = 'id='+id;

            $.ajax({
                type: 'POST',
                url: 'ajax/guru/edit.php',
                data: data,
                cache: false,
                success: function(e){
                    $('.data').html(e);
                }
            })
        })
        </script>
        <script>
        $(document).on('click','#edit_mapel',function(){
            var id = $(this).data('id_guru');
            var data = 'id='+id;

            $.ajax({
                type: 'POST',
                url: 'ajax/guru/mapel.php',
                data: data,
                cache: false,
                success: function (e) {
                    $('.mapel_data').html(e);
                }
            })
        })
         </script>
        <script>
            $(document).on('click','#tambah_mapel',function(){
                var id = $(this).data('id_guru');
                var data = 'id_tambah='+id;

                $.ajax({
                    type: 'POST',
                    url: 'ajax/guru/mapel.php',
                    data: data,
                    cache: false,
                    success: function (e) {
                        $('.mapel_tambah').html(e);
                    }
                })
            })
        </script>
    


<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Data Guru</span>
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
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> NIP </th>
                            <th> Pilihan </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        while ($row = $guru->fetch()) {
                            ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $no++ ?> </td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['nip'] ?></td>
                                <td class="center">
                                    <a href="" class="btn btn-sm btn blue" id="edit_guru" data-target="#edit" data-id="<?php echo $row['id_guru'] ?>" data-toggle="modal">
                                        <i class="icon-pencil"></i> Edit
                                    </a>
                                    <a href="?page=data_guru&delete=<?php echo $row['id_guru'] ?>" class="btn btn-sm btn red" onclick="return confirm('Yakin ingin hapus data ini??')">
                                        <i class="icon-trash"></i> Hapus
                                    </a>
                                    <a href="" class="btn btn-sm btn green" id="edit_mapel" data-target="#mapel" data-id_guru="<?php echo $row['id_guru'] ?>" data-toggle="modal">
                                        <i class="icon-eye"></i> Mapel Diampu
                                    </a>
                                    <a href="" class="btn btn-sm btn purple" id="tambah_mapel" data-target="#tambahmapel" data-id_guru="<?php echo $row['id_guru'] ?>" data-toggle="modal">
                                        <i class="icon-plus"></i> Tambah Mapel
                                    </a>
                                    <?php
                                    if ($row['status']=='0'){
                                        ?>
                                        <a href="?page=data_guru&aktif=<?php echo $row['id_guru'] ?>" onclick="return confirm('Yakin ingin mengaktifkan user ini,Username dan Password default sama dengan NIP')" class="btn btn-sm btn purple">
                                            <i class="icon-user-following"></i> Aktifkan User
                                        </a>
                                    <?php
                                    }else{
                                        ?>
                                        <a href="?page=data_guru&nonaktif=<?php echo $row['id_guru'] ?>" class="btn btn-sm btn red" onclick="return confirm('Yakin ingin menonaktifkan??')">
                                            <i class="icon-user-unfollow"></i> Non-Aktifkan User
                                        </a>
                                        <a onclick="return confirm('Yakin ingin mereset password?? Password akan sama dengan NIP!!')" href="?page=data_guru&reset_pass=<?php echo $row['id_guru'] ?>" class="btn btn-sm btn yellow">
                                            <i class="icon-shuffle"></i> Reset Password
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }   
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<!-- Modal Tambah Guru -->
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
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">NIP</label>
                        <input type="text" name="nip" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn blue" name="simpan" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal Tambah Mapel Guru -->
    <div id="tambahmapel" class="modal modal-primary fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mapel Guru</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mapel_tambah"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn blue" name="simpan_mapel_guru" value="Simpan">
                    </div>
                </form>
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
                    <button type="submit" name="update" class="btn sbold blue">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Set Mapel -->
<div id="mapel" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mata Pelajaran</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mapel_data"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['aktif'])){
    $aktif = $_GET['aktif'];
    $status = 1;
    $q = $pdo->prepare("update tb_guru set status=:stts where id_guru=:aktif");
    $q->bindParam(':stts',$status);
    $q->bindParam(':aktif',$aktif);
    $q->execute();

    $ng = $pdo->prepare("select * from tb_guru where id_guru=$aktif");
    $ng->execute();
    $r = $ng->fetch();
    $nip = $r['nip'];
    $md5nip = md5($nip);
    $level = 'guru';
    $aidiguru = $r['id_guru'];

    $qr = $pdo->prepare("insert into tb_user (username, password, level, user_id) VALUES (:usr,:pass,:lvl,:id_guru)");
    $qr->bindParam(':usr',$nip);
    $qr->bindParam(':pass',$md5nip);
    $qr->bindParam(':lvl',$level);
    $qr->bindParam(':id_guru',$aidiguru);
    $qr->execute();

    echo "<script>window.location='?page=data_guru'</script>";
}elseif(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $status = 0;
    $ceknip = $pdo->prepare("select * from tb_guru where nip='$nip'");
    $ceknip->execute();
    $count = $ceknip->rowCount();
    if ($count>=1){
        echo "<script>alert('Data Guru Dengan NIP Tersebut Sudah Ada')</script>";
    }else {
        $q = $pdo->prepare("INSERT INTO tb_guru (nip, nama, status) VALUES (:nip,:nama,:status)");
        $q->bindParam(':nip', $nip);
        $q->bindParam(':nama', $nama);
        $q->bindParam(':status', $status);
        $q->execute();
        echo "<script>window.location='?page=data_guru'</script>";
    }
}elseif (isset($_GET['nonaktif'])){
    $id_non = $_GET['nonaktif'];
    $status = 0;
    $q = $pdo->prepare("update tb_guru set status=:stts where id_guru=:id_non");
    $q->bindParam(':stts',$status);
    $q->bindParam(':id_non',$id_non);
    $q->execute();

    $nip = $pdo->prepare("select * from tb_guru where id_guru=$id_non");
    $nip->execute();
    $r_nip = $nip->fetch();
    $nip_guru = $r_nip['nip'];

    $q_del = $pdo->prepare("delete from tb_user where username='$nip_guru'");
    $q_del->execute();
    echo "<script>window.location='?page=data_guru'</script>";
}elseif(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];

    $q = $pdo->prepare("update tb_guru set nama=:nama where id_guru=:id");
    $q->bindParam(':nama',$nama);
    $q->bindParam(':id',$id);
    $q->execute();
    echo "<script>window.location='?page=data_guru'</script>";
}elseif (isset($_GET['delete'])){
    $id = $_GET['delete'];

    //Delete from tb guru
    $nip = $pdo->prepare("select * from tb_guru where id_guru='$id'");
    $nip->execute();
    $r = $nip->fetch();
    $r_nip = $r['nip'];

    //Delete from tb soal / Hapus Soal id guru di tb soal
    $guru = $pdo->prepare("select * from tb_soal where id_guru='$id'");
    $guru->execute();
    $cek_guru = $guru->rowCount();

    $cek_nip = $pdo->prepare("select * from tb_user where username='$r_nip'");
    $cek_nip->execute();
    $cek = $cek_nip->rowCount();

    $cek_mapelnya = $pdo->prepare("select * from set_mapel_guru where id_guru='$id'");
    $cek_mapelnya->execute();
    $cek_mapel_guru = $cek_mapelnya->rowCount();

    $cek_ujian = $pdo->prepare("select * from set_ujian where id_guru='$id'");
    $cek_ujian->execute();
    $count_ujian = $cek_ujian->rowCount();

    if ($cek >= 1 || $cek_guru >= 1 || $cek_mapel_guru >= 1 || $count_ujian >=1){
        while ($row_del = $guru->fetch()){
            $idnya = $row_del['id_guru'];
            $del = $pdo->prepare("delete from tb_soal where id_guru='$idnya'");
            $del->execute();
        }

        while ($res = $cek_mapelnya->fetch()){
            $idguru = $res['id_guru'];
            $del_mapel = $pdo->prepare("delete from set_mapel_guru where id_guru='$idguru'");
            $del_mapel->execute();
        }

        while ($r_ujian = $cek_ujian->fetch()){
            $idujian = $r_ujian['id'];
            $idguru = $r_ujian['id_guru'];
            $set_ikut_ujian = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$idujian'");
            $set_ikut_ujian->execute();
            $csiu = $set_ikut_ujian->rowCount();
            if ($csiu>=1){
                while($rid = $set_ikut_ujian->fetch()){
                    $idhapus = $rid['id_ujian'];
                    $del = $pdo->prepare("delete from set_ikut_ujian where id_ujian='$idhapus'");
                    $del->execute();
                }
            }
            $hapus = $pdo->prepare("delete from set_ujian where id_guru='$idguru'");
            $hapus->execute();
        }
        $del = $pdo->prepare("delete from tb_guru where id_guru='$id'");
        $del->execute();
        $del_user = $pdo->prepare("delete from tb_user where username='$r_nip'");
        $del_user->execute();
        echo "<script>window.location='?page=data_guru'</script>";
    }else{
        $del = $pdo->prepare("delete from tb_guru where id_guru='$id'");
        $del->execute();
        echo "<script>window.location='?page=data_guru'</script>";
    }
}elseif(isset($_POST['simpan_mapel'])) {
    $counter = count(@$_POST['mapel']);
    for ($i = 0; $i <= $counter; $i++) {
        $mapel = $_POST['mapel'][$i];
        $id_guru = $_POST['id'][$i];
        if (isset($mapel)){
            $a = $pdo->prepare("select * from set_mapel_guru where id_guru=$id_guru and id_mapel=$mapel");
            $a->execute();
            $cek_a = $a->rowCount();

            if($cek_a<1){
                $query = $pdo->prepare("insert into set_mapel_guru (id_guru, id_mapel) VALUES (:id_guru,:id_mapel)");
                $query->bindParam(':id_guru',$id_guru);
                $query->bindParam(':id_mapel',$mapel);
                $query->execute();
                echo "<script>window.location='?page=data_guru'</script>";
            }else{
                $uncek = $pdo->prepare("select * from set_mapel_guru where id_guru=$id_guru and id_mapel not in($mapel)");
                $uncek->execute();
                $cek_uncek = $uncek->rowCount();

                if ($cek_uncek > 0 ){
                    $kueri = $pdo->prepare("delete from set_mapel_guru where id_guru=$id_guru and id_mapel not in($mapel)");
                    $kueri->execute();
                    echo "<script>window.location='?page=data_guru'</script>";
                }
            }

        }
    }
}elseif(isset($_GET['reset_pass'])){
    $id_reset = $_GET['reset_pass'];

    $a = $pdo->prepare("select * from tb_guru where id_guru='$id_reset'");
    $a->execute();
    $b = $a->fetch();
    $idgur = $b['id_guru'];
    $md5nip = md5($b['nip']);
    $lvl = 'guru';

    $c = $pdo->prepare("update tb_user set password=:md5nip where user_id=:idgur and level=:lvl");
    $c->bindParam(':md5nip',$md5nip);
    $c->bindParam(':idgur',$idgur);
    $c->bindParam(':lvl',$lvl);
    $c->execute();
    echo "<script>alert('Password berhasil direset')</script>";
    echo "<script>window.location='?page=data_guru'</script>";
}elseif (isset($_GET['delete_guru']) and isset($_GET['delete_mapel'])){
    $id_guru = $_GET['delete_guru'];
    $id_mapel = $_GET['delete_mapel'];
    $delete = $pdo->prepare("delete from set_mapel_guru where id_guru='$id_guru' and id_mapel='$id_mapel'");
    $delete->execute();
    echo "<script>window.location='?page=data_guru'</script>";
}elseif (isset($_POST['simpan_mapel_guru'])){
    $id_guru = $_POST['guru_ampu'];
    $id_mapel = $_POST['mapel_ampu'];
    $cek = $pdo->prepare("select * from set_mapel_guru WHERE id_mapel='$id_mapel' and id_guru='$id_guru'");
    $cek->execute();
    $rcek = $cek->rowCount();
    if ($rcek>=1){
        echo "<script>alert('Mapel sudah dipakai')</script>";
    }else{
        $query = $pdo->prepare("insert into set_mapel_guru (id_guru, id_mapel) VALUES (:idguru,:idmapel)");
        $query->bindParam(':idguru',$id_guru);
        $query->bindParam(':idmapel',$id_mapel);
        $query->execute();
        echo "<script>window.location='?page=data_guru'</script>";
    }
}

