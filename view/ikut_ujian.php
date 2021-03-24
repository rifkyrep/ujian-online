<?php
if (isset($_SESSION['ujian'])) {
    $id_uji = $_GET['tes_ujian'];
    $nis = $_SESSION['nis'];
    $id = $pdo->prepare("select * from tb_siswa where nis='$nis'");
    $id->execute();
    $row_id = $id->fetch();
    $id_siswa = $row_id['id_siswa'];
    $id2 = $_GET['tes_ujian'];

    $id_ujian = $pdo->prepare("select * from set_ujian where id='$id_uji'");
    $id_ujian->execute();
    $u = $id_ujian->fetch();
    $idguru = $u['id_guru'];
    $idmapel = $u['id_mapel'];

    if ($u['jenis'] == 'acak') {
        $soalnya = $pdo->prepare("select * from tb_soal where id_guru='$idguru' and id_mapel='$idmapel' ORDER BY rand()");
        $soalnya->execute();
        $no = 1;
        ?>
        <div class="col-md-12">
            <form action="" method="post">
                <?php
                while ($row_soal = $soalnya->fetch()) {
                    $idsoal = $row_soal['id_soal'];
                    $q_id = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                    $q_id->execute();
                    ?>
                    <p><?php echo $no++ . '' . $row_soal['soal'] ?></p>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>"
                                   value="A">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>">
                                <div class="huruf_opsi">A</div>
                                <p><?php echo $row_soal['opsi_a'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>"
                                   value="B">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>">
                                <div class="huruf_opsi">B</div>
                                <p><?php echo $row_soal['opsi_b'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>"
                                   value="C">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>">
                                <div class="huruf_opsi">C</div>
                                <p><?php echo $row_soal['opsi_c'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>"
                                   value="D">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>">
                                <div class="huruf_opsi">D</div>
                                <p><?php echo $row_soal['opsi_d'] ?></p></label>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['simpan'])) {
                        $jawab = $_POST[$row_soal['id_soal']];
                        $jwb_benar = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoal' and id_siswa='$id_siswa'");
                        $jwb_benar->execute();
                        $row_jb = $jwb_benar->fetch();

                        $bobot = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                        $bobot->execute();
                        $row_b = $bobot->fetch();
                        $bobotnya = $row_b['bobot'];

                        if ($jawab == $row_jb['kunci_jawaban']) {
                            $jml_benar = 1;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
                            $queri->bindParam(':jawab', $jawab);
                            $queri->bindParam(':jml_benar', $jml_benar);
                            $queri->bindParam(':nilai', $bobotnya);
                            $queri->bindParam(':id_soal', $idsoal);
                            $queri->bindParam(':id_siswa', $id_siswa);
                            $queri->execute();
                        } else {
                            $jml_benar = 0;
                            $bobot = 0;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
                            $queri->bindParam(':jawab', $jawab);
                            $queri->bindParam(':jml_benar', $jml_benar);
                            $queri->bindParam(':nilai', $bobot);
                            $queri->bindParam(':id_soal', $idsoal);
                            $queri->bindParam(':id_siswa', $id_siswa);
                            $queri->execute();
                        }
                        $siswa_nis = $_SESSION['nis'];
                        $siswa = $pdo->prepare("select * from tb_siswa where nis='$siswa_nis'");
                        $siswa->execute();
                        $rs = $siswa->fetch();
                        $n = $rs['id_siswa'];

                        $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_uji' and id_siswa='$n' and jml_benar='1'");
                        $tot_nilai->execute();
                        $t = 0;
                        while ($t_nilai = $tot_nilai->fetch()) {
                            $t = $t + $t_nilai['nilai'];
                            $kuery = $pdo->prepare("update set_ikut_ujian set nilai_akhir=:t where id_ujian='$id_uji' and id_siswa='$n'");
                            $kuery->bindParam(':t', $t);
                            $kuery->execute();
                        }
                        echo "<script>window.location='?page=ujian'</script>";
                    }
                }
                ?>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
        <?php
    } else {
        $soalnya = $pdo->prepare("select * from tb_soal where id_guru='$idguru' and id_mapel='$idmapel' ORDER BY id_soal ASC ");
        $soalnya->execute();
        $no = 1;
        ?>
        <div class="col-md-12">
            <form action="" method="post">
                <?php
                while ($row_soal = $soalnya->fetch()) {
                    $idsoal = $row_soal['id_soal'];
                    $q_id = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                    $q_id->execute();
                    ?>
                    <p><?php echo $no++ . '' . $row_soal['soal'] ?></p>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>"
                                   value="A">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>">
                                <div class="huruf_opsi">A</div>
                                <p><?php echo $row_soal['opsi_a'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>"
                                   value="B">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>">
                                <div class="huruf_opsi">B</div>
                                <p><?php echo $row_soal['opsi_b'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>"
                                   value="C">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>">
                                <div class="huruf_opsi">C</div>
                                <p><?php echo $row_soal['opsi_c'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>"
                                   value="D">
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>">
                                <div class="huruf_opsi">D</div>
                                <p><?php echo $row_soal['opsi_d'] ?></p></label>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['simpan'])) {
                        $jawab = $_POST[$row_soal['id_soal']];
                        $jwb_benar = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoal' and id_siswa='$id_siswa'");
                        $jwb_benar->execute();
                        $row_jb = $jwb_benar->fetch();

                        $bobot = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                        $bobot->execute();
                        $row_b = $bobot->fetch();
                        $bobotnya = $row_b['bobot'];

                        if ($jawab == $row_jb['kunci_jawaban']) {
                            $jml_benar = 1;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
                            $queri->bindParam(':jawab', $jawab);
                            $queri->bindParam(':jml_benar', $jml_benar);
                            $queri->bindParam(':nilai', $bobotnya);
                            $queri->bindParam(':id_soal', $idsoal);
                            $queri->bindParam(':id_siswa', $id_siswa);
                            $queri->execute();
                            echo "<script>window.location='?page=ujian'</script>";
                        } else {
                            $jml_benar = 0;
                            $bobot = 0;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa");
                            $queri->bindParam(':jawab', $jawab);
                            $queri->bindParam(':jml_benar', $jml_benar);
                            $queri->bindParam(':nilai', $bobot);
                            $queri->bindParam(':id_soal', $idsoal);
                            $queri->bindParam(':id_siswa', $id_siswa);
                            $queri->execute();
                            echo "<script>window.location='?page=ujian'</script>";
                        }
                        $siswa_nis = $_SESSION['nis'];
                        $siswa = $pdo->prepare("select * from tb_siswa where nis='$siswa_nis'");
                        $siswa->execute();
                        $rs = $siswa->fetch();
                        $n = $rs['id_siswa'];

                        $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_uji' and id_siswa='$n' and jml_benar='1'");
                        $tot_nilai->execute();
                        $t = 0;
                        while ($t_nilai = $tot_nilai->fetch()) {
                            $t = $t + $t_nilai['nilai'];
                            $kuery = $pdo->prepare("update set_ikut_ujian set nilai_akhir=:t where id_ujian='$id_uji' and id_siswa='$n'");
                            $kuery->bindParam(':t', $t);
                            $kuery->execute();
                        }
                        echo "<script>window.location='?page=ujian'</script>";

                    }
                }
                ?>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
        <?php
    }
}else{
    ?>
    <script>window.location='?page=ujian'</script>
<?php
}