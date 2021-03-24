<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 23/06/2017
 * Time: 19.48
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];
$q = $pdo->prepare("select * from tb_siswa where id_siswa=$id");
$q->execute();
$r = $q->fetch();
$id_kelas=$r['kelas'];
$kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$id_kelas'");
$kelas->execute();
$rowk=$kelas->fetch();
$tingkat=$pdo->prepare("select * from tb_tingkat");
$tingkat->execute();
?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        loadkelas2();
    })
</script>
<script>
    $(document).ready(function () {
        $('#tingkat_edit').change(function () {
            loadkelas2();
        })
    });
</script>
<script>
    function loadkelas2() {
        var id_tingkat=$('#tingkat_edit').val();
        var id_siswa=$('#id_siswa').val();

        $.ajax({
            type:'post',
            url:'ajax/siswa/edit_tampil_kelas.php',
            data: 'id_tingkat='+id_tingkat+'&id_siswa='+id_siswa,
            cache:false,
            success:function (e) {
                $('#kelas_edit').html(e);
            }
        })
    }
</script>
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $r['nama'] ?>" required>
        <input type="hidden" name="id" class="form-control" value="<?php echo $r['id_siswa'] ?>">
    </div>
    <div class="form-group">
        <label for="">NIS</label>
        <input type="text" name="nis" class="form-control" value="<?php echo $r['nis'] ?>" readonly required>
    </div>
    <div class="form-group">
        <input type="hidden" value="<?php echo $id ?>" id="id_siswa">
        <label for="">Tingkat</label>
        <select name="tingkat" id="tingkat_edit" class="form-control">
            <?php
            while ($rt=$tingkat->fetch()){
                ?>
                <option value="<?php echo $rt['id_tingkat'] ?>" <?php echo $rt['id_tingkat']==$rowk['id_tingkat']?'selected':'' ?>><?php echo $rt['keterangan'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Kelas</label>
        <select name="kelas" id="kelas_edit" class="form-control"></select>
    </div>
