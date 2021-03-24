<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 10/08/2017
 * Time: 12.35
 */
require '../../config/koneksi.php';
$id_mapel = $_POST['id_mapel'];
$id_guru = $_POST['id_guru'];

$q = $pdo->prepare("select * from tb_soal where id_mapel='$id_mapel' and id_guru='$id_guru'");
$q->execute();
$cq = $q->rowCount();

if ($cq >= 1){
    ?>
    <input type="text" class="form-control" value="<?php echo $cq ?>" name="jumlah_soal" readonly>
<?php
}else{
    ?>
    <input type="text" class="form-control" value="0" name="jumlah_soal" readonly>
<?php
}