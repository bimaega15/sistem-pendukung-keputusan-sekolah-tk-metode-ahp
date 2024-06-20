<?php
$matriksOriginal = $data['ahp_alternatif']['matriks_perbandingan_original'];
$matriksNormalisasi = $data['ahp_alternatif']['normalisasi'];
$dataAhpKriteria = $data['ahp_alternatif'];
$rowNormalisasi = $data['ahp_alternatif']['row_normalisasi'];
$eigenMax = $data['ahp_alternatif']['eigen_max'];
$bobotPrioritas = $data['ahp_alternatif']['perhitungan_bobot_prioritas'];
$jumlahBobotPrioritasMetode = $data['ahp_alternatif']['jumlah_perhitungan_bobot_prioritas'];
$ci = $data['ahp_alternatif']['ci'];
$cr = $data['ahp_alternatif']['cr'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Perhitungan Alternatif</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <h2 style="font-size: 24px; margin:0; padding:0;">
        Matriks Perbandingan Berdasarkan Kriteria: [<?= $data['kriteria']['kode_kriteria'] ?>] <?= $data['kriteria']['nama_kriteria'] ?>
    </h2>
    <hr>
    <?php include_once 'partials/ahpAlternatif/alert-hasil.php' ?>
    <?php include_once 'partials/ahpAlternatif/matriks-kriteria.php' ?>
    <?php include_once 'partials/ahpAlternatif/matriks-normalisasi.php' ?>
    <?php include_once 'partials/ahpAlternatif/bobot-prioritas.php' ?>
    <?php include_once 'partials/ahpAlternatif/nilai-eigen.php' ?>
    <?php include_once 'partials/ahpAlternatif/hasil-ahp.php' ?>
</body>

</html>