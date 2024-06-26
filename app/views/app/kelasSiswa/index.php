<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelas Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?= Utils::generateBreadcrumb($data['breadcrumbs']) ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fa-solid fa-note-sticky"></i> Kelas
                                </div>

                                <?php
                                $allowedData = ['Admin', 'Guru'];
                                if (in_array($data['nama_roles'], $allowedData)) { ?>
                                    <div>
                                    <?php
                                if ($data['nama_roles'] != 'Admin') { ?>
                                        <a href="<?= BASEURL ?>/Absensi?kelasId=<?= $data['kelas_id'] ?>" class="btn btn-info">
                                            <i class="fa-solid fa-book"></i> Absensi Kelas
                                        </a>
                                        <?php
                                }
                                ?>
                                 <?php
                                if ($data['nama_roles'] != 'Admin') { ?>
                                        <a href="<?= BASEURL ?>/Nilai?kelasId=<?= $data['kelas_id'] ?>" class="btn btn-success">
                                            <i class="fa-regular fa-pen-to-square"></i>Nilai Kelas
                                        </a>
                                        <?php
                                }
                                ?>
                                        <?php
                                if ($data['nama_roles'] != 'Guru') { ?>
                                        <button type="button" class="btn btn-primary btn-add">
                                            <i class="fa-solid fa-plus"></i> Tambah Data
                                        </button>
                                        <?php
                                }
                                ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="w-100">
                                            <thead>
                                                <!-- <tr>
                                                    <td>Tingkat</td>
                                                    <td>:</td>
                                                    <td> -->
                                                        <?php //echo $data['kelas']['tingkat_kelas'] ?>
                                                    <!-- </td>
                                                </tr> -->
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td>:</td>
                                                    <td><?= $data['kelas']['nama_kelas'] ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Handphone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>