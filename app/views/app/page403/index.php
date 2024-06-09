<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">403 Error Page</h1>
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
                        <div class="card-body">
                            <div class="error-page">
                                <h2 class="headline text-danger"> 403</h2>

                                <div class="error-content">
                                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Anda tidak dapat mengakses halaman ini</h3>

                                    <p>
                                        Kembali Ke <a href="<?= BASEURL ?>/Dashboard">Dashboard</a>
                                    </p>
                                </div>
                                <!-- /.error-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>