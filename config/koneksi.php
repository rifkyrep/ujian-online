<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 17.17
 */
try{
    $pdo = new PDO('mysql:dbname=uji_aja;host=localhost:3306','root','');
}catch(PDOException $pesan){
    die($pesan->getMessage());
}

