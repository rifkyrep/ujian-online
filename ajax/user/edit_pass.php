<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 26/08/2017
 * Time: 15.15
 */
require_once '../../config/koneksi.php';
$id_user = $_POST['id'];
$user = $pdo->prepare("select * from tb_user where id_user='$id_user'");
$user->execute();
$row_user = $user->fetch();
?>
<div class="form-group">
    <strong><label for="pass_lama">Password Lama</label></strong>
    <input type="password" name="pass_lama" placeholder="Masukkan Password Lama" class="form-control" id="pass_lama">
    <input type="hidden" name="id_user" value="<?php echo $row_user['id_user'] ?>">
</div>
<div class="form-group">
    <strong><label for="pass_baru">Password Baru</label></strong>
    <input type="password" name="pass_baru" placeholder="Masukkan Password Baru" class="form-control" id="pass_baru">
</div>
