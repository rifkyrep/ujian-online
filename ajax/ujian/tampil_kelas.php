<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 13.30
 */
require_once '../../config/koneksi.php';
$id_tingkat = $_POST['id_tingkat'];
$q=$pdo->prepare("select * from tb_kelas where id_tingkat='$id_tingkat'");
$q->execute();
while ($row=$q->fetch()){
    ?>
    <option value="<?php echo $row['id_kelas'] ?>"><?php echo $row['nama_kelas'] ?></option>
<?php
}