<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 12/09/2017
 * Time: 10.50
 */if (isset($_SESSION['admin'])){
    if (isset($_GET['tambah_data'])) {
        //ComboBox Mapel
        $mapel = $pdo->prepare("SELECT * FROM tb_mapel ORDER BY nama ASC ");
        $mapel->execute();
        ?>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                loadguru();
            })
        </script>
        <script>
            $(document).ready(function () {
                $('#id_mapel').change(function () {
                    loadguru();
                })
            })
        </script>
        <script>
            function loadguru() {
                var id = $('#id_mapel').val();
                var data = 'id=' + id;

                $.ajax({
                    type: 'POST',
                    url: 'ajax/soal/guru_ampu.php',
                    data: data,
                    cache: false,
                    success: function (e) {
                        $('#id_guru').html(e);
                    }
                })

            }
        </script>
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXTRAS PORTLET-->
                    <div class="portlet light form-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Tambah Data Soal</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group last">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Mapel</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <select class="form-control" name="mapel" id="id_mapel">
                                                    <?php
                                                    while ($r = $mapel->fetch()) {
                                                        ?>
                                                        <option value="<?php echo $r['id_mapel'] ?>"><?php echo $r['nama'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Guru Pengampu</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <select name="guru" class="form-control" id="id_guru"></select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Soal</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="soalnya" id="soal" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban A</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_a" id="jawaban_a" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban B</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_b" id="jawaban_b" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban C</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_c" id="jawaban_c" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban D</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_d" id="jawaban_d" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Kunci Jawaban</strong>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="kunci" id="" class="form-control">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Bobot Nilai Soal</strong>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="bobot" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn blue btn-block" type="submit" name="simpan">Simpan
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="?page=soal" class="btn yellow btn-block">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['simpan'])) {
            $mapel = $_POST['mapel'];
            $guru = $_POST['guru'];
            $soalnya = $_POST['soalnya'];
            $jwb_a = $_POST['jwb_a'];
            $jwb_b = $_POST['jwb_b'];
            $jwb_c = $_POST['jwb_c'];
            $jwb_d = $_POST['jwb_d'];
            $kunci = $_POST['kunci'];
            $bobot = $_POST['bobot'];
            $jumlah_benar = 0;
            $jumlah_salah = 0;

            $query = $pdo->prepare("INSERT INTO tb_soal (id_guru, id_mapel, bobot, soal, opsi_a, opsi_b, opsi_c, opsi_d, jawaban, jumlah_benar,jumlah_salah) VALUES 
                  (:guru,:mapel,:bobot,:soalnya,:jwb_a,:jwb_b,:jwb_c,:jwb_d,
                  :kunci,:jumlah_benar,:jumlah_salah)");
            $query->bindParam(':guru', $guru);
            $query->bindParam(':mapel', $mapel);
            $query->bindParam(':bobot', $bobot);
            $query->bindParam(':soalnya', $soalnya);
            $query->bindParam(':jwb_a', $jwb_a);
            $query->bindParam(':jwb_b', $jwb_b);
            $query->bindParam(':jwb_c', $jwb_c);
            $query->bindParam(':jwb_d', $jwb_d);
            $query->bindParam(':kunci', $kunci);
            $query->bindParam(':jumlah_benar', $jumlah_benar);
            $query->bindParam(':jumlah_salah', $jumlah_salah);
            $query->execute();
            echo "<script>window.location='?page=soal'</script>";
        }
    } elseif (isset($_GET['id_edit'])) {
        //ComboBox Mapel
        $mapel = $pdo->prepare("SELECT * FROM tb_mapel ORDER BY nama ASC ");
        $mapel->execute();

        $id_soal = $_GET['id_edit'];
        $query = $pdo->prepare("select * from tb_soal where id_soal=$id_soal");
        $query->execute();
        $row = $query->fetch();
        ?>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                loadguru();
            })
        </script>
        <script>
            $(document).ready(function () {
                $('#id_mapel').change(function () {
                    loadguru();
                })
            })
        </script>
        <script>
            function loadguru() {
                var id = $('#id_mapel').val();
                var id_guru = $('#id_guru').val();
                var data = 'id_mapel=' + id + '&id_guru=' + id_guru;

                $.ajax({
                    type: 'POST',
                    url: 'ajax/soal/guru_ampu.php',
                    data: data,
                    cache: false,
                    success: function (e) {
                        $('#data_guru').html(e);
                    }
                })

            }
        </script>

        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXTRAS PORTLET-->
                    <div class="portlet light form-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Tambah Data Soal</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group last">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Mapel</strong>
                                                <input type="hidden" id="id_guru" value="<?php echo $row['id_guru'] ?>">
                                            </div>
                                            <div class="col-md-10">
                                                <select class="form-control" name="mapel" id="id_mapel">
                                                    <?php
                                                    while ($r = $mapel->fetch()) {
                                                        ?>
                                                        <option value="<?php echo $r['id_mapel'] ?>" <?php echo $r['id_mapel'] == $row['id_mapel'] ? 'selected' : '' ?>><?php echo $r['nama'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Guru Pengampu</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <select name="guru" class="form-control" id="data_guru"></select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Soal</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="soalnya" id="soal" cols="30"
                                                          rows="10"><?php echo $row['soal'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban A</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_a" id="jawaban_a" cols="30"
                                                          rows="10"><?php echo $row['opsi_a'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban B</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_b" id="jawaban_b" cols="30"
                                                          rows="10"><?php echo $row['opsi_b'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban C</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_c" id="jawaban_c" cols="30"
                                                          rows="10"><?php echo $row['opsi_c'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Jawaban D</strong>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="jwb_d" id="jawaban_d" cols="30"
                                                          rows="10"><?php echo $row['opsi_d'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <strong>Kunci Jawaban</strong>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="kunci" id="" class="form-control">
                                                    <option value="A" <?php echo $row['jawaban'] == 'A' ? 'selected' : '' ?>>
                                                        A
                                                    </option>
                                                    <option value="B" <?php echo $row['jawaban'] == 'B' ? 'selected' : '' ?>>
                                                        B
                                                    </option>
                                                    <option value="C" <?php echo $row['jawaban'] == 'C' ? 'selected' : '' ?>>
                                                        C
                                                    </option>
                                                    <option value="D" <?php echo $row['jawaban'] == 'D' ? 'selected' : '' ?>>
                                                        D
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Bobot Nilai Soal</strong>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="bobot" class="form-control"
                                                       value="<?php echo $row['bobot'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn blue btn-block" type="submit" name="update">Simpan
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="?page=soal" class="btn yellow btn-block">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['update'])) {
            $mapel = $_POST['mapel'];
            $guru = $_POST['guru'];
            $soalnya = $_POST['soalnya'];
            $jwb_a = $_POST['jwb_a'];
            $jwb_b = $_POST['jwb_b'];
            $jwb_c = $_POST['jwb_c'];
            $jwb_d = $_POST['jwb_d'];
            $kunci = $_POST['kunci'];
            $bobot = $_POST['bobot'];
            $q = $pdo->prepare("UPDATE tb_soal SET id_guru=:guru,id_mapel=:mapel,soal=:soalnya,bobot=:bobot,opsi_a=:jwb_a,
        opsi_b=:jwb_b,opsi_c=:jwb_c,opsi_d=:jwb_d,jawaban=:kunci WHERE id_soal=:id_soal");
            $q->bindParam(':guru', $guru);
            $q->bindParam(':mapel', $mapel);
            $q->bindParam(':bobot', $bobot);
            $q->bindParam(':soalnya', $soalnya);
            $q->bindParam(':jwb_a', $jwb_a);
            $q->bindParam(':jwb_b', $jwb_b);
            $q->bindParam(':jwb_c', $jwb_c);
            $q->bindParam(':jwb_d', $jwb_d);
            $q->bindParam(':kunci', $kunci);
            $q->bindParam(':id_soal', $id_soal);
            $q->execute();
            echo "<script>window.location='?page=soal'</script>";
        }
    } elseif (isset($_GET['id_delete'])) {
        $id = $_GET['id_delete'];

        $query = $pdo->prepare("delete from tb_soal where id_soal=$id");
        $query->execute();
        echo "<script>window.location='?page=soal'</script>";
    } else {
        $soal = $pdo->prepare("SELECT * FROM tb_soal ORDER BY id_mapel ASC ");
        $soal->execute();
        ?>
        <div class="page-content-inner">

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Bank Soal</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" class="btn sbold green"
                                               href="?page=soal&tambah_data"> Tambah Soal
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Mapel</th>
                                <th>Soal</th>
                                <th>Guru</th>
                                <th>Analisa</th>
                                <th>Pilihan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            while ($row = $soal->fetch()) {
                                //Id Soal
                                $idsoal = $row['id_soal'];
                                $id_mapel = $row['id_mapel'];
                                $id_soal = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoal' LIMIT 1");
                                $id_soal->execute();

                                $jumlah_dipakai = 0;
                                while($rowsoal = $id_soal->fetch()){
                                    $idsoalnya = $rowsoal['id_soal'];
                                    $soalnya = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoalnya'");
                                    $soalnya->execute();
                                    $r = $soalnya->fetch();
                                    $c = $soalnya->rowCount();
                                    $jumlah_dipakai = $jumlah_dipakai+$c;
                                }

                                //Jumlah benar
                                $benar = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoal' and jml_benar=1 limit 1");
                                $benar->execute();
                                $jumlah_benar = 0;
                                while ($rb= $benar->fetch()){
                                    $idrb = $rb['id_soal'];
                                    $benarnya = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idrb' and jml_benar=1");
                                    $benarnya->execute();
                                    $count_benar = $benarnya->rowCount();
                                    $jumlah_benar = $jumlah_benar+$count_benar;
                                }

                                //Guru
                                $id_guru = $row['id_guru'];
                                $guru = $pdo->prepare("select * from tb_guru where id_guru=$id_guru");
                                $guru->execute();
                                $row_guru = $guru->fetch();
                                //Mapel
                                $id_mapel = $row['id_mapel'];
                                $mapel = $pdo->prepare("select * from tb_mapel where id_mapel=$id_mapel");
                                $mapel->execute();
                                $row_mapel = $mapel->fetch();
                                ?>
                                <tr class="odd gradeX">
                                    <td style="vertical-align: middle;"><?php echo $no++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php echo $row['id_mapel'] == $row_mapel['id_mapel'] ? $row_mapel['nama']:false ?>
                                    </td>
                                    <td style="vertical-align: middle;max-width: 900px"><?php echo $row['soal'] ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php echo $row['id_guru'] == $row_guru['id_guru'] ? $row_guru['nama'] :false ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <strong>Jumlah Terjawab</strong> : <?php echo $jumlah_dipakai==0?'Belum Ada Data':$jumlah_dipakai; ?><br>
                                        <strong>Jumlah Benar</strong> : <?php echo $jumlah_benar ?> <strong> | Jumlah Salah</strong> : <?php echo $jumlah_dipakai-$jumlah_benar ?>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <a href="?page=soal&id_edit=<?php echo $row['id_soal'] ?>" class="btn btn-sm btn blue"><i class="icon-pencil"></i> Edit</a>
                                        <a onclick="return confirm('Yakin ingin menghapus??')" href="?page=soal&id_delete=<?php echo $row['id_soal'] ?>" class="btn btn-sm btn red"><i class="icon-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <?php
    }
}