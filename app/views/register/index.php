<form action="<?= BASEURL ?>/Register/store" method="post" id="form-submit">
  <div class="form-group">
    <input type="text" name="kode_profile" placeholder="Kode Profile..." class="form-control" value="<?= $data['kode_profile'] ?>" readonly>
  </div>
  <div class="form-group mb-3">
  <input type="text" name="username_users" placeholder="Username..." class="form-control" value="">
  </div>
  <div class="form-group mb-3">
  <input type="text" name="email_users" placeholder="Email..." class="form-control" value="">
  </div>
  <div class="form-group mb-3">
  <input type="password" name="password_users" placeholder="Password..." class="form-control">
  </div>
  <div class="form-group mb-3">
  <input type="password" name="password_confirm_users" placeholder="Confirm Password..." class="form-control">
  </div>
  <div class="form-group mb-3">
  <input type="text" name="nama_profile" placeholder="Nama..." class="form-control" value="">
  </div>
  <div class="form-group mb-3">
  <input type="number" name="nomorhp_profile" placeholder="Nomor Handphone..." class="form-control" value="">
  </div>
  <div class="form-group mb-3">
  <textarea name="alamat_profile" class="form-control" placeholder="Alamat..." id="" rows="5"></textarea>
  </div>
<div class="form-group row">
  <label for="">Jenis Kelamin</label>
  <div class="col-lg-12">
      <div class="form-check">
          <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile1" value="L">
          <label class="form-check-label" for="jeniskelamin_profile1">
              Laki-laki
          </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="jeniskelamin_profile" id="jeniskelamin_profile2" value="P">
          <label class="form-check-label" for="jeniskelamin_profile2">
              Perempuan
          </label>
      </div>
  </div>
</div>
  <div class="row">
    <!-- /.col -->
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" id="btn-submit">Register</button>
    </div>
    <p class="mb-0 pt-3">
        <a href="<?= BASEURL ?>/Login" class="text-center">Login Siswa</a>
      </p>
    <!-- /.col -->
  </div>
</form>