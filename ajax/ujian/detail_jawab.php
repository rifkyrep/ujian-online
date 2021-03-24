<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 10.16
 */
require_once '../../config/koneksi.php';
$id_soal = $_POST['id_soal'];
$q = $pdo->prepare("select * from tb_soal where id_soal='$id_soal'");
$q->execute();
$row=$q->fetch();
?>
<div class="form-group">
  <p><?php  echo $row['detail_jawaban'] ?></p>
</div>
