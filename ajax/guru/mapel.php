<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 25/06/2017
 * Time: 13.55
 */
require_once '../../config/koneksi.php';
if (isset($_POST['id'])){
$id_guru = $_POST['id'];

/*function cekmapel($id_mapel)
{
    try {
        $pdo = new PDO('mysql:dbname=uji_aja;host=localhost', 'root', '');
    } catch (PDOException $pesan) {
        die($pesan->getMessage());
    }

    $id_guru = $_POST['id'];
    $query = $pdo->prepare("select * from set_mapel_guru where id_guru='$id_guru'");
    $query->execute();

    for ($i = 1; $i <= $query->rowCount(); $i++) {
        while ($rw = $query->fetch()) {
            if ($rw['id_mapel'] == $id_mapel) {
                return 'checked';
            } else {
                return '';
            }
        }
    }
}*/

/*
$mapel = $pdo->prepare("select * from tb_mapel order by nama asc");
$mapel->execute();
*/
?><!--
<div class="row">
    <input type="hidden" value="<?php /*echo $id_guru */
?>" name="id_cek">
    <?php
/*        while ($row = $mapel->fetch()) {
            $q = $pdo->prepare("select * from set_mapel_guru where id_guru=$id_guru");
            $q->execute();
            */
?>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="mt-checkbox-list">
                        <input type="hidden" name="id[]" value="<?php /*echo $id_guru */
?>">
                        <label class="mt-checkbox"> <strong><?php /*echo $row['nama'] */
?></strong>
                            <input type="checkbox" value="<?php /*echo $row['id_mapel'] */
?>" name="mapel[]" <?php
/*                        while($r=$q->fetch()){
                            if ($row['id_mapel']==$r['id_mapel']){
                                echo 'checked';
                            }else{
                                echo '';
                            }
                        }
                        */
?> />
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <?php
/*        }
    */
?>
</div>-->
<?php
$mapel = $pdo->prepare("select * from set_mapel_guru where id_guru='$id_guru'");
$mapel->execute();
$rmapel = $mapel->rowCount();
?>
<div class="form-group">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th> No</th>
            <th> Nama</th>
            <th> Pilihan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($rmapel >= 1) {
            $no = 1;
            while ($row = $mapel->fetch()) {
                $id_mapel = $row['id_mapel'];
                $mapelnya = $pdo->prepare("select * from tb_mapel where id_mapel='$id_mapel'");
                $mapelnya->execute();
                $row_mapel = $mapelnya->fetch();
                ?>
                <tr class="">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row_mapel['nama'] ?></td>
                    <td>
                        <a onclick="return confirm('Yakin ingin hapus data ini?')"
                           href="?page=data_guru&delete_mapel=<?php echo $row['id_mapel'] ?>&delete_guru=<?php echo $id_guru ?>"
                           class="btn btn-sm btn red">
                            <i class="icon-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr class="">
                <td colspan="3" style="text-align: center">Tidak Ada Data</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<?php
}elseif(isset($_POST['id_tambah'])){
    $idguru = $_POST['id_tambah'];

    $mapel = $pdo->prepare("select * from tb_mapel ORDER BY nama asc");
    $mapel->execute();
    $guru = $pdo->prepare("select * from tb_guru where id_guru='$idguru'");
    $guru->execute();
    $row_guru = $guru->fetch();
    ?>
        <div class="form-group">
            <input type="hidden" name="guru_ampu" value="<?php echo $row_guru['id_guru'] ?>">
            <label for="">Pilih Mapel</label>
            <select name="mapel_ampu" id="" class="form-control">
                <?php
                while ($row=$mapel->fetch()) {
                    ?>
                    <option value="<?php echo $row['id_mapel'] ?>"><?php echo $row['nama'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
<?php
}
?>


