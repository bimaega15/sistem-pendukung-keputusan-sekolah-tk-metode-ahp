<?php
$utils = new Utils();
$myProfile = $utils->myProfile();
?>
<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <input type="hidden" name="password_users_old" value="<?= $myProfile['password_users'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="" class="col-lg-4">Username</label>
                    <div class="col-lg-8">
                        <input type="text" name="username_users" placeholder="Username..." class="form-control" value="<?= $myProfile['username_users'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4">Email</label>
                    <div class="col-lg-8">
                        <input type="text" name="email_users" placeholder="Email..." class="form-control" value="<?= $myProfile['email_users'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4">Password</label>
                    <div class="col-lg-8">
                        <input type="text" name="password_users" placeholder="Password..." class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4">Jenis Kelamin</label>
                    <div class="col-lg-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile1" value="L" <?= $myProfile['jeniskelamin_profile'] == 'L' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="jeniskelamin_profile1">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile2" value="P" <?= $myProfile['jeniskelamin_profile'] == 'P' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="jeniskelamin_profile2">
                                Perempuan
                            </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4">No. Handphone</label>
                    <div class="col-lg-8">
                        <input type="number" name="nomorhp_profile" placeholder="Nomor Handphone..." class="form-control" value="<?= $myProfile['nomorhp_profile'] ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="" class="col-lg-4">Nama</label>
                    <div class="col-lg-8">
                        <input type="text" name="nama_profile" placeholder="Nama..." class="form-control" value="<?= $myProfile['nama_profile'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-lg-4">Alamat</label>
                    <div class="col-lg-8">
                        <textarea name="alamat_profile" class="form-control" placeholder="Alamat..." id="" rows="5"><?= $myProfile['alamat_profile'] ?></textarea>
                    </div>
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
<script src="<?= BASEURL ?>/public/js/app/myProfile/form.js"></script>