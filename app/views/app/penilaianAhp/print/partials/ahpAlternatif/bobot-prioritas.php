<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Perhitungan Bobot Prioritas
    </h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Alternatif</th>
                <?php
                $no = 1;
                foreach ($matriksNormalisasi as $alternatif_id1 => $item1) { ?>
                    <?php
                    $kodeProfile = $data['alternatif'][$alternatif_id1]['kode_profile'];
                    ?>
                    <th style="border: 1px solid #ddd; padding: 10px;">
                        <span data-toggle="tooltip" data-placement="top" title="<?= $data['toconvert_alternatif'][$kodeProfile] ?>">
                            <?= $kodeProfile ?>
                        </span>
                    </th>
                <?php
                }
                ?>
                <th style="border: 1px solid #ddd; padding: 10px;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jumlahBobotPrioritas = [];
            foreach ($matriksNormalisasi as $alternatif_id1 => $item1) { ?>
                <?php
                $kodeProfile = $data['alternatif'][$alternatif_id1]['kode_profile'];
                ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_alternatif'][$kodeProfile] ?>">
                            <?= $kodeProfile ?>
                        </span>
                    </td>
                    <?php
                    foreach ($item1 as $alternatif_id2 => $item) { ?>
                        <?php
                        $jumlahBobotPrioritas[$alternatif_id2][$alternatif_id1] = $item;
                        ?>
                        <td style="border: 1px solid #ddd; padding: 10px;"><?= Utils::formatRupiah($item); ?></td>
                    <?php
                    }
                    ?>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?= Utils::formatRupiah($bobotPrioritas[$alternatif_id1]) ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px;"><strong>Jumlah</strong></td>
                <?php
                foreach ($jumlahBobotPrioritas as $alternatif_id2 => $item) { ?>
                    <?php
                    $sum = array_sum($item);
                    ?>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <strong><?= $sum ?></strong>
                    </td>
                <?php
                }
                ?>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?= ($jumlahBobotPrioritasMetode) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>