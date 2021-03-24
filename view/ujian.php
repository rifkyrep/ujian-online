<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 03/08/2017
 * Time: 22.19
 */


if (isset($_SESSION['guru'])) {
    $sess_id_guru = $_SESSION['nip'];

    $guru = $pdo->prepare("select * from tb_guru where nip='$sess_id_guru'");
    $guru->execute();
    $row_guru = $guru->fetch();
    $id_guru = $row_guru['id_guru'];

    $mapel = $pdo->prepare("select * from set_mapel_guru where id_guru='$id_guru'");
    $mapel->execute();

    $mapel2 = $pdo->prepare("select * from set_mapel_guru where id_guru='$id_guru'");
    $mapel2->execute();

    $tingkat=$pdo->prepare("select * from tb_tingkat");
    $tingkat->execute();

    $r_map = $mapel2->fetch();
    ?>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function()
        {
            loadjumlahsoal();
            load_data_ujian();
            loadkelas();
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#tingkat_tambah').change(function () {
                loadkelas();
            })
        });
    </script>

    <script>
        function loadkelas() {
            var id_tingkat=$('#tingkat_tambah').val();

            $.ajax({
                type:'post',
                url:'ajax/ujian/tampil_kelas.php',
                data: 'id_tingkat='+id_tingkat,
                cache:false,
                success:function (e) {
                    $('#kelas_tambah').html(e);
                }
            })
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#id_mapel').change(function(){
                loadjumlahsoal();
            })
        })
    </script>

    <script>
        function loadjumlahsoal(){
            var id_mapel = $('#id_mapel').val();
            var id_guru = $('#id_guru').val();
            var data = 'id_mapel='+id_mapel+'&id_guru='+id_guru;

            $.ajax({
                type: 'POST',
                url: 'ajax/ujian/jumlah_soal.php',
                data: data,
                cache: false,
                success: function(e){
                    $('#jumlah_soal').html(e);
                }
            })
        }
    </script>

    <script>
            $(document).on('click','#token',function(){
                var id = $(this).data('id');
                var data = 'id='+id;

                $.ajax({
                    type: 'POST',
                    url: 'ajax/ujian/token.php',
                    data: data,
                    cache: false,
                    success: function(e){
                        load_data_ujian();
                    }
                })
            })
    </script>

    <script>
        $(document).on('click','#edit_soal',function(){
            var id = $(this).data('id');
            var id_mapel = $(this).data('idmapel');
            var id_guru = $(this).data('idguru');
            var data = 'id='+id+'&id_mapel='+id_mapel+'&id_guru='+id_guru;

            $.ajax({
                type: 'POST',
                url: 'ajax/ujian/edit_ujian.php',
                data: data,
                cache: false,
                success: function(e){
                    $('#edit_ujian').html(e);
                }
            })
        })
    </script>

    <script>
        function load_data_ujian(){
            var data='data_ujian';

            $.ajax({
                type: 'POST',
                url: 'ajax/ujian/data_ujian.php',
                data: data,
                cache: false,
                success: function(e) {
                    $('#data_ujian').html(e);
                }
            })
        }
    </script>



    <?php


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
    ?>

    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Data Ujian</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" data-toggle="modal" data-target="#tambah"
                                                class="btn sbold blue"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <!-- DATA UJIAN -->
                        <div id="data_ujian"></div>
                        <!-- DATA UJIAN -->
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="tambah" class="modal modal-primary fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Data</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Ujian</label>
                            <input type="text" name="nama_ujian" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Mata Pelajaran</label>
                            <select name="mapel" id="id_mapel" class="form-control">
                                <?php
                                while ($row_mapel = $mapel->fetch()) {
                                    $mapelnya = $row_mapel['id_mapel'];

                                    $m = $pdo->prepare("select * from tb_mapel where id_mapel='$mapelnya'");
                                    $m->execute();
                                    $row_m = $m->fetch();
                                    ?>
                                    <option value="<?php echo $row_m['id_mapel'] ?>"><?php echo $row_m['nama'] ?></option>
                                    <?php
                                }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Soal</label>
                            <input type="hidden" id="id_guru" value="<?php echo $r_map['id_guru'] ?>" class="form-control" name="id_guru">
                            <div id="jumlah_soal"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Waktu</label>
                            <input type="number" id="" class="form-control" name="waktu" placeholder="Dalam Menit (>=60Menit)">
                        </div>
                        <div class="form-group">
                            <label for="">Tingkat</label>
                            <select name="tingkat" id="tingkat_tambah" class="form-control">
                                <?php
                                while ($rt=$tingkat->fetch()){
                                    ?>
                                    <option value="<?php echo $rt['id_tingkat'] ?>"><?php echo $rt['keterangan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select name="kelas" id="kelas_tambah" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="">Pengacakan</label>
                            <select name="pengacakan" id="" class="form-control">
                                <option value="acak">Acak Soal</option>
                                <option value="urut">Urut Soal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn sbold blue" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="edit" class="modal modal-primary fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div id="edit_ujian"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn sbold blue" name="update">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])){
        $nama_ujian = $_POST['nama_ujian'];
        $mapel = $_POST['mapel'];
        $kelas=$_POST['kelas'];
        $id_guru = $_POST['id_guru'];
        $jumlah_soal = $_POST['jumlah_soal'];
        $pengacakan = $_POST['pengacakan'];
        $waktu = $_POST['waktu'];
        $token = get_token(5);

        $a = $pdo->prepare("select * from tb_soal where id_guru='$id_guru' and id_mapel='$mapel'");
        $a->execute();
        $b = $a->rowCount();

        if ($jumlah_soal <=0 ){
            echo "<script>alert('Maaf,anda tidak bisa membuat ujian ini!!')</script>";
        }else{
            if ($waktu< 60){
                echo "<script>alert('Waktu pengerjaan harus lebih atau sama dengan 60 menit')</script>";
            }else {
                $query = $pdo->prepare("INSERT INTO set_ujian (id_guru, id_mapel, nama_ujian,id_kelas, jumlah_soal,waktu,jenis, token) VALUES (:id_guru,:mapel,:nama_ujian,:kelas,:jumlah_soal,:waktu,:pengacakan,:token)");
                $query->bindParam(':id_guru', $id_guru);
                $query->bindParam(':mapel', $mapel);
                $query->bindParam(':nama_ujian', $nama_ujian);
                $query->bindParam(':kelas', $kelas);
                $query->bindParam(':jumlah_soal', $jumlah_soal);
                $query->bindParam(':waktu', $waktu);
                $query->bindParam(':pengacakan', $pengacakan);
                $query->bindParam(':token', $token);
                $query->execute();
                echo "<script>window.location='?page=ujian'</script>";
            }
        }

    }elseif(isset($_POST['update'])){
        $id = $_POST['id_ujian'];
        $nama = $_POST['nama_ujian'];
        $kelas=$_POST['kelas'];
        $pengacakan = $_POST['pengacakan'];
        $waktu=$_POST['waktu'];
        if ($waktu<60){
            echo "<script>alert('Waktu pengerjaan harus lebih atau sama dengan 60 menit')</script>";
        }else {
            $q = $pdo->prepare("UPDATE set_ujian SET nama_ujian=:nama,jenis=:jenis,id_kelas=:kelas,waktu=:waktu WHERE id=:id");
            $q->bindParam(':id', $id);
            $q->bindParam(':nama', $nama);
            $q->bindParam(':jenis', $pengacakan);
            $q->bindParam(':kelas', $kelas);
            $q->bindParam(':waktu', $waktu);
            $q->execute();
            echo "<script>window.location='?page=ujian'</script>";
        }
    }elseif(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $ikut_ujian = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id'");
        $ikut_ujian->execute();
        while ($rdel = $ikut_ujian->fetch()){
            $iduji = $rdel['id_ujian'];
            $del = $pdo->prepare("delete from set_ikut_ujian WHERE id_ujian='$iduji'");
            $del->execute();
        }
        $id_del = $pdo->prepare("delete from set_ujian where id='$id'");
        $id_del->execute();
        echo "<script>window.location='?page=ujian'</script>";
    }
}elseif(isset($_SESSION['siswa'])) {
    if(isset($_GET['page']) == 'ujian' && isset($_GET['detail_ujian'])) {
        $nis = $_SESSION['nis'];
        $id = $pdo->prepare("select * from tb_siswa where nis='$nis'");
        $id->execute();
        $row_id = $id->fetch();
        $id_siswa = $row_id['id_siswa'];

        $id_detail = $_GET['detail_ujian'];

        /*$soal = $pdo->prepare("select * from set_ujian where id='$id_detail'");
        $soal->execute();
        $rs=$soal->fetch();
        $idmap=$rs['id_mapel'];
        $idgur=$rs['id_guru'];
        $soalnya=$pdo->prepare("select * from tb_soal where id_guru='$idgur' and id_mapel='$idmap'");
        $soalnya->execute();*/

        $soalnya=$pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_detail' and id_siswa='$id_siswa'");
        $soalnya->execute();

        ?>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script>
            $(document).on('click','#jawaban',function () {
                var id_soal = $(this).data('id');

                $.ajax({
                    type:'post',
                    url:'ajax/ujian/detail_jawab.php',
                    data:'id_soal='+id_soal,
                    cache:false,
                    success:function (e) {
                        $('#detail_jawaban').html(e);
                    }
                })
            })
        </script>

        <div id="dtl_jwb" class="modal modal-primary fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detail Jawaban</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">
                        <div id="detail_jawaban"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="" data-dismiss="modal" class="btn sbold blue">Tutup</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form id="frmSoal" action="" method="post">
                <?php
                $no=1;
                while ($row_s = $soalnya->fetch()) {
                    $idsoal = $row_s['id_soal'];
                    $jawaban=$row_s['jawaban'];

                    $soal=$pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                    $soal->execute();
                    $row_soal=$soal->fetch();
                    ?>
                    <br>
                    <div class="row">
                        <div class="pull-left">
                            <strong><?php echo 'Soal Nomor : ' . $no++ ?></strong>
                        </div>
                        <div class="pull-right">
                            <?php
                            if ($row_soal['jawaban']==$jawaban){
                                ?>
                                <i style="color: green" class="fa fa-check"></i> <strong style="color: green;">Jawaban Terpilih : <?php echo $jawaban ?></strong>
                            <?php
                            }else{
                                ?>
                                <i style="color: red;" class="fa fa-times"></i> <strong style="color:red">Jawaban Terpilih : <?php echo $jawaban ?></strong>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <p><?php echo $row_soal['soal'] ?></p>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>"
                                   value="A"
                                   class="radiojawab"
                            <?php echo $row_soal['jawaban']=='A'?'checked':'disabled' ?>>
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>">
                                <div class="huruf_opsi">A</div>
                                <p><?php echo $row_soal['opsi_a'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>"
                                   value="B"
                                   class="radiojawab"
                                <?php echo $row_soal['jawaban']=='B'?'checked':'disabled' ?>>
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>">
                                <div class="huruf_opsi">B</div>
                                <p><?php echo $row_soal['opsi_b'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>"
                                   value="C"
                                <?php echo $row_soal['jawaban']=='C'?'checked':'disabled' ?>>
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_c'] ?>">
                                <div class="huruf_opsi">C</div>
                                <p><?php echo $row_soal['opsi_c'] ?></p></label>
                        </div>
                    </div>
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                   id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>"
                                   value="D"
                                <?php echo $row_soal['jawaban']=='D'?'checked':'disabled' ?>>
                            <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_d'] ?>">
                                <div class="huruf_opsi">D</div>
                                <p><?php echo $row_soal['opsi_d'] ?></p></label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <a id="jawaban" data-id="<?php echo $idsoal ?>" data-target="#dtl_jwb" data-toggle="modal" class="btn sbold blue"><i class="fa fa-eye"></i> Detail Jawaban</a>
                    </div>
                    <br>
                <?php
                }
                ?>
            </form>
        </div>
        <?php
    }elseif(isset($_GET['page']) == 'ujian' && isset($_GET['tes_ujian'])) {
        if (isset($_SESSION['ujian']) && isset($_SESSION['mulai'])) {

            if (isset($_SESSION["mulai"])) {
                //jika session sudah ada
                $telah_berlalu = time() - $_SESSION["mulai"];
            }

            $id_uji = $_GET['tes_ujian'];

            $sql    = $pdo->prepare("select * from set_ujian where id='$id_uji'");
            $sql->execute();
            $data   = $sql->fetch();

            $temp_waktu = ($data['waktu']*60) - @$telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
            $temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
            $temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik
            if ($temp_menit < 60) {
                /* Apabila $temp_menit yang kurang dari 60 meni */
                $jam    = 0;
                $menit  = $temp_menit;
                $detik  = $temp_detik;
            } else {
                /* Apabila $temp_menit lebih dari 60 menit */
                $jam    = (int)($temp_menit/60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer
                $menit  = $temp_menit%60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
                $detik  = $temp_detik;
            }


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
                <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                <!-- Script Timer -->
                <script type="text/javascript">
                    $(document).ready(function() {
                        /** Membuat Waktu Mulai Hitung Mundur Dengan
                         * var detik;
                         * var menit;
                         * var jam;
                         */
                        var detik   = <?= $detik; ?>;
                        var menit   = <?= $menit; ?>;
                        var jam     = <?= $jam; ?>;

                        /**
                         * Membuat function hitung() sebagai Penghitungan Waktu
                         */
                        function hitung() {
                            /** setTimout(hitung, 1000) digunakan untuk
                             * mengulang atau merefresh halaman selama 1000 (1 detik)
                             */
                            setTimeout(hitung,1000);

                            /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                            if(menit < 10 && jam == 0){
                                var peringatan = 'style="color:red"';
                            };

                            /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                            $('#timer').html(
                                '<h1 align="center"'+peringatan+'>Sisa waktu anda <br />' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h1><hr>'
                            );

                            /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                            detik --;

                            /** Jika var detik < 0
                             * var detik akan dikembalikan ke 59
                             * Menit akan Berkurang 1
                             */
                            if(detik < 0) {
                                detik = 59;
                                menit --;

                                /** Jika menit < 0
                                 * Maka menit akan dikembali ke 59
                                 * Jam akan Berkurang 1
                                 */
                                if(menit < 0) {
                                    menit = 59;
                                    jam --;

                                    /** Jika var jam < 0
                                     * clearInterval() Memberhentikan Interval dan submit secara otomatis
                                     */

                                    if(jam < 0) {
                                        clearInterval(hitung);
                                        /** Variable yang digunakan untuk submit secara otomatis di Form */
                                        var formSoal = document.getElementById("frmSoal");
                                        formSoal.submit();
                                    }
                                }
                            }
                        }
                        /** Menjalankan Function Hitung Waktu Mundur */
                        hitung();
                    });
                </script>
                <div class="col-md-12">
                    <div id="timer"></div>
                </div>
                <div class="col-md-12">
                    <form id="frmSoal" action="" method="post">
                        <?php
                        while ($row_soal = $soalnya->fetch()) {
                            $idsoal = $row_soal['id_soal'];
                            $q_id = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                            $q_id->execute();
                            ?>
                            <br>
                            <strong><?php echo 'Soal Nomor : ' . $no++ ?></strong>
                            <p><?php echo $row_soal['soal'] ?></p>
                            <div class="funkyradio">
                                <div class="funkyradio-success">
                                    <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                           id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>"
                                           value="A"
                                           class="radiojawab">
                                    <label for="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_a'] ?>">
                                        <div class="huruf_opsi">A</div>
                                        <p><?php echo $row_soal['opsi_a'] ?></p></label>
                                </div>
                            </div>
                            <div class="funkyradio">
                                <div class="funkyradio-success">
                                    <input type="radio" name="<?php echo $row_soal['id_soal'] ?>"
                                           id="radio<?php echo $row_soal['id_soal'] . '_' . $row_soal['opsi_b'] ?>"
                                           value="B"
                                           class="radiojawab">
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
                        $jwb_benar = $pdo->prepare("select * from set_ikut_ujian where id_soal='$idsoal' and id_siswa='$id_siswa' and id_ujian='$id_uji'");
                        $jwb_benar->execute();
                        $row_jb = $jwb_benar->fetch();

                        $bobot = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                        $bobot->execute();
                        $row_b = $bobot->fetch();
                        $bobotnya = $row_b['bobot'];

                        if ($jawab == $row_jb['kunci_jawaban']) {
                            $jml_benar = 1;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa and id_ujian='$id_uji'");
                            $queri->bindParam(':jawab', $jawab);
                            $queri->bindParam(':jml_benar', $jml_benar);
                            $queri->bindParam(':nilai', $bobotnya);
                            $queri->bindParam(':id_soal', $idsoal);
                            $queri->bindParam(':id_siswa', $id_siswa);
                            $queri->execute();
                        } else {
                            $jml_benar = 0;
                            $bobot = 0;
                            $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa and id_ujian='$id_uji'");
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

                        $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_uji' and id_siswa='$n' and jml_benar='1' and id_ujian='$id_uji'");
                        $tot_nilai->execute();
                        $t = 0;
                        while ($t_nilai = $tot_nilai->fetch()) {
                            $t = $t + $t_nilai['nilai'];
                            $kuery = $pdo->prepare("update set_ikut_ujian set nilai_akhir=:t where id_ujian='$id_uji' and id_siswa='$n' and id_ujian='$id_uji'");
                            $kuery->bindParam(':t', $t);
                            $kuery->execute();
                        }
                        unset($_SESSION['ujian']);

                        ?>
                            <script>window.location ="?page=ujian"</script>
                            <?php
                            }
                        }
                        ?>
                        <br>
                        <button type="submit" name="simpan" class="btn sbold blue btn-block" style="display: block">Simpan</button>
                    </form>
                </div>
                <?php
            } elseif($u['jenis']=='urut') {
                $soalnya = $pdo->prepare("select * from tb_soal where id_guru='$idguru' and id_mapel='$idmapel' ORDER BY id_soal ASC ");
                $soalnya->execute();
                $no = 1;
                ?>
                <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                <!-- Script Timer -->
                <script type="text/javascript">
                    $(document).ready(function() {
                        /** Membuat Waktu Mulai Hitung Mundur Dengan
                         * var detik;
                         * var menit;
                         * var jam;
                         */
                        var detik   = <?= $detik; ?>;
                        var menit   = <?= $menit; ?>;
                        var jam     = <?= $jam; ?>;

                        /**
                         * Membuat function hitung() sebagai Penghitungan Waktu
                         */
                        function hitung() {
                            /** setTimout(hitung, 1000) digunakan untuk
                             * mengulang atau merefresh halaman selama 1000 (1 detik)
                             */
                            setTimeout(hitung,1000);

                            /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                            if(menit < 10 && jam == 0){
                                var peringatan = 'style="color:red"';
                            };

                            /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                            $('#timer').html(
                                '<h1 align="center"'+peringatan+'>Sisa waktu anda <br />' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h1><hr>'
                            );

                            /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                            detik --;

                            /** Jika var detik < 0
                             * var detik akan dikembalikan ke 59
                             * Menit akan Berkurang 1
                             */
                            if(detik < 0) {
                                detik = 59;
                                menit --;

                                /** Jika menit < 0
                                 * Maka menit akan dikembali ke 59
                                 * Jam akan Berkurang 1
                                 */
                                if(menit < 0) {
                                    menit = 59;
                                    jam --;

                                    /** Jika var jam < 0
                                     * clearInterval() Memberhentikan Interval dan submit secara otomatis
                                     */

                                    if(jam < 0) {
                                        clearInterval(hitung);
                                        /** Variable yang digunakan untuk submit secara otomatis di Form */
                                        var formSoal = document.getElementById("frmSoal");
                                        formSoal.submit();
                                    }
                                }
                            }
                        }
                        /** Menjalankan Function Hitung Waktu Mundur */
                        hitung();
                    });
                </script>
                <div class="col-md-12">
                    <div id="timer"></div>
                </div>
                <div class="col-md-12">
                    <form action="" method="post">
                        <?php
                        while ($row_soal = $soalnya->fetch()) {
                            $idsoal = $row_soal['id_soal'];
                            $q_id = $pdo->prepare("select * from tb_soal where id_soal='$idsoal'");
                            $q_id->execute();
                            ?>
                            <br>
                            <strong><?php echo 'Soal Nomor : '.$no++ ?></strong>
                            <p><?php echo $row_soal['soal'] ?></p>
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
                                    $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa and id_ujian='$id_uji'");
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
                                    $queri = $pdo->prepare("UPDATE set_ikut_ujian SET jawaban=:jawab,jml_benar=:jml_benar,nilai=:nilai WHERE id_soal=:id_soal AND id_siswa=:id_siswa and id_ujian='$id_uji'");
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

                                $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$id_uji' and id_siswa='$n' and jml_benar='1' and id_ujian='$id_uji'");
                                $tot_nilai->execute();
                                $t = 0;
                                while ($t_nilai = $tot_nilai->fetch()) {
                                    $t = $t + $t_nilai['nilai'];
                                    $kuery = $pdo->prepare("update set_ikut_ujian set nilai_akhir=:t where id_ujian='$id_uji' and id_siswa='$n' and id_ujian='$id_uji'");
                                    $kuery->bindParam(':t', $t);
                                    $kuery->execute();
                                }
                                unset($_SESSION['ujian']);
                                ?>
                            <script>window.location="?page=ujian"</script>
                                <?php

                            }
                        }
                        ?>
                        <br>
                        <button type="submit" name="simpan" class="btn sbold blue btn-block" style="display:block">Simpan</button>
                    </form>
                </div>
                <?php
            }
        }else{
            echo "<script>window.location='?page=ujian'</script>";
        }
    } else {
        $nis2 = $_SESSION['nis'];
        $id2 = $pdo->prepare("select * from tb_siswa where nis='$nis2'");
        $id2->execute();
        $row_id2 = $id2->fetch();
        $id_kelas = $row_id2['kelas'];

    $ujian = $pdo->prepare("SELECT * FROM set_ujian where id_kelas='$id_kelas'");
    $ujian->execute();
    if (@$_SESSION['ujian']){
        ?>
        <script>window.location="?page=ujian&tes_ujian=<?php echo $_SESSION['ujian'] ?>"</script>
        <?php
    }
    ?>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).on('click', '#id_token', function () {
            var id = $(this).data('id');
            var data = 'id=' + id;

            $.ajax({
                type: 'POST',
                url: 'ajax/ujian/cek_token.php',
                data: data,
                cache: false,
                success: function (e) {
                    $('.data').html(e);
                }
            })
        })
    </script>
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Data Ujian</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> No</th>
                                <th> Nama Ujian</th>
                                <th> Mata Pelajaran</th>
                                <th> Guru</th>
                                <th> Jumlah Soal</th>
                                <th> Status</th>
                                <th> Nilai</th>
                                <th> Pilihan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            while ($row = $ujian->fetch()) {
                                $id_mapel = $row['id_mapel'];
                                $id_guru = $row['id_guru'];
                                $idujian = $row['id'];

                                $siswa_nis = $_SESSION['nis'];
                                $siswa = $pdo->prepare("select * from tb_siswa where nis='$siswa_nis'");
                                $siswa->execute();
                                $rs = $siswa->fetch();
                                $n = $rs['id_siswa'];

                                $cek_status = $pdo->prepare("select * from set_ikut_ujian WHERE id_ujian='$idujian' and id_siswa='$n'");
                                $cek_status->execute();
                                $cs = $cek_status->rowCount();

                                $tot_nilai = $pdo->prepare("select * from set_ikut_ujian where id_ujian='$idujian' and id_siswa='$n' and jml_benar='1'");
                                $tot_nilai->execute();


                                $magur = $pdo->prepare("select * from set_mapel_guru where id_mapel='$id_mapel' and id_guru='$id_guru'");
                                $magur->fetch();
                                $row_magur = $magur->fetch();
                                $id_gurunya = $row['id_guru'];
                                $id_mapelnya = $row['id_mapel'];

                                $gurunya = $pdo->prepare("select * from tb_guru where id_guru='$id_gurunya' ORDER BY nama ASC ");
                                $gurunya->execute();
                                $row_gurunya = $gurunya->fetch();

                                $mapelnya = $pdo->prepare("select * from tb_mapel where id_mapel='$id_mapelnya'");
                                $mapelnya->execute();
                                $row_mapelnya = $mapelnya->fetch();

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['nama_ujian'] ?></td>
                                    <td><?php echo $row_mapelnya['nama'] ?></td>
                                    <td><?php echo $row_gurunya['nama'] ?></td>
                                    <td><?php echo $row['jumlah_soal'] ?> Soal</td>
                                    <td><?php echo $cs >= 1 ? 'Sudah Ikut' : 'Belum Ikut' ?></td>
                                    <td>
                                        <?php
                                        $t = 0;
                                        while ($t_nilai = $tot_nilai->fetch()) {
                                            $t = $t + $t_nilai['nilai'];
                                        }
                                        echo $t;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($cs >= 1) {
                                            ?>
                                            <a href="?page=ujian&detail_ujian=<?php echo $row['id'] ?>" class="btn btn-sm btn yellow">
                                                <i class="icon-eye"></i>&nbsp; Detail Ujian
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="btn btn-sm btn blue" id="id_token" data-target="#input_token"
                                               data-id="<?php echo $row['id'] ?>" data-toggle="modal">
                                                <i class="icon-pencil"></i>&nbsp; Ikuti Ujian
                                            </a>
                                            <?php
                                        }
                                        ?>
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
        </div>

        <!-- Modal Token -->
        <div id="input_token" class="modal modal-primary fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ikut Ujian</h4>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="data"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="token_cek" class="btn sbold blue" onclick="return confirm('Yakin ingin memulai ujian? Ujian hanya bisa dilakukan sekali saja,anda tidak bisa mengulang kembali ujian ini!!')">Mulai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['token_cek'])) {
            $idnya = $_POST['id'];
            if (@$_SESSION['ujian']){
                ?>
                <script>window.location='?page=ujian&tes_ujian=<?php echo $idnya ?>'</script>
                <?php
            }
            $tokennya = $_POST['tokennya'];
            $cek_token = $pdo->prepare("select * from set_ujian where id='$idnya' and token='$tokennya'");
            $cek_token->execute();
            $r_cek = $cek_token->fetch();
            $c = $cek_token->rowCount();

            if ($c >= 1) {
                $idujian = $r_cek['id'];//masukkan table set_ikut_ujian
                //buat session mulai ujian
                $_SESSION['ujian']=$idujian;
                $_SESSION['mulai']=time();

                $gnm = $pdo->prepare("select * from set_ujian where id='$idujian'");//cari idguru dan idmapel
                $gnm->execute();
                $row_gnm = $gnm->fetch();
                $guru_id=$row_gnm['id_guru'];
                $mapel_id=$row_gnm['id_mapel'];

                $s = $pdo->prepare("select * from tb_soal where id_guru='$guru_id' and id_mapel='$mapel_id'");
                $s->execute();

                while($row_s=$s->fetch()){
                    $soal_id = $row_s['id_soal'];//masukkan table set_ikut_ujian
                    $kunci_jawaban = $row_s['jawaban'];//masukkan table set_ikut_ujian

                    $nisnya = $_SESSION['nis'];
                    $n=$pdo->prepare("select id_siswa from tb_siswa where nis='$nisnya'");
                    $n->execute();
                    $rn=$n->fetch();
                    $idsiswa=$rn['id_siswa'];//masukkan table set_ikut_ujian
                    $jawaban=null;//masukkan table
                    $jml_benar=null;//masukkan table
                    $nilai=null;//sama
                    $bobot_nilai=$row_s['bobot'];//sama
                    $nilai_akhir=0;

                    $kueri = $pdo->prepare("insert into set_ikut_ujian(id_ujian, id_siswa, id_soal, jawaban,kunci_jawaban, jml_benar, nilai, bobot_nilai,nilai_akhir) VALUES
                    (:idujian,:idsiswa,:soal_id,:jawaban,:kunci_jawaban,:jml_benar,:nilai,:bobot_nilai,:nilai_akhir)");
                    $kueri->bindParam(':idujian',$idujian);
                    $kueri->bindParam(':idsiswa',$idsiswa);
                    $kueri->bindParam(':soal_id',$soal_id);
                    $kueri->bindParam(':jawaban',$jawaban);
                    $kueri->bindParam(':kunci_jawaban',$kunci_jawaban);
                    $kueri->bindParam(':jml_benar',$jml_benar);
                    $kueri->bindParam(':nilai',$nilai);
                    $kueri->bindParam(':bobot_nilai',$bobot_nilai);
                    $kueri->bindParam(':nilai_akhir',$nilai_akhir);
                    $kueri->execute();
                }
                ?>
                <script>window.location='?page=ujian&tes_ujian=<?php echo $idujian?>'</script>
                <?php
            } else {
                echo "<script>alert('Token Salah')</script>";
            }
        }
    }
}