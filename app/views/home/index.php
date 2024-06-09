<form action="<?= BASEURL ?>/Login/store" method="post" id="form-submit">
  <div class="form-group">
    <input type="text" name="email_username_users" class="form-control" placeholder="Email atau Username">
  </div>
  <div class="form-group mb-3">
    <input type="password" name="password_users" class="form-control" placeholder="Password">
  </div>
  <div class="row">
    <div class="col-8">
      <div class="icheck-primary">
        <input type="checkbox" id="remember" name="remember_users">
        <label for="remember">
          Remember Me
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block" id="btn-submit">Sign In</button>
    </div>
    <p class="mb-0">
        <a href="<?= BASEURL ?>/Register" class="text-center">Registrasi Siswa</a>
      </p>
    <!-- /.col -->
  </div>
</form>