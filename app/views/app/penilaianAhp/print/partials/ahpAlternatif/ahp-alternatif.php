<strong> Matriks Perbandingan Alternatif <?= $item['nama_kriteria'] ?></strong>
<hr>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alternatif</th>
                <?php
                foreach ($data['alternatif'] as $key => $item) { ?>
                <?php 
                    $kodeProfile = $item['kode_profile'];
                    ?>
                    <th>
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
            foreach ($data['value_matrix_alternatif'] as $kode_profile => $value) { ?>
            <?php 
            $kodeProfile = $kode_profile;
            ?>
                <tr>
                    <td>
                        <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_alternatif'][$kodeProfile] ?>">
                            <?= $kodeProfile ?>
                        </span>
                    </td>
                    <?php
                    foreach ($value as $keyRow => $row) { ?>
                        <td><?= $row; ?></td>
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