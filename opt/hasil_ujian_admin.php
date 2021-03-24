<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 14/09/2017
 * Time: 07.05
 */
if (isset($_SESSION['admin'])) {
    if (isset($_GET['detail_id'])){
        $id_dtl = $_GET['detail_id'];

        $ujian = $pdo->prepare("select * from set_ujian where id='$id_dtl'");
        $ujian->execute();
        $row_u=$ujian->fetch();
        $id_kelas = $row_u['id_kelas'];
        $kelas=$pdo->prepare("select * from tb_kelas where id_kelas='$id_kelas'");
        $kelas->execute();
        $rkelas=$kelas->fetch();

        $id_mapel = $row_u['id_mapel'];
        $id_guru = $row_u['id_guru'];

        $mapel = $pdo->prepare("select * from tb_mapel where id_mapel='$id_mapel'");
        $mapel->execute();
        $row_m = $mapel->fetch();

        $guru = $pdo->prepare("select * from tb_guru where id_guru='$id_guru'");
        $guru->execute();
        $row_g = $guru->fetch();

        $us = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_dtl'");
        $us->execute();
        while ($rus = $us->fetch()){
            $nilai_akhir = $rus['nilai_akhir'];
            $tertinggi = $pdo->prepare("select max(nilai_akhir) as maks from set_ikut_ujian where id_ujian='$id_dtl'");
            $tertinggi->execute();
            $max = $tertinggi->fetch();

            $terendah = $pdo->prepare("select min(nilai_akhir) as minim from set_ikut_ujian where id_ujian='$id_dtl'");
            $terendah->execute();
            $min = $terendah->fetch();


        }
        $semua_nilai = $pdo->prepare("select sum(nilai_akhir) as total from set_ikut_ujian where id_ujian='$id_dtl'");
        $semua_nilai->execute();
        $total  = $semua_nilai->fetch();
        $total_nilai = $total['total'];

        $semua_nilai2 = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_dtl'");
        $semua_nilai2->execute();
        while ($tn = $semua_nilai2->fetch()){
            $rc = $semua_nilai2->rowCount();
        }

        $siswa = $pdo->prepare("select ts.*,tk.nama_kelas from tb_kelas as tk inner join tb_siswa as ts where tk.id_kelas=ts.kelas");
        $siswa->execute();

        $siswa2 = $pdo->prepare("select * from tb_siswa");
        $siswa2->execute();

        //hitung jumlah siswa yang ikut ujian;
        $jumlah_peserta = 0;
        while($r_ts = $siswa2->fetch()) {
            $idsiswa = $r_ts['id_siswa'];
            $total_siswa = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_dtl' and id_siswa='$idsiswa'");
            $total_siswa->execute();
            $rts = $total_siswa->fetch();
            $siswanya = $rts['id_siswa'];
            $jum_siswa = $pdo->prepare("select * from tb_siswa where id_siswa='$siswanya'");
            $jum_siswa->execute();
            $rcs = $jum_siswa->rowCount();
            $jumlah_peserta = $jumlah_peserta+$rcs;
        }


        $jumlah = $rc;
        $rata2 = number_format($total_nilai/$rc,2);

        $nilai_tertinggi = $max['maks'];
        $nilai_terendah = $min['minim'];

        ?>
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Detail Ujian</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-scrollabel">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td><strong>Mata Pelajaran</strong></td>
                                        <td><?php echo $row_m['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Guru</strong></td>
                                        <td><?php echo $row_g['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Ujian</strong></td>
                                        <td><?php echo $row_u['nama_ujian'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Soal</strong></td>
                                        <td><?php echo $row_u['jenis']=='urut'?'Urut':'Acak' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kelas</strong></td>
                                        <td><?php echo $rkelas['nama_kelas'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Statistik Ujian</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-scrollabel">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td><strong>Jumlah Peserta</strong></td>
                                        <td><?php echo $jumlah_peserta ;?> Siswa</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Soal</strong></td>
                                        <td><?php echo $row_u['jumlah_soal'] ?> Soal</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nilai Tertinggi</strong></td>
                                        <td><?php echo $nilai_tertinggi ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nilai Terendah</strong></td>
                                        <td><?php echo $nilai_terendah ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rata-Rata</strong></td>
                                        <td><?php echo $rata2 ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet light ">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                <tr>
                    <th> No </th>
                    <th> NIS </th>
                    <th> Nama </th>
                    <th> Kelas </th>
                    <th> Nilai </th>
                    <th> Pilihan </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                while ($rs = $siswa->fetch()) {
                    $id_siswa = $rs['id_siswa'];
                    $nama = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_dtl' and id_siswa='$id_siswa'");
                    $nama->execute();
                    $rn = $nama->fetch();
                    $ids = $rn['id_siswa'];
                    $s = $pdo->prepare("select * from tb_siswa where id_siswa='$ids' ORDER BY nis DESC ");
                    $s->execute();
                    $rowsiswa=$s->fetch();
                    $snya = $s->rowCount();
                    if ($snya >= 1) {
                        $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_dtl' and id_siswa='$ids' and jml_benar='1'");
                        $tot_nilai->execute();

                        $t = 0;
                        while ($t_nilai = $tot_nilai->fetch()) {
                            $t = $t + $t_nilai['nilai'];
                        }
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $rowsiswa['nis'] ?></td>
                            <td><?php echo $rowsiswa['nama'] ?></td>
                            <td><?php echo $rs['nama_kelas'] ?></td>
                            <td><?php echo $t ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin membatalkan ujian ini??')" class="btn btn-sm btn red" href="?page=hasil&id_detail=<?php echo $id_dtl ?>&batalkan_ujian=<?php echo $rowsiswa['id_siswa'] ?>">
                                    <i class="icon-close"></i> Batalkan Ujian
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }elseif (isset($_GET['batalkan_ujian']) && isset($_GET['id_detail'])){
        $id_dtl = $_GET['id_detail'];
        $idsis = $_GET['batalkan_ujian'];
        $delete = $pdo->prepare("select * from set_ikut_ujian where id_siswa='$idsis' and id_ujian='$id_dtl'");
        $delete->execute();
        while($rd = $delete->fetch()){
            $del_siswa = $rd['id_siswa'];
            $querydel = $pdo->prepare("delete from set_ikut_ujian where id_ujian='$id_dtl' and id_siswa='$del_siswa'");
            $querydel->execute();
        }
        echo "<script>window.location='?page=hasil'</script>";
    }else{
        $det_ujian = $pdo->prepare("SELECT * FROM set_ujian ORDER BY id_mapel ASC,id_guru DESC ");
        $det_ujian->execute();

        ?>
        <div class="page-content-inner">

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">  Hasil Ujian</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="sample_1">
                                <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Nama Ujian</th>
                                    <th> Nama Guru</th>
                                    <th> Mata Pelajaran</th>
                                    <th> Jumlah Soal</th>
                                    <th> Jenis</th>
                                    <th> Pilihan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                while ($rw = $det_ujian->fetch()) {
                                    $id_ujian = $rw['id'];
                                    $idnya = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_ujian' LIMIT 1");
                                    $idnya->execute();
                                    $r = $idnya->rowCount();
                                    if ($r >= 1) {
                                        while ($row = $idnya->fetch()) {
                                            $idujian = $row['id_ujian'];
                                            $iduji = $pdo->prepare("select * from set_ujian where id='$idujian'");
                                            $iduji->execute();
                                            $rid = $iduji->fetch();
                                            $idguru = $rid['id_guru'];
                                            $idmapel = $rid['id_mapel'];

                                            $guru = $pdo->prepare("select * from tb_guru where id_guru='$idguru'");
                                            $guru->execute();
                                            $rg = $guru->fetch();

                                            $mapel = $pdo->prepare("select * from tb_mapel where id_mapel='$idmapel'");
                                            $mapel->execute();
                                            $rm = $mapel->fetch();
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $rid['nama_ujian'] ?></td>
                                                <td><?php echo $rg['nama'] ?></td>
                                                <td><?php echo $rm['nama'] ?></td>
                                                <td><?php echo $rid['jumlah_soal'] ?></td>
                                                <td><?php echo $rid['jenis'] == 'urut' ? 'Urut' : 'Acak' ?></td>
                                                <td>
                                                    <a href="?page=hasil&detail_id=<?php echo $rid['id'] ?>"
                                                       class="btn btn-sm btn blue"><i class="icon-eye"></i> Lihat
                                                        Hasil</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <?php
    }
}