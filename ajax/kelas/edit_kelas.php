<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 11.55
 */
require_once '../../config/koneksi.php';
$id_kelas = $_POST['id_kelas'];
$q = $pdo->prepare("select * from tb_kelas where id_kelas='$id_kelas'");
$q->execute();
$row=$q->fetch();
?>
<div class="form-group">
    <label for="">Kelas</label>
    <input type="text" name="kelas" class="form-control" value="<?php echo $row['nama_kelas'] ?>">
    <input type="hidden" name="id" value="<?php echo $row['id_kelas'] ?>">
</div>
