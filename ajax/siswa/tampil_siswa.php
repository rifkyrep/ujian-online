<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 13.46
 */
require_once '../../config/koneksi.php';
$id_kelas = $_POST['id_kelas'];
$siswa = $pdo->prepare("select ts.*,tk.nama_kelas from tb_kelas as tk INNER join tb_siswa as ts where ts.kelas='$id_kelas' and tk.id_kelas='$id_kelas' ORDER BY nama asc ");
$siswa->execute();
$count=$siswa->rowCount();
?>
<link href="../../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
      type="text/css"/>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th> No </th>
        <th> Nama </th>
        <th> NIS </th>
        <th> Kelas </th>
        <th> Pilihan </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    if ($count>=1) {
        while ($row = $siswa->fetch()) {
            ?>
            <tr class="odd gradeX">
                <td> <?php echo $no++ ?> </td>
                <td><?php echo $row['nama'] ?> </td>
                <td> <?php echo $row['nis'] ?></td>
                <td><?php echo $row['nama_kelas'] ?></td>
                <td>
                    <a class="btn btn-sm btn blue" href="" id="edit_siswa" data-target="#edit"
                       data-id="<?php echo $row['id_siswa'] ?>" data-toggle="modal">
                        <i class="icon-pencil"></i> Edit
                    </a>
                    <a href="?page=data_siswa&delete=<?php echo $row['id_siswa'] ?>" class="btn btn-sm btn red"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="icon-trash"></i> Hapus
                    </a>
                    <?php
                    if ($row['status'] == '0') {
                        ?>
                        <a href="?page=data_siswa&aktif=<?php echo $row['id_siswa'] ?>"
                           onclick="return confirm('Yakin ingin mengaktifkan user tersebut? Username dan Password secara default sama dengan NIS')"
                           class="btn btn-sm purple">
                            <i class="icon-user-following"></i> Aktifkan User
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="?page=data_siswa&nonaktif=<?php echo $row['id_siswa'] ?>" class="btn btn-sm btn red"
                           onclick="return confirm('Yakin ingin mengnonaktifkan??')">
                            <i class="icon-user-unfollow"></i> Non-Aktifkan User
                        </a>
                        <a onclick="return confirm('Yakin ingin mereset password?? Password akan sama dengan NIS!!')"
                           href="?page=data_siswa&reset_pass=<?php echo $row['id_siswa'] ?>"
                           class="btn btn-sm btn yellow">
                            <i class="icon-shuffle"></i> Reset Password
                        </a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td colspan="5">Tidak Ada Data</td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
