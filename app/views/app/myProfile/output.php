<?php
$utils = new Utils();
$myProfile = $utils->myProfile();
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-user"></i> My Profile
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img src="<?= BASEURL ?>/public/image/<?= $myProfile['jeniskelamin_profile'] == 'L' ? 'male.png' : 'female.png' ?>" alt="Male">
                </div>
                <hr />
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                Nama
                            </div>
                            <div>
                                <?= $myProfile['nama_profile'] ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                Role
                            </div>
                            <div>
                                <?= $myProfile['nama_roles'] ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Email / Username</strong> <br />
                        <?= $myProfile['email_users'] ?> / <?= $myProfile['username_users'] ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-edit" data-url="<?= BASEURL ?>/Profile/edit/<?= $myProfile['id'] ?>">
                            <i class="fa-solid fa-pencil"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>Nama</div>
                            <div><?= $myProfile['nama_profile'] ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>Alamat</div>
                            <div>
                                <?= $myProfile['alamat_profile'] ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>Jenis Kelamin</div>
                            <div>
                                <?= $myProfile['jeniskelamin_profile'] == 'L' ? 'Laki-laki' : "Perempuan" ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>No. Handphone</div>
                            <div>
                                <?= $myProfile['nomorhp_profile'] ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>