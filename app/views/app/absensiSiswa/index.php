<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi Siswa</h1>
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
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link <?= Utils::urlFormat(Utils::urlNow()) == 'AbsensiSiswa' ? 'active' : '' ?>" href="<?= BASEURL ?>/AbsensiSiswa?siswa_id=<?= $data['siswa']['id'] ?>">Absensi Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= Utils::urlFormat(Utils::urlNow()) == 'LaporanAbsensi' ? 'active' : '' ?>" href="<?= BASEURL ?>/LaporanAbsensi?siswa_id=<?= $data['siswa']['id'] ?>">Laporan Absensi</a>
                        </li>
                    </ul>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="fa-solid fa-note-sticky"></i>Absensi Siswa
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary btn-add" data-url="<?= BASEURL ?>/AbsensiSiswa/create?siswa_id=<?= $data['siswa']['id'] ?>">
                                        <i class="fa-solid fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <table class="w-100">
                                            <tr>
                                                <td class="w-25">Nama</td>
                                                <td>:</td>
                                                <td><?= $data['siswa']['nama_profile'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. HP</td>
                                                <td>:</td>
                                                <td><?= $data['siswa']['nomorhp_profile'] ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="w-100">
                                            <tr>
                                                <td class="w-25">Kode Profile</td>
                                                <td>:</td>
                                                <td><?= $data['siswa']['kode_profile'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td><?= $data['siswa']['jeniskelamin_profile'] == 'L' ? 'Laki - laki' : 'Perempuan' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Absensi</th>
                                            <th>Keterangan</th>
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