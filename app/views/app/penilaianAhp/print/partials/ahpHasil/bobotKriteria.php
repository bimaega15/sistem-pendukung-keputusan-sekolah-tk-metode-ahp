<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Hasil Bobot Kriteria
    </h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Kriteria</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Bobot Kriteria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($bobotPrioritasKriteria as $kriteria_id => $item) { ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= $data['kriteria'][$kriteria_id]['nama_kriteria'] ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= Utils::formatRupiah($item); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>