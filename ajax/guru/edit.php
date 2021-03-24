<?php
/**
 *
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 24/06/2017
 * Time: 15.34
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];
$q = $pdo->prepare("select * from tb_guru where id_guru='$id'");
$q->execute();
$r = $q->fetch();
?>
<div class="form-group">
    <label for="">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?php echo $r['nama'] ?>">
    <input type="hidden" name="id" value="<?php echo $r['id_guru'] ?>">
</div>
<div class="form-group">
    <label for="">NIP</label>
    <input type="text" name="nip" class="form-control" value="<?php echo $r['nip'] ?>" readonly>
</div>
