<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
    <?php
    if ($data['namaRoles'] == 'Admin') { ?>
        <a class="nav-link tab-kriteria active" id="kriteria-tab" data-toggle="pill" href="#kriteria-tab-controls" role="tab" aria-controls="kriteria-tab-controls" data-tipe="kriteria" data-kriteria_id="" aria-selected="true">Kriteria</a>
    <?php
    }
    ?>

    <?php
    $utils = new Utils();
    $my_roles = $utils->cek_users_id_role();
    if (isset($my_roles['nama_roles']) && $my_roles['nama_roles'] === 'Guru'):
    foreach ($data['kriteria'] as $key => $item) { 
        $setActive = $key == 0 && $my_roles['nama_roles'] == 'Guru' ? 'active' : '';
        ?>
        <a class="nav-link tab-kriteria <?= $setActive ?>" data-tipe="alternatif" data-kriteria_id="<?= $item['id'] ?>" id="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>" data-toggle="pill" href="#<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>_<?= $key ?>" role="tab" aria-controls="<?= $item['kode_kriteria'] ?>_<?= $item['id'] ?>_<?= $key ?>" aria-selected="false">
            <?= $item['nama_kriteria'] ?>
        </a>
    <?php
    }
    endif;
    ?>
    <a class="nav-link tab-result-kriteria bg-primary mt-1" id="result-kriteria-tab" data-toggle="pill" href="#result-kriteria-tab-controls" role="tab" aria-controls="result-kriteria-tab-controls" aria-selected="true">
        <strong class="text-white">
            Hasil Akhir
        </strong>
    </a>
    <a class="nav-link tab-result-kriteria-print bg-danger mt-1" id="result-kriteria-tab-print" data-toggle="pill" href="#result-kriteria-tab-print-controls" role="tab" aria-controls="result-kriteria-tab-print-controls" aria-selected="true">
        <strong class="text-white">
            Cetak Hasil
        </strong>
    </a>
</div>