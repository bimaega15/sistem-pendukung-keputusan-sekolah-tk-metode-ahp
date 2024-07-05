<?php
$utils = new Utils();
$my_roles = $utils->cek_users_id_role();
$data['nama_roles'] = $my_roles;
?>
<div class="user_role" data-value="<?= $data['nama_roles'] ?>"></div>
<div class="user_role" data-value="Guru"></div>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Siswa</h1>
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
                                    <i class="fa-solid fa-note-sticky"></i> Siswa
                                </div>
                                <?php 
                                if (isset($my_roles['nama_roles']) && $my_roles['nama_roles'] != 'Guru'): ?>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-add">
                                            <i class="fa-solid fa-plus"></i> Tambah Data
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox-all" type="checkbox">
                                                    <label class="form-check-label">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor HP</th>
                                            <?php if (isset($data['nama_roles']) && $data['nama_roles'] != 'Guru'): ?>
                                                <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Diisi oleh JavaScript atau PHP -->
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
