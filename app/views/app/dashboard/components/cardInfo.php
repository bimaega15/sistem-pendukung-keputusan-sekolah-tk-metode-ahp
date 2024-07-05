  <!-- Small boxes (Stat box) -->
  <div class="row">
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
              <div class="inner">
                  <h3><?= $data['siswa'] ?></h3>

                  <p>Data Siswa</p>
              </div>
              <div class="icon">
                  <i class="fa-solid fa-graduation-cap fa"></i>
              </div>
              <!-- <a href="<?= BASEURL ?>/Siswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
      </div>
      <!-- ./col -->
      <?php
        if ($data['namaRoles'] != 'Orang Tua') { ?>
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3><?= $data['guru'] ?></h3>
                      <p>Guru</p>
                  </div>
                  <div class="icon">
                      <i class="fa-solid fa-chalkboard-user fa"></i>
                  </div>
                  <!-- <a href="<?= BASEURL ?>/Guru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
          </div>
      <?php
        }
        ?>

      <?php
        if ($data['namaRoles'] != 'Orang Tua') { ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                  <div class="inner">
                      <h3><?= $data['admin'] ?></h3>

                      <p>Admin</p>
                  </div>
                  <div class="icon">
                      <i class="fa-solid fa-user-lock fa"></i>
                  </div>
                  <!-- <a href="<?= BASEURL ?>/Admin" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
          </div>
      <?php } ?>
      <!-- ./col -->
      <?php
        if ($data['namaRoles'] != 'Orang Tua') { ?>
          <div class="col-lg-3 col-6">
              <!-- small box -->


              <div class="small-box bg-secondary">
                  <div class="inner">
                      <h3><?= $data['orangTua'] ?></h3>
                      <p>Orang Tua Siswa</p>
                  </div>
                  <div class="icon">
                      <i class="fa-solid fa-person-chalkboard fa"></i>
                  </div>
                  <!-- <a href="<?= BASEURL ?>/OrangTua" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
          </div>
          <!-- ./col -->
      <?php } ?>

      <?php
        if ($data['namaRoles'] != 'Orang Tua') { ?>
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                  <!-- <div class="inner">
                      <h3><?= $data['kriteria'] ?></h3>
                      <p>Kriteria</p>
                  </div>
                  <div class="icon">
                      <i class="fa-solid fa-layer-group fa"></i>
                  </div> -->
                  <!-- <a href="<?= BASEURL ?>/Kriteria" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
          </div>
      <?php } ?>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-dark">
              <!-- <div class="inner">
                  <h3><?= $data['absensi'] ?></h3>
                  <p>Absensi</p>
              </div>
              <div class="icon">
                  <i class="fa-solid fa-book fa"></i>
              </div> -->
              <!-- <a href="<?= BASEURL ?>/Absensi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
              <!-- <div class="inner">
                  <h3><?= $data['hasil_akhir'] ?></h3>

                  <p>Perkembangan</p>
              </div>
              <div class="icon">
                  <i class="fa-solid fa-chart-simple fa"></i>
              </div> -->
              <!-- <a href="<?= BASEURL ?>/PerkembanganNilai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
              <!-- <div class="inner">
                  <h3><?= $data['nilai'] ?></h3>
                  <p>Nilai</p>
              </div>
              <div class="icon">
                  <i class="fa-solid fa-pencil fa"></i>
              </div> -->
              <!-- <a href="<?= BASEURL ?>/Nilai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
      </div>
      <!-- ./col -->
  </div>