<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grafik Kriteria</h1>
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

            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link  <?= Utils::urlNow() == 'PerkembanganNilai' ? 'active' : 'bg-light' ?>" href="<?= BASEURL ?>/PerkembanganNilai">Perkembangan Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  <?= Utils::urlNow() == 'GrafikKriteria' ? 'active' : 'bg-light' ?>" href="<?= BASEURL ?>/GrafikKriteria">Grafik Kriteria</a>
                        </li>
                    </ul>
                    <?php
                    if ($data['hasil_akhir'] == null) { ?>
                        <div class="card">
                            <div class="card-header">
                                <strong><i class="fa-solid fa-circle-info"></i> Informasi</strong>
                            </div>
                            <div class="card-body">
                                <h5>Anda belum melakukan Penilaian AHP</h5>
                            </div>
                        </div>
                    <?php
                    } else { ?>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-simple"></i> Grafik Kriteria
                            </div>
                            <div class="card-body">
                                <canvas id="grafik_kriteria"></canvas>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>