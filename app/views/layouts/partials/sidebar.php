<?php
$utils = new Utils();
$myProfile = $utils->myProfile();
$settingApp = $utils->settingApp();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASEURL ?>/Dashboard" class="brand-link">
        <img src="<?= BASEURL ?>/uploads/pengaturan/<?= $settingApp['gambar_pengaturan'] ?>" alt="SPK AHP" class="brand-image img-circle elevation-3" style="opacity: .8; width: 40px; height: 40px;">
        <span class="brand-text font-weight-light">SPK AHP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= BASEURL ?>/public/image/<?= $myProfile['jeniskelamin_profile'] == 'L' ? 'male.png' : 'female.png' ?>" class="img-circle elevation-2" alt="<?= $myProfile['jeniskelamin_profile'] == 'L' ? 'male.png' : 'female.png' ?>" style="width: 40px; height: 40px;">
            </div>
            <div class="info">
                <a href="<?= BASEURL ?>/Profile" class="d-block"><?= $myProfile['nama_profile'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU</li>
                <?php
                $allowData = ['Admin', 'Guru', 'Orang Tua'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Dashboard" class="nav-link <?= Utils::urlNow() == 'Dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php  } ?>


                <?php
                $allowData = ['Admin', 'Guru'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>

                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Profile" class="nav-link <?= Utils::urlNow() == 'Profile' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                <?php } ?>


                <?php
                $allowData = ['Orang Tua'];
                if (!in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/PenilaianAhp" class="nav-link <?= Utils::urlNow() == 'PenilaianAhp' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-note-sticky"></i>
                            <p>
                                Penilaian AHP
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $allowData = ['Orang Tua'];
                if (!in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-header">DATA MASTER</li>
                <?php } ?>

                <?php
                $allowData = ['Admin', 'Guru'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Kelas" class="nav-link <?= Utils::urlNow() == 'Kelas' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-chalkboard-user"></i>
                            <p>
                                Data Kelas
                            </p>
                        </a>
                    </li>
                <?php } ?>


                <?php
                $allowData = ['Admin', 'Wali Murid'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/MataPelajaran" class="nav-link <?= Utils::urlNow() == 'MataPelajaran' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-book"></i>
                            <p>
                                Mata Pelajaran
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $allowData = ['Admin'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>

                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Kriteria" class="nav-link <?= Utils::urlNow() == 'Kriteria' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-note-sticky"></i>
                            <p>
                                Data Kriteria
                            </p>
                        </a>
                    </li>
                <?php } ?>


                <?php
                $includeUrlUser = [
                    'Siswa',
                    'Guru',
                    'waliMurid',
                    'Admin',
                ];
                $urlNow = Utils::urlNow();
                $menuOpenClass = (in_array($urlNow, $includeUrlUser)) ? 'menu-open' : '';
                $activeClass = (in_array($urlNow, $includeUrlUser)) ? 'active' : '';

                $activeClassSiswa = $urlNow == 'Siswa' ? 'active' : '';
                $activeClassGuru = $urlNow == 'Guru' ? 'active' : '';
                $activeClassWaliMurid = $urlNow == 'waliMurid' ? 'active' : '';
                $activeClassAdmin = $urlNow == 'Admin' ? 'active' : '';
                $activeClassOrangTua = $urlNow == 'OrangTua' ? 'active' : '';
                ?>

                <?php
                $allowData = ['Admin', 'Guru'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>

                    <li class="nav-item <?= $menuOpenClass; ?>">
                        <a href="#" class="nav-link <?= $activeClass; ?>">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                Data User
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <?php
                            $allowData = ['Admin', 'Guru'];
                            if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/Siswa" class="nav-link <?= $activeClassSiswa ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Siswa</p>
                                    </a>
                                </li>
                            <?php  } ?>


                            <?php
                            $allowData = ['Admin'];
                            if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/Guru" class="nav-link <?= $activeClassGuru ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Guru</p>
                                    </a>
                                </li>
                            <?php } ?>

                            <!-- <?php
                                    $allowData = ['Guru'];
                                    if (in_array($myProfile['nama_roles'], $allowData)) { ?>

                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/waliMurid" class="nav-link <?= $activeClassWaliMurid ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Wali Murid</p>
                                    </a>
                                </li>
                            <?php } ?> -->

                            <?php
                            $allowData = ['Admin'];
                            if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/Admin" class="nav-link <?= $activeClassAdmin ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Admin</p>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php
                            $allowData = ['Admin', 'Wali Murid'];
                            if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/OrangTua" class="nav-link <?= $activeClassOrangTua ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Orang Tua</p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php  } ?>

                <?php
                $allowData = ['Guru', 'Wali Murid'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-header">DATA NILAI</li>
                <?php } ?>

                <?php
                $allowData = ['Guru', 'Wali Murid', 'Orang Tua'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Nilai" class="nav-link <?= Utils::urlNow() == 'Nilai' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-pen-to-square"></i>
                            <p>
                                Data Nilai
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $allowData = ['Guru', 'Wali Murid', 'Orang Tua'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Absensi" class="nav-link <?= Utils::urlNow() == 'Absensi' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-list"></i>
                            <p>
                                Data Absensi
                            </p>
                        </a>
                    </li>
                <?php  } ?>

                <?php
                $allowData = ['Guru', 'Wali Murid', 'Orang Tua'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/PerkembanganNilai" class="nav-link <?= Utils::urlNow() == 'PerkembanganNilai' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-chart-simple"></i>
                            <p>
                                Grafik
                            </p>
                        </a>
                    </li>
                <?php  } ?>

                <li class="nav-header">Logout</li>

                <!-- <?php
                $allowData = ['Admin'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Pengaturan" class="nav-link <?= Utils::urlNow() == 'Pengaturan' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                <?php } ?> -->

                <!-- <?php
                $allowData = ['Admin'];
                if (in_array($myProfile['nama_roles'], $allowData)) { ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/Peran" class="nav-link <?= Utils::urlNow() == 'Peran' ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-user-secret"></i>
                            <p>
                                Peran
                            </p>
                        </a>
                    </li>
                <?php } ?> -->

                <li class="nav-item">
                    <a href="<?= BASEURL ?>/Logout" class="nav-link <?= Utils::urlNow() == 'Logout' ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>