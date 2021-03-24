<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 23/08/2017
 * Time: 22.48
 */
session_start();
require_once '../../config/koneksi.php';
$nis = $_SESSION['nis'];
$id = $pdo->prepare("select * from tb_siswa where nis='$nis'");
$id->execute();
$row_id = $id->fetch();
$id_siswa = $row_id['id_siswa'];

$id_soal = $_POST['id_soal'];
$jawab = $_POST['jawab'];
$jwb_benar = $pdo->prepare("select * from set_ikut_ujian where id_soal='$id_soal' and id_siswa='$id_siswa'");
$jwb_benar->execute();
$row_jb = $jwb_benar->fetch();

$bobot = $pdo->prepare("select * from tb_soal where id_soal='$id_soal'");
$bobot->execute();
$row_b = $bobot->fetch();
$bobotnya = $row_b['bobot'];

if ($jawab == $row_jb['kunci_jawaban']) {
    $jml_benar = 1;
    $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
    $queri->bindParam(':jawab', $jawab);
    $queri->bindParam(':jml_benar', $jml_benar);
    $queri->bindParam(':nilai', $bobotnya);
    $queri->bindParam(':id_soal', $id_soal);
    $queri->bindParam(':id_siswa', $id_siswa);
    $queri->execute();
} else {
    $jml_benar = 0;
    $bobot = 0;
    $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
    $queri->bindParam(':jawab', $jawab);
    $queri->bindParam(':jml_benar', $jml_benar);
    $queri->bindParam(':nilai', $bobot);
    $queri->bindParam(':id_soal', $id_soal);
    $queri->bindParam(':id_siswa', $id_siswa);
    $queri->execute();
}
$siswa_nis = $_SESSION['nis'];
$siswa = $pdo->prepare("select * from tb_siswa where nis='$siswa_nis'");
$siswa->execute();
$rs = $siswa->fetch();
$n = $rs['id_siswa'];

$tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_uji' and id_siswa='$n' and jml_benar='1'");
$tot_nilai->execute();
$t = 0;
while ($t_nilai = $tot_nilai->fetch()) {
    $t = $t + $t_nilai['nilai'];
    $kuery = $pdo->prepare("update set_ikut_ujian set nilai_akhir=:t where id_ujian='$id_uji' and id_siswa='$n'");
    $kuery->bindParam(':t', $t);
    $kuery->execute();
}
