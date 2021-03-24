<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 26/06/2017
 * Time: 06.46
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];
$query = $pdo->prepare("select * from tb_mapel where id_mapel='$id'");
$query->execute();
$row = $query->fetch();
?>
<div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" value="<?php echo $row['nama'] ?>" name="nama">
    <input type="hidden" value="<?php echo $row['id_mapel'] ?>" name="id">
</div>
