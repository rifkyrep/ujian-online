<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 10/08/2017
 * Time: 21.08
 */
require_once '../../config/koneksi.php';
$id = $_POST['id'];
$id_mapel = $_POST['id_mapel'];
$id_guru = $_POST['id_guru'];



$query = $pdo->prepare("select * from set_ujian where id='$id'");
$query->execute();
$row = $query->fetch();
$id_kelas=$row['id_kelas'];

$kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$id_kelas'");
$kelas->execute();
$idkel=$kelas->fetch();
$id_tingkat=$idkel['id_tingkat'];

$tingkat=$pdo->prepare("select * from tb_tingkat where id_tingkat='$id_tingkat'");
$tingkat->execute();
$rtingkat=$tingkat->fetch();

/*$a = $pdo->prepare("select * from set_mapel_guru where id_guru='$id_guru'");
$a->execute();
$r_idgur = $a*/

$mapel = $row['id_mapel'];
$q = $pdo->prepare("select * from tb_mapel where id_mapel='$mapel'");
$q->execute();
$row_q = $q->fetch();

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
        var id_kelas=$('#id_kelas').val();

        $.ajax({
            type:'post',
            url:'ajax/ujian/edit_tampil_kelas.php',
            data: 'id_tingkat='+id_tingkat+'&id_kelas='+id_kelas,
            cache:false,
            success:function (e) {
                $('#kelas_edit').html(e);
            }
        })
    }
</script>

<div class="form-group">
    <label for="">Nama Ujian</label>
    <input type="text" name="nama_ujian" class="form-control" value="<?php echo $row['nama_ujian']?>">
    <input type="hidden" name="id_ujian" value="<?php echo $id ?>">
</div>
<div class="form-group">
    <label for="">Mata Pelajaran</label>
    <select name="mapel" id="id_mapel" class="form-control" disabled>
        <option value="<?php echo $row_q['id_mapel'] ?>"><?php echo $row_q['nama'] ?></option>
    </select>
</div>
<div class="form-group">
    <input type="hidden" value="<?php echo $id_kelas ?>" id="id_kelas">
    <label for="">Tingkat</label>
    <select name="" id="tingkat_edit" class="form-control">
     <!--   --><?php
/*        while ($rt=$tingkat->fetch()){
            */?>
            <option value="<?php echo $rtingkat['id_tingkat'] ?>"><?php echo $rtingkat['keterangan'] ?></option>
       <!-- --><?php
/*        }
        */?>
    </select>
</div>
<div class="form-group">
    <label for="">Kelas</label>
    <select name="kelas" id="kelas_edit" class="form-control"></select>
</div>
<div class="form-group">
    <label for="">Jumlah Soal</label>
    <input type="text" name="jumlah_soal" class="form-control" value="<?php echo $row['jumlah_soal'] ?>" disabled>
</div>
<div class="form-group">
    <label for="">Waktu</label>
    <input type="number" name="waktu" class="form-control" value="<?php echo $row['waktu'] ?>" placeholder="Waktu harus lebih dari 60 menit">
</div>
<div class="form-group">
    <label for="">Pengacakan</label>
    <select name="pengacakan" id="" class="form-control">
        <option value="acak" <?php echo $row['jenis']=='acak'?'selected':'' ?>>Acak Soal</option>
        <option value="urut" <?php echo $row['jenis']=='urut'?'selected':'' ?>>Urut Soal</option>
    </select>
</div>
