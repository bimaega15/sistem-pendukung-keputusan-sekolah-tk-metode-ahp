<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Matriks Perbandingan Antar Alternatif
    </h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Alternatif</th>
                <?php
                $no = 1;
                foreach ($matriksOriginal as $alternatif_id1 => $item1) { ?>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($matriksOriginal as $alternatif_id1 => $item1) { ?>
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
                        <td style="border: 1px solid #ddd; padding: 10px;"><?= $item; ?></td>
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