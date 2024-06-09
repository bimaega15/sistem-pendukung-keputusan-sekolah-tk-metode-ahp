<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
    <?php
    if ($data['namaRoles'] == 'Admin') { ?>
        <a class="nav-link tab-kriteria active" id="kriteria-tab" data-toggle="pill" href="#kriteria-tab-controls" role="tab" aria-controls="kriteria-tab-controls" data-tipe="kriteria" data-kriteria_id="" aria-selected="true">Kriteria</a>
    <?php
    }
    ?>

    <?php
    foreach ($data['kriteria'] as $key => $item) { ?>
        <a class="nav-link tab-kriteria" data-tipe="alternatif" data-kriteria_id="<?= $item['id'] ?>" id="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>" data-toggle="pill" href="#<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>_<?= $key ?>" role="tab" aria-controls="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>_<?= $key ?>" aria-selected="false">
            <?= $item['nama_kriteria'] ?>
        </a>
    <?php
    }
    ?>
    <a class="nav-link tab-result-kriteria bg-primary" id="result-kriteria-tab" data-toggle="pill" href="#result-kriteria-tab-controls" role="tab" aria-controls="result-kriteria-tab-controls" aria-selected="true">
        <strong class="text-white">
            Hasil Akhir
        </strong>
    </a>
</div>