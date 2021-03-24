<?php
/**
 * Created by PhpStorm.
 * User: Rifky_Rep
 * Date: 22/06/2017
 * Time: 09.06
 *
 */
?>
<ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                <a id="edit_siswa" data-target="#edit" data-id="<?php echo $row['id_siswa'] ?>" data-toggle="modal">
                                                    <i class="icon-pencil"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="icon-trash"></i> Hapus </a>
                                            </li>
                                            <li>
                                                    <?php
                                                    if ($row['status']=='0') {
                                                        ?>
                                                        <a onclick="confirm('Yakin ingin mengaktifkan user ini? Username dan Password secara default sama dengan NIS')" href="?page=data_siswa&aktif=<?php echo $row['id_siswa'] ?>">
                                                            <i class="icon-user-following"></i> Aktifkan User
                                                        </a>
                                                        <?php
                                                    }elseif($row['status']=='1'){ ?>
                                                        <a href="?page=data_siswa&reset_pass=<?php echo $row['id_siswa'] ?>">
                                                            <i class="icon-shuffle"></i> Reset Password
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
</li>
</ul>