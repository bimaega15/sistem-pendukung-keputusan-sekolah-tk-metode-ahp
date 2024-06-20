<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <?php
                foreach ($data['kriteria'] as $key => $item) { ?>
                    <th>
                        <span data-toggle="tooltip" data-placement="top" title="<?= $item['nama_kriteria'] ?>">
                            <?= $item['kode_kriteria'] ?>
                        </span>
                    </th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['value_matrix'] as $kode_kriteria => $value) { ?>
                <tr>
                    <td>
                        <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_kriteria'][$kode_kriteria] ?>">
                            <?= $kode_kriteria ?>
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