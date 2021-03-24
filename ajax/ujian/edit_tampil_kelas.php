<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 23/06/2017
 * Time: 19.48
 */
require_once '../../config/koneksi.php';
$id_tingkat = $_POST['id_tingkat'];
$id_kelas = $_POST['id_kelas'];


$kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$id_kelas'");
$kelas->execute();
$idk=$kelas->fetch();

$q=$pdo->prepare("select * from tb_kelas where id_tingkat='$id_tingkat'");
$q->execute();
/*while ($row=$q->fetch()){*/
    ?>
    <option value="<?php echo $idk['id_kelas'] ?>"><?php echo $idk['nama_kelas'] ?></option>
<!--    --><?php
/*}*/