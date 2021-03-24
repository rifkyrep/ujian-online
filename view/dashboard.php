<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 20/06/2017
 * Time: 15.12
 */
if (isset($_SESSION['siswa'])) {
    ?>
    <div class="page-content-inner">
        <div class="note note-info">
            <p> Selamat datang
                <?php echo $u['nama'] ?>
                di Aplikasi MBi Ujian. </p>
        </div>
        <div class="note note-info">
            <p>Selamat mengerjakan.</p>
        </div>
    </div>
    <?php
}elseif(isset($_SESSION['guru'])){
    ?>
    <div class="page-content-inner">
        <div class="note note-info">
            <p> Selamat datang
                <?php echo $u['nama'] ?>
                di Aplikasi MBi Ujian. </p>
        </div>
        <div class="note note-info">
            <p>Buat Ujian untuk memulai ujian</p>
        </div>
    </div>
<?php
}elseif(isset($_SESSION['admin'])){
    ?>
    <div class="page-content-inner">
        <div class="note note-info">
            <p> Selamat datang
                <?php echo strtoupper( $u['username']) ?>
                di Aplikasi MBi Ujian. </p>
        </div>
    </div>
<?php
}
?>