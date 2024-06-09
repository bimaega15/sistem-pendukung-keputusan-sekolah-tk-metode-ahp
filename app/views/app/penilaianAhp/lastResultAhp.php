<?php
$bobotPrioritasKriteria = $data['ahp_kriteria']['perhitungan_bobot_prioritas'];
$jumlahBobotPrioritasKriteriaMetode = $data['ahp_kriteria']['jumlah_perhitungan_bobot_prioritas'];
$bobotPrioritasAlternatif = $data['ahp_alternatif'];
$jumlahBobotPrioritasAlternatifMetode = $data['ahp_alternatif']

?>
<div class="modal-body">
    <div class="accordion" id="accordionExample">
        <?php include_once 'partials/ahpHasil/bobotKriteria.php' ?>
        <?php include_once 'partials/ahpHasil/bobotAlternatif.php' ?>
        <?php include_once 'partials/ahpHasil/hasilAkhir.php' ?>
        <?php include_once 'partials/ahpHasil/ranking.php' ?>
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