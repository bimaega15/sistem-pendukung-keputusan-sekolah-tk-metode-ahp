<div class="card">
    <h2 style="background-color: antiquewhite; padding: 10px;">
        Hasil Perhitungan AHP
    </h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">CI</th>
                <th style="border: 1px solid #ddd; padding: 10px;">CR</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= Utils::formatRupiah($ci); ?></td>
                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?= Utils::formatRupiah($cr); ?></td>
            </tr>
        </tbody>
    </table>
</div>