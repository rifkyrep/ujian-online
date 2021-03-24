<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 24/06/2017
 * Time: 23.11
 */
require_once 'koneksi.php';
if (isset($_SESSION['admin'])){
    $user_login = $_SESSION['admin'];
    $user = $pdo->prepare("select * from tb_user where id_user='$user_login'");
    $user->execute();
    $u = $user->fetch();
}elseif (isset($_SESSION['siswa'])){
    $user_login = $_SESSION['siswa'];
    $user_nis = $_SESSION['nis'];

    $id_siswa = $pdo->prepare("select * from tb_siswa WHERE id_siswa=$user_login");
    $id_siswa->execute();

    $q = $pdo->prepare("select * from tb_siswa where nis='$user_nis'");
    $q->execute();
    $u = $q->fetch();
}elseif (isset($_SESSION['guru'])){
    $user_login = $_SESSION['guru'];
    $user_nip = $_SESSION['nip'];

    $sess_id_guru = $pdo->prepare("select * from tb_guru where id_guru=$user_login");
    $sess_id_guru->execute();
    $row_sess_guru = $sess_id_guru->fetch();

    $q = $pdo->prepare("select * from tb_guru where nip='$user_nip'");
    $q->execute();
    $u = $q->fetch();
}