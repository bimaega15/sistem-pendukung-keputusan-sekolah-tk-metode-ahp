<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <input type="hidden" name="is_edit" value="<?= isset($data['row']) ? true ?? '' : '' ?>">
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Nama Aplikasi</label>
                    <input type="text" name="nama_pengaturan" class="form-control" placeholder="Nama aplikasi..." value="<?= isset($data['row']) ? $data['row']['nama_pengaturan'] ?? '' : '' ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Pembuat Aplikasi</label>
                    <input type="text" name="pembuat_pengaturan" class="form-control" placeholder="Pembuat aplikasi..." value="<?= isset($data['row']) ? $data['row']['pembuat_pengaturan'] ?? '' : '' ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">No. Kontak</label>
                    <input type="number" name="nokontak_pengaturan" class="form-control" placeholder="No. Kontak..." value="<?= isset($data['row']) ? $data['row']['nokontak_pengaturan'] ?? '' : '' ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat_pengaturan" class="form-control" placeholder="Alamat..."><?= isset($data['row']) ? $data['row']['alamat_pengaturan'] ?? '' : '' ?></textarea>
                </div>
            </div>
        </div>
        <?php
        $gambar_pengaturan = isset($data['row']) ? $data['row']['gambar_pengaturan'] ?? '' : '';
        ?>
        <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" name="gambar_pengaturan" class="form-control" />
            <?php
            if ($gambar_pengaturan) { ?>
                <a href="<?= BASEURL ?>/uploads/pengaturan/<?= $gambar_pengaturan ?>" target="_blank">
                    <img src="<?= BASEURL ?>/uploads/pengaturan/<?= $gambar_pengaturan ?>" alt="<?= $gambar_pengaturan; ?>" class="mt-3" style="height: 150px;">
                </a>
            <?php
            }
            ?>
        </div>

    </div>
    <div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa-solid fa-x"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" id="btn-submit">
            <i class="fa-regular fa-paper-plane"></i> Submit
        </button>
    </div>
</form>
<script src="<?= BASEURL ?>/public/js/app/pengaturan/form.js"></script>