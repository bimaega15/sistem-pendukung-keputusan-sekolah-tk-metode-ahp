<?php
$bobotPrioritasKriteria = $data['ahp_kriteria']['perhitungan_bobot_prioritas'];
$jumlahBobotPrioritasKriteriaMetode = $data['ahp_kriteria']['jumlah_perhitungan_bobot_prioritas'];
$bobotPrioritasAlternatif = $data['ahp_alternatif'];
$jumlahBobotPrioritasAlternatifMetode = $data['ahp_alternatif']
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Hasil Akhir</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?php include_once 'partials/ahpHasil/bobotKriteria.php' ?>
    <?php include_once 'partials/ahpHasil/bobotAlternatif.php' ?>
    <?php include_once 'partials/ahpHasil/hasilAkhir.php' ?>
    <?php include_once 'partials/ahpHasil/ranking.php' ?>
</body>

</html>