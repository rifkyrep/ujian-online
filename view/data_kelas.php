<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 11.17
 */
$kelas = $pdo->prepare("select tk.*,tt.keterangan from tb_tingkat as tt INNER join tb_kelas as tk where tk.id_tingkat=tt.id_tingkat");
$kelas->execute();

$tingkat = $pdo->prepare("select * from tb_tingkat");
$tingkat->execute();
?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).on('click','#edit_kelas',function () {
        var id = $(this).data('id');
        var data='id_kelas='+id;

        $.ajax({
            type:'post',
            url:'ajax/kelas/edit_kelas.php',
            data:data,
            cache:false,
            success:function (e) {
                $('.kelas').html(e);
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
                        <span class="caption-subject bold uppercase"> Data Kelas</span>
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
                            <th> Nama Kelas </th>
                            <th>Tingkatan</th>
                            <th> Pilihan </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        while ($row=$kelas->fetch()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_kelas'] ?></td>
                                <td>Kelas <?php echo $row['keterangan'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn blue" id="edit_kelas" data-target="#edit" data-id="<?php echo $row['id_kelas'] ?>" data-toggle="modal">
                                        <i class="icon-pencil"></i> Edit
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

<div id="edit" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Kelas</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="kelas"></div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn sbold blue" value="Simpan" name="update">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="tambah" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah kelas</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tingkatan</label>
                        <select name="tingkat" class="form-control" id="tingkat">
                            <?php
                            while($rt=$tingkat->fetch()){
                                ?>
                                <option value="<?php echo $rt['id_tingkat'] ?>"><?php echo $rt['keterangan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelasnya">Kelas</label>
                        <input type="text" name="kelas" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn sbold blue" name="simpan" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update'])){
    $nama = $_POST['kelas'];
    $id=$_POST['id'];
    $upd = $pdo->prepare("update tb_kelas set nama_kelas=:nama where id_kelas=:id ");
    $upd->bindParam(':nama',$nama);
    $upd->bindParam(':id',$id);
    $upd->execute();
    echo "<script>window.location='?page=data_kelas'</script>";
}elseif(isset($_POST['simpan'])){
    $kelas = $_POST['kelas'];
    $tingkat=$_POST['tingkat'];
    $ins = $pdo->prepare("insert into tb_kelas (nama_kelas, id_tingkat) VALUES (:nama,:tingkat)");
    $ins->bindParam(':nama',$kelas);
    $ins->bindParam(':tingkat',$tingkat);
    $ins->execute();
    echo "<script>window.location='?page=data_kelas'</script>";

}
