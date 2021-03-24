<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 27/07/2017
 * Time: 19.23
 */
require_once '../../config/koneksi.php';
if ($_POST['id']) {
    $id_mapel = $_POST['id'];
    $query = $pdo->prepare("select * from set_mapel_guru where id_mapel=$id_mapel");
    $query->execute();
    while ($row = $query->fetch()) {
        $id_guru = $row['id_guru'];
        $a = $pdo->prepare("select * from tb_guru where id_guru=$id_guru order by nama");
        $a->execute();
        while ($data = $a->fetch()) {
            ?>
            <option value="<?php echo $data['id_guru'] ?>"><?php echo $data['nama'] ?></option>
            <?php
        }
    }
}elseif($_POST['id_mapel']){
    $id_mapel = $_POST['id_mapel'];
    $id_gur = $_POST['id_guru'];
    $query = $pdo->prepare("select * from set_mapel_guru where id_mapel=$id_mapel");
    $query->execute();

    $gur = $pdo->prepare("select * from set_mapel_guru where id_mapel=$id_mapel and id_guru=$id_gur");
    $gur->execute();
    $row_guru = $gur->fetch();

    while ($row = $query->fetch()) {
        $id_guru = $row['id_guru'];
        $a = $pdo->prepare("select * from tb_guru where id_guru=$id_guru order by nama");
        $a->execute();
        while ($data = $a->fetch()) {
            ?>
            <option value="<?php echo $data['id_guru'] ?>" <?php echo $data['id_guru']==$row_guru['id_guru']?'selected':'' ?>><?php echo $data['nama'] ?></option>
            <?php
        }
    }
}
?>
