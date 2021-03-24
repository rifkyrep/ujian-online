<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 10/08/2017
 * Time: 19.59
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];

function get_token($panjang){
    $token = array(
        range(1,9),
        range('A','Z')
    );

    $karakter = array();
    foreach($token as $key=>$val){
        foreach($val as $k=>$v){
            $karakter[] = $v;
        }
    }

    $token = null;
    for($i=1; $i<=$panjang; $i++){
        // mengambil array secara acak
        $token .= $karakter[rand($i, count($karakter) - 1)];
    }

    return $token;
}

$tokennya = get_token(5);
$query = $pdo->prepare("update set_ujian set token=:token where id=:id");
$query->bindParam(':token',$tokennya);
$query->bindParam(':id',$id);
$query->execute();

$a = $pdo->prepare("select * from set_ujian where id='$id'");
$a->execute();

while($b = $a->fetch()) {
    ?>
    <strong><?php echo $b['token'] ?></strong>
    <?php
}

