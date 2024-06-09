<div class="card">
    <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#ranking" aria-expanded="true" aria-controls="ranking">
                Perangkingan
            </button>
        </h2>
    </div>

    <div id="ranking" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Bobot</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data['ranking'] as $alternatif_id => $item) { ?>
                            <tr>
                                <td><?= $data['alternatif'][$alternatif_id]['nama_profile'] ?></td>
                                <td><?= Utils::formatRupiah($item) ?></td>
                                <td><?= $no++; ?></td>
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