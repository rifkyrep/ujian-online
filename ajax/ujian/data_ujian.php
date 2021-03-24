<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 23/08/2017
 * Time: 13.31
 */
session_start();
$sess_id_guru = $_SESSION['nip'];
require_once '../../config/koneksi.php';
$guru = $pdo->prepare("select * from tb_guru where nip='$sess_id_guru'");
$guru->execute();
$row_guru = $guru->fetch();
$id_guru = $row_guru['id_guru'];

$soal = $pdo->prepare("select * from set_ujian where id_guru='$id_guru' ORDER BY nama_ujian DESC");
$soal->execute();
$rc = $soal->rowCount();
if ($rc>=1) {
    ?>
    <table class="table table-striped table-bordered table-hover table-checkable order-column"
           id="sample_1">
        <thead>
        <tr>
            <th> No</th>
            <th> Nama Ujian</th>
            <th> Mata Pelajaran</th>
            <th> Kelas</th>
            <th> Jumlah Soal</th>
            <th> Pengacakan Soal</th>
            <th> Waktu</th>
            <th> Token</th>
            <th> Pilihan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($rows = $soal->fetch()) {
            $idmapel = $rows['id_mapel'];
            $idkelas=$rows['id_kelas'];
            $kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$idkelas'");
            $kelas->execute();
            $rowkelas=$kelas->fetch();

            $mapelnya = $pdo->prepare("select * from tb_mapel where id_mapel='$idmapel'");
            $mapelnya->execute();
            $row_mapel = $mapelnya->fetch();
            ?>
            <tr class="odd gradeX">
                <td><?php echo $no++ ?></td>
                <td><?php echo $rows['nama_ujian'] ?></td>
                <td><?php echo $row_mapel['nama'] ?></td>
                <td><?php echo $rowkelas['nama_kelas'] ?></td>
                <td><?php echo $rows['jumlah_soal'] ?></td>
                <td><?php echo $rows['jenis'] == 'acak' ? 'Acak' : 'Urut' ?></td>
                <td><?php echo $rows['waktu'] ?> Menit</td>
                <td>
                    <div id="tokennya"><strong><?php echo $rows['token'] ?></strong></div>
                </td>
                <td>
                    <a class="btn btn-sm btn blue" id="edit_soal" data-target="#edit"
                       data-id="<?php echo $rows['id'] ?>" data-idmapel="<?php echo $rows['id_mapel'] ?>"
                       data-idguru="<?php echo $rows['id_guru'] ?>" data-toggle="modal">
                        <i class="icon-pencil"></i> Edit
                    </a>
                    <a class="btn btn-sm btn yellow" id="token"
                       data-id="<?php echo $rows['id'] ?>">
                        <i class="fa fa-refresh"></i> Ubah Token
                    </a>
                    <a onclick="return confirm('Yakin ingin menghapus??')"
                       href="?page=ujian&delete=<?php echo $rows['id'] ?>"
                       class="btn btn-sm btn red">
                        <i class="icon-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else {
    ?>
    <table class="table table-striped table-bordered table-hover table-checkable order-column"
           id="sample_1">
        <thead>
        <tr>
            <th> No</th>
            <th> Nama Tes</th>
            <th> Mata Pelajaran</th>
            <th> Jumlah Soal</th>
            <th> Pengacakan Soal</th>
            <th> Waktu</th>
            <th> Token</th>
            <th> Pilihan</th>
        </tr>
        </thead>
        <tbody>
            <tr class="odd gradeX">
                <td colspan="8">Tidak ada data</td>
            </tr>
        </tbody>
    </table>
    <?php
}