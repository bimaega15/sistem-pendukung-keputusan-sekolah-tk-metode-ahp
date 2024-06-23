<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Tingkat Kelas</label>
            <div class="col-lg-8">
                <select name="tingkat_kelas" class="form-control" id="">
                    <option value="">-- Pilih Kelas --</option>
                    <?php
                    foreach ($data['kelas'] as $key => $item) { ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Nama Kelas</label>
            <div class="col-lg-8">
                <input type="text" name="nama_kelas" placeholder="Nama..." class="form-control" value="<?= isset($data['row']) ? $data['row']['nama_kelas'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Guru</label>
            <div class="col-lg-8">
                <select name="users_id" class="form-control select2Server" id="">
                    <option value="">-- Pilih Guru --</option>
                </select>
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
<script src="<?= BASEURL ?>/public/js/app/kelas/form.js"></script>