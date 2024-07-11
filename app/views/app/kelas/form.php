<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
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
<script class="data_kelas" data-value="<?= isset($data['row']) ? htmlspecialchars(json_encode($data['row']), ENT_QUOTES, 'UTF-8') : '' ?>"></script>
<script class="page" data-value="<?= isset($data['row']) ? 'edit' : 'add' ?>"></script>
<script src="<?= BASEURL ?>/public/js/app/kelas/form.js"></script>