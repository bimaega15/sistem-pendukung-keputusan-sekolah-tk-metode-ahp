<h2 style="background-color: antiquewhite; padding: 10px;">
    Matriks Perbandingan Antar Kriteria
</h2>
<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 10px;">Alternatif</th>
            <?php
            foreach ($data['alternatif'] as $key => $item) { ?>
                <th style="border: 1px solid #ddd; padding: 10px;">
                    <span data-toggle="tooltip" data-placement="top" title="<?= $data['toconvert_alternatif'][$item['kode_profile']] ?>">
                        <?= $item['kode_profile'] ?>
                    </span>
                </th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data['value_matrix_alternatif'] as $kode_profile => $value) { ?>
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_alternatif'][$kode_profile] ?>">
                        <?= $kode_profile ?>
                    </span>
                </td>
                <?php
                foreach ($value as $keyRow => $row) { ?>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?= $row; ?></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>