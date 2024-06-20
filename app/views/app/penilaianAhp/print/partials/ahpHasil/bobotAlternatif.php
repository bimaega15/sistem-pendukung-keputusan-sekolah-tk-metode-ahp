<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Hasil Bobot Alternatif
    </h2>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Nama Alternatif</th>
                <?php
                foreach ($data['ahp_alternatif'] as $kriteria_id => $item) { ?>
                    <?php
                    $kodeKriteria = $data['kriteria'][$kriteria_id]['kode_kriteria'];
                    ?>
                    <th style="border: 1px solid #ddd; padding: 10px;">
                        <span data-toggle="tooltip" data-placement="top" title="<?= $data['toconvert_kriteria'][$kodeKriteria] ?>">
                            <?= $kodeKriteria ?>
                        </span>
                    </th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['bobot_alternatif'] as $alternatif_id => $item) { ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?= $data['alternatif'][$alternatif_id]['nama_profile'] ?></td>
                    <?php
                    foreach ($item as $kriteria_id => $value) { ?>
                        <td style="border: 1px solid #ddd; padding: 10px;"><?= Utils::formatRupiah($value) ?></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>