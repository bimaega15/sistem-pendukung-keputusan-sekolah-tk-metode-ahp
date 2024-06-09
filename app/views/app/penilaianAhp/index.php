<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penilaian AHP</h1>
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
                                    <i class="fa-solid fa-note-sticky"></i> Penilaian AHP
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fa-solid fa-list"></i> List Penilaian

                                        </div>
                                        <div class="card-body">
                                            <?php include_once 'partials/kriteria.php'  ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <i class="fa-solid fa-pen-to-square"></i> Penilaian
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn-hasil-perhitungan">
                                                        <i class="fa-solid fa-book-open"></i> Hasil Perhitungan
                                                    </button>

                                                    <button type="button" class="btn btn-primary btn-hitung">
                                                        <i class="fas fa-calculator"></i> Proses AHP
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <?php include_once 'partials/tab-content.php'  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>