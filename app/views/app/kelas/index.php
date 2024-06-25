<?php
$utils = new Utils();
$my_roles = $utils->cek_users_id_role();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelas</h1>
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
                                if ($data['namaRoles'] == 'Admin') { ?>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-add">
                                            <i class="fa-solid fa-plus"></i> Tambah Data
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            
                                            <th>Tingkat Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Nama Guru</th>
                                            <th>Siswa</th>
                                            <?php
                                            if ($data['namaRoles'] == 'Admin') { ?>
                                                <th>Action</th>

                                            <?php
                                            }
                                            ?>
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