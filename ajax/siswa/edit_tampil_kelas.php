<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 23/06/2017
 * Time: 19.48
 */
require_once '../../config/koneksi.php';
$id_tingkat = $_POST['id_tingkat'];
$id_siswa = $_POST['id_siswa'];
$siswa=$pdo->prepare("select * from tb_siswa where id_siswa='$id_siswa'");
$siswa->execute();
$rs=$siswa->fetch();
$idkelas=$rs['kelas'];

$kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$idkelas'");
$kelas->execute();
$idk=$kelas->fetch();

$q=$pdo->prepare("select * from tb_kelas where id_tingkat='$id_tingkat'");
$q->execute();
while ($row=$q->fetch()){
    ?>
    <option value="<?php echo $row['id_kelas'] ?>" <?php echo $row['id_kelas']==$idk['id_kelas']?'selected':'' ?>><?php echo $row['nama_kelas'] ?></option>
    <?php
}