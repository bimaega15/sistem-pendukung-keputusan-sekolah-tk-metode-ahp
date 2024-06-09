<link rel="stylesheet" href="<?= BASEURL ?>/public/library/datetimepicker-master/jquery.datetimepicker.css">
<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Tanggal</label>
            <div class="col-lg-8">
                <input type="text" name="tanggal_absensi" placeholder="Tanggal..." class="form-control" value="<?= isset($data['row']) ? Utils::formatDateView($data['row']['tanggal_absensi']) ?? date('d/m/Y H:i') :  date('d/m/Y H:i') ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Absensi</label>
            <div class="col-lg-8">
                <?php
                $data_nama_absensi = isset($data['row']) ? $data['row']['nama_absensi'] ?? '' : '';
                ?>
                <select name="nama_absensi" class="form-control select2" id="">
                    <option value="">-- Pilih Absensi --</option>
                    <?php
                    foreach ($data['jenisAbsensi'] as $value => $item) { ?>
                        <option value="<?= $value ?>" <?= $value == $data_nama_absensi ? 'selected' : '' ?>><?= $item ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Keterangan</label>
            <div class="col-lg-8">
                <textarea name="keterangan_absensi" class="form-control" placeholder="Keterangan..." id="" rows="5"><?= isset($data['row']) ? $data['row']['keterangan_absensi'] ?? '' : '' ?></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa-solid fa-x"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" id="btn-submit">
            <i class="fa-regular fa-paper-plane"></i> Submit
        </button>
    </div>
</form>
<script src="<?= BASEURL ?>/public/library/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script src="<?= BASEURL ?>/public/js/app/absensiSiswa/form.js"></script>