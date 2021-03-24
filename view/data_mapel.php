<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 15.11
 */
$query = $pdo->prepare("select * from tb_mapel order by nama");
$query->execute();

?>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).on('click','#edit_mpl',function () {
            var id = $(this).data('id');
            var data = 'id='+id;

            $.ajax({
                type: 'POST',
                url: 'ajax/mapel/edit.php',
                data: data,
                cache: false,
                success: function (e){
                    $('.data').html(e);
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
                        <span class="caption-subject bold uppercase"> Data Mata Pelajaran</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button data-target="#tambah" data-toggle="modal" id="sample_editable_1_new" class="btn sbold blue"> Tambah Data
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
                            <th> Pilihan </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        while ($row=$query->fetch()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td>
                                    <a href="" class="btn btn-sm btn blue" id="edit_mpl" data-target="#edit" data-id="<?php echo $row['id_mapel'] ?>" data-toggle="modal">
                                        <i class="icon-pencil"></i> Edit
                                    </a>
                                    <a onclick="return confirm('Yakin ingin menghapus??')" href="?page=data_mapel&delete=<?php echo $row['id_mapel'] ?>" class="btn btn-sm btn red">
                                        <i class="icon-trash"></i> Hapus
                                    </a>
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
                        <label for="">Nama Mapel</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn sbold blue" name="simpan">Simpan</button>
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
                    <button name="update" class="btn sbold blue">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div id="edit_mapel" class="modal modal-primary fade" role="dialog">
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

<?php
if (isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $query = $pdo->prepare("insert into tb_mapel (nama) VALUES (:nama)");
    $query->bindParam(':nama',$nama);
    $query->execute();
    echo "<script>window.location='?page=data_mapel'</script>";
}elseif(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = $pdo->prepare("update tb_mapel set nama=:nama where id_mapel=:id");
    $query->bindParam(':nama',$nama);
    $query->bindParam(':id',$id);
    $query->execute();
    echo "<script>window.location='?page=data_mapel'</script>";
}elseif(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $q = $pdo->prepare("select * from set_mapel_guru where id_mapel='$id'");
    $q->execute();

    $mapel = $pdo->prepare("select * from tb_soal where id_mapel='$id'");
    $mapel->execute();

    $set_ujian = $pdo->prepare("select * from set_ujian where id_mapel='$id'");
    $set_ujian->execute();

    while ($row_mapel = $mapel->fetch()){
        $idnya = $row_mapel['id_mapel'];
        $del_mapel = $pdo->prepare("delete from tb_soal where id_mapel='$idnya'");
        $del_mapel->execute();
    }

    while ($r_mapel = $q->fetch()){
        $id_m = $r_mapel['id_mapel'];
        $m = $pdo->prepare("delete from set_mapel_guru where id_mapel='$id_m'");
        $m->execute();
    }

    while ($r_su = $set_ujian->fetch()){
        $idmapel = $r_su['id_mapel'];
        $idujian = $r_su['id'];
        $cek_ikut = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$idujian'");
        $cek_ikut->execute();
        while($rcek = $cek_ikut->fetch()){
            $iduji = $rcek['id_ujian'];
            $delete = $pdo->prepare("delete from set_ikut_ujian where id_ujian='$iduji'");
            $delete->execute();
        }
        $del = $pdo->prepare("delete from set_ujian where id='$idujian'");
        $del->execute();
    }

    $querydel = $pdo->prepare("delete from tb_mapel where id_mapel='$id'");
    $querydel->execute();
    echo "<script>window.location='?page=data_mapel'</script>";
}