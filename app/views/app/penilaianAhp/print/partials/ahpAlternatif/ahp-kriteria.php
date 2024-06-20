<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <?php
                foreach ($data['kriteria'] as $key => $item) { ?>
                <?php 
                $kodeKriteria =  $item['kode_kriteria'];
                ?>
                    <th>
                        <span data-toggle="tooltip" data-placement="top" title="<?= $data['toconvert_alternatif'][$kodeKriteria] ?>">
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
            foreach ($data['value_matrix'] as $kode_kriteria => $value) { ?>
             <?php 
                $kodeKriteria =  $kode_kriteria;
                ?>
                <tr>
                    <td>
                        <span data-toggle="tooltip" data-placement="left" title="<?= $data['toconvert_alternatif'][$kodeKriteria] ?>">
                            <?= $kodeKriteria ?>
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