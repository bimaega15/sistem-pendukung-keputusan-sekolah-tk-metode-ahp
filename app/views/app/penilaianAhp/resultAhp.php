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
<div class="modal-body">
    <div class="accordion" id="accordionExample">
        <h4>
            Matriks Perbandingan Berdasarkan Kriteria: [<?= $data['kriteria']['kode_kriteria'] ?>] <?= $data['kriteria']['nama_kriteria'] ?>
        </h4>
        <hr>
        <?php include_once 'partials/ahpAlternatif/alert-hasil.php' ?>
        <?php include_once 'partials/ahpAlternatif/matriks-kriteria.php' ?>
        <?php include_once 'partials/ahpAlternatif/matriks-normalisasi.php' ?>
        <?php include_once 'partials/ahpAlternatif/bobot-prioritas.php' ?>
        <?php include_once 'partials/ahpAlternatif/nilai-eigen.php' ?>
        <?php include_once 'partials/ahpAlternatif/hasil-ahp.php' ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">
        <i class="fa-solid fa-check"></i> OK
    </button>
</div>


<script>
     $('[data-toggle="tooltip"]').tooltip();
</script>