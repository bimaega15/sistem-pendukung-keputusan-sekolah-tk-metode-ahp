<?php
$matriksOriginal = $data['ahp_kriteria']['matriks_perbandingan_original'];
$matriksNormalisasi = $data['ahp_kriteria']['normalisasi'];
$dataAhpKriteria = $data['ahp_kriteria'];
$rowNormalisasi = $data['ahp_kriteria']['row_normalisasi'];
$eigenMax = $data['ahp_kriteria']['eigen_max'];
$bobotPrioritas = $data['ahp_kriteria']['perhitungan_bobot_prioritas'];
$jumlahBobotPrioritasMetode = $data['ahp_kriteria']['jumlah_perhitungan_bobot_prioritas'];
$ci = $data['ahp_kriteria']['ci'];
$cr = $data['ahp_kriteria']['cr'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Perhitungan Kriteria</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?php include_once 'partials/ahpKriteria/alert-hasil.php' ?>
    <?php include_once 'partials/ahpKriteria/matriks-kriteria.php' ?>
    <?php include_once 'partials/ahpKriteria/matriks-normalisasi.php' ?>
    <?php include_once 'partials/ahpKriteria/bobot-prioritas.php' ?>
    <?php include_once 'partials/ahpKriteria/nilai-eigen.php' ?>
    <?php include_once 'partials/ahpKriteria/hasil-ahp.php' ?>
</body>

</html>