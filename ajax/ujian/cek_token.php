<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 15/08/2017
 * Time: 22.18
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];
$query = $pdo->prepare("select * from set_ujian WHERE id='$id'");
$query->execute();
$r = $query->fetch();
$id_guru = $r['id_guru'];
$g = $pdo->prepare("select * from tb_guru where id_guru='$id_guru'");
$g->execute();
$row_guru = $g->fetch();
?>
<div class="form-group">
    <label for="token">Nama Ujian</label>
    <input id="token" type="text" class="form-control" name="" value="<?php echo $r['nama_ujian']  ?>" readonly>
</div>
<div class="form-group">
    <label for="token">Nama Guru</label>
    <input id="token" type="text" class="form-control" name="" value="<?php echo $row_guru['nama']  ?>" readonly>
</div>
<div class="form-group">
    <label for="token">Waktu</label>
    <input id="token" type="text" class="form-control" name="" value="<?php echo $r['waktu']  ?> Menit" readonly>
</div>
<div class="form-group">
    <input type="hidden" value="<?php echo $r['id'] ?>" name="id">
    <label for="token">Masukkan Token</label>
    <input id="token" type="text" class="form-control" name="tokennya" required="">
</div>

