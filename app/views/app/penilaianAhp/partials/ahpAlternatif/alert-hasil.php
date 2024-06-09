<?php
if (floatval($cr) <= 0.1) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil </strong> Hasil perbandingan matriks alternatif konsisten
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } else { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal</strong> Hasil perbandingan matriks alternatif tidak konsisten
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>