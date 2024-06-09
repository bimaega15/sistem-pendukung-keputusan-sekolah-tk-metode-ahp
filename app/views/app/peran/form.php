<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Nama</label>
            <div class="col-lg-8">
                <input type="text" name="nama_roles" placeholder="Nama..." class="form-control" value="<?= isset($data['row']) ? $data['row']['nama_roles'] ?? '' : '' ?>">
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
<script src="<?= BASEURL ?>/public/js/app/peran/form.js"></script>