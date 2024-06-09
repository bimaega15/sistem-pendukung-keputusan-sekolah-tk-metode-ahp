<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Siswa</h1>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="fa-solid fa-note-sticky"></i> Nilai Siswa
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <?php
                                    if ($rowKelas != null) { ?>
                                        <div class="table-responsive">
                                            <table class="w-100">
                                                <tr>
                                                    <td>Tingkat</td>
                                                    <td>:</td>
                                                    <td><?= $rowKelas['tingkat_kelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Kelas</td>
                                                    <td>:</td>
                                                    <td><?= $rowKelas['nama_kelas'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="table-responsive">
                                            <table class="w-100">
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td>:</td>
                                                    <td>Semua Kelas</td>
                                                </tr>
                                            </table>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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