<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Perangkingan
    </h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Nama Alternatif</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Bobot</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Ranking</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data['ranking'] as $alternatif_id => $item) { ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= $data['alternatif'][$alternatif_id]['nama_profile'] ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= Utils::formatRupiah($item) ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= $no++; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>