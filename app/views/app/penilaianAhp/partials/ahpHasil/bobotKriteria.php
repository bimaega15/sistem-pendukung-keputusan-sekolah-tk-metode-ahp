<div class="card">
    <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#bobotKriteria" aria-expanded="true" aria-controls="bobotKriteria">
                Hasil Bobot Kriteria
            </button>
        </h2>
    </div>

    <div id="bobotKriteria" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bobotPrioritasKriteria as $kriteria_id => $item) { ?>
                            <tr>
                                <td><?= $data['kriteria'][$kriteria_id]['nama_kriteria'] ?></td>
                                <td><?= Utils::formatRupiah($item); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>