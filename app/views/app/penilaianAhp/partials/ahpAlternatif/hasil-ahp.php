<div class="card">
    <div class="card-header" id="headingFour">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#hasilPerhitunganAhp" aria-expanded="false" aria-controls="hasilPerhitunganAhp">
                Hasil Perhitungan AHP
            </button>
        </h2>
    </div>
    <div id="hasilPerhitunganAhp" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
        <div class="card-body">
            <?php
            include 'alert-hasil.php';
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>CR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= Utils::formatRupiah($ci); ?></td>
                            <td><?= Utils::formatRupiah($cr); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>