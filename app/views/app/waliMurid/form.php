<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <input type="hidden" name="is_edit" value="<?= isset($data['row']) ? true : false ?>">
    <input type="hidden" name="password_old" value="<?= isset($data['row']) ? $data['row']['password_users'] ?? '' : '' ?>">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Username</label>
            <div class="col-lg-8">
                <input type="text" name="username_users" placeholder="Username..." class="form-control" value="<?= isset($data['row']) ? $data['row']['username_users'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Email</label>
            <div class="col-lg-8">
                <input type="text" name="email_users" placeholder="Email..." class="form-control" value="<?= isset($data['row']) ? $data['row']['email_users'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Password</label>
            <div class="col-lg-8">
                <input type="password" name="password_users" placeholder="Password..." class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Confirm Password</label>
            <div class="col-lg-8">
                <input type="password" name="password_confirm_users" placeholder="Confirm Password..." class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Nama</label>
            <div class="col-lg-8">
                <input type="text" name="nama_profile" placeholder="Nama..." class="form-control" value="<?= isset($data['row']) ? $data['row']['nama_profile'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Nomor HP</label>
            <div class="col-lg-8">
                <input type="number" name="nomorhp_profile" placeholder="Nomor Handphone..." class="form-control" value="<?= isset($data['row']) ? $data['row']['nomorhp_profile'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Alamat</label>
            <div class="col-lg-8">
                <textarea name="alamat_profile" class="form-control" placeholder="Alamat..." id="" rows="5"><?= isset($data['row']) ? $data['row']['alamat_profile'] ?? '' : '' ?></textarea>
            </div>
        </div>
        <?php
        $jenisKelamin = isset($data['row']) ? $data['row']['jeniskelamin_profile'] ?? '' : '';
        ?>
        <div class="form-group row">
            <label for="" class="col-lg-4">Jenis Kelamin</label>
            <div class="col-lg-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile1" value="L" <?= $jenisKelamin == 'L' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="jeniskelamin_profile1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile2" value="P" <?= $jenisKelamin == 'P' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="jeniskelamin_profile2">
                        Perempuan
                    </label>
                </div>
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
<script src="<?= BASEURL ?>/public/js/app/waliMurid/form.js"></script>