<div class="tab-content" id="vert-tabs-tabContent">
    <div class="tab-pane text-left fade show active tab-content-section" data-tipe="kriteria" data-kriteria_id="" id="kriteria-tab-controls" data-id="kriteria-tab" role="tabpanel" aria-labelledby="kriteria-tab">
        <?php include 'ahpKriteria/ahp-kriteria.php' ?>
    </div>
    <?php
    foreach ($data['kriteria'] as $key => $item) { ?>
        <div class="tab-pane fade tab-content-section" data-id="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>" data-tipe="alternatif" data-kriteria_id="<?= $item['id'] ?>" id="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>_<?= $key ?>" role="tabpanel" aria-labelledby="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>">
            <?php include 'ahpKriteria/ahp-alternatif.php' ?>
        </div>
    <?php
    }
    ?>
</div>