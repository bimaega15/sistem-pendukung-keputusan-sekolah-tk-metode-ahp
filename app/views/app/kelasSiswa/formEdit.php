<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <input type="hidden" name="users_id_now" value="<?= isset($data['row']) ? $data['row']['users_id'] ?? '' : '' ?>">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Siswa</label>
            <div class="col-lg-8">
                <select name="users_id" class="form-control" id="">
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
<script class="kelas_id" data-value="<?= $data['kelas_id'] ?>"></script>
<script class="row_id" data-value="<?= isset($data['row']) ? $data['row']['id'] ?? '' : '' ?>"></script>
<script class="baseurl" data-value="<?= BASEURL ?>"></script>
<script src="<?= BASEURL ?>/public/js/app/kelasSiswa/formEdit.js"></script>