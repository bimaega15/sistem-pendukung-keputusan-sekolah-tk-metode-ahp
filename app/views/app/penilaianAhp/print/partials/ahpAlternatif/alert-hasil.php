<?php
if (floatval($cr) <= 0.1) { ?>
    <p style="font-size: 24px; margin:0; padding:0;">
        <strong>Berhasil </strong> Hasil perbandingan matriks alternatif konsisten
    </p>
<?php } else { ?>
    <p style="font-size: 24px; margin:0; padding:0; ">
        <strong>Gagal</strong> Hasil perbandingan matriks alternatif tidak konsisten
    </p>
<?php
}
?>