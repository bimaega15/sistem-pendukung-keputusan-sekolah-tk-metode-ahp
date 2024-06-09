<div class="card">
    <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#perhitunganBobotPrioritas" aria-expanded="false" aria-controls="perhitunganBobotPrioritas">
                Perhitungan Bobot Prioritas
            </button>
        </h2>
    </div>
    <div id="perhitunganBobotPrioritas" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <?php
                            $no = 1;
                            foreach ($matriksNormalisasi as $kriteria_id1 => $item1) { ?>
                            <?php 
                            $kodeKriteria = $data['kriteria'][$kriteria_id1]['kode_kriteria'];
                            ?>
                                <th>
                                    <span data-toggle="tooltip" data-placement="top" title="<?= $data['toconvert_kriteria'][$kodeKriteria]['nama_kriteria'] ?>">
                                        <?= $kodeKriteria ?>
                                    </span>
                                </th>
                            <?php
                            }
                            ?>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $jumlahBobotPrioritas = [];
                        foreach ($matriksNormalisasi as $kriteria_id1 => $item1) { ?>
                        <?php 
                        $kodeKriteria = $data['kriteria'][$kriteria_id1]['kode_kriteria'];
                        ?>
                            <tr>
                                <td>
                                    <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_kriteria'][$kodeKriteria]['nama_kriteria'] ?>">
                                        <?= $kodeKriteria ?>
                                    </span>
                                </td>
                                <?php
                                foreach ($item1 as $kriteria_id2 => $item) { ?>
                                    <?php
                                    $jumlahBobotPrioritas[$kriteria_id2][$kriteria_id1] = $item;
                                    ?>
                                    <td><?= Utils::formatRupiah($item); ?></td>
                                <?php
                                }
                                ?>
                                <td><?= Utils::formatRupiah($bobotPrioritas[$kriteria_id1]) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Jumlah</strong></td>
                            <?php
                            foreach ($jumlahBobotPrioritas as $kriteria_id2 => $item) { ?>
                                <?php
                                $sum = array_sum($item);
                                ?>
                                <td>
                                    <strong><?= $sum ?></strong>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                                <?= ($jumlahBobotPrioritasMetode) ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>