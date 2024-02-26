<?php $session = \Config\Services::session() ?>
<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $heading ?></h6>
    </div>
    <div class="card-body">
        <!-- Menampilan alert notifikasi -->
        <?php session();
        if (session()->getFlashdata('notif')) : ?>
            <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                <strong>Notifikasi </strong> <?= session()->getFlashdata('notif'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <section class="section profile mt-2">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title">Selamat Datang di Program Pelayanan Antrian</h4>
                </div>
                <?php if ($session->level == 3) { ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->nama ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nik</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->nik ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->alamat ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->gender ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Tgl Lahir</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($pasien->tgl_lahir)) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Umur</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->umur ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->status_pasien ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">No Bpjs</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $pasien->nomor_bpjs ?>" readonly>
                            </div>
                        </div>
                        <?php if ($session->level == 3) : ?>
                            <a href="/editprofile" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                        <?php endif ?>
                    </div>
                <?php } else { ?>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <p>Nama user</p>
                                <p>Level</p>
                                <p>Username</p>
                            </div>
                            <div class="col-md-9">
                                <p>: <?= $session->nama ?></p>
                                <p>: <?= $session->nama_level ?></p>
                                <p>: <?= $session->username ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- <div class="row">
                <div class="col-xl-4 d-flex align-items-center justify-content-center">
                    <div class="card">
                        <div class="card-body pt-4 d-flex flex-column align-items-center">
                            <img src="/assets/img/avatar.png" width="200px" alt="Profile" class="rounded-circle mb-3">
                            <h4><?= $session->nama ?></h4>
                            <h5><?= $session->nama_level ?></h5>
                        </div>
                        <?php if ($session->level == 3) : ?>
                            <a href="/editprofile" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Selamat Datang di Program Pelayanan Antrian</h4>
                        </div>
                        <?php if ($session->level == 3) { ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->nama ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nik</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->nik ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->alamat ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->gender ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tgl Lahir</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($pasien->tgl_lahir)) ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Umur</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->umur ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->status_pasien ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">No Bpjs</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?= $pasien->nomor_bpjs ?>" readonly>
                                    </div>
                                </div>
                            <?php if ($session->level == 3) : ?>
                            <a href="/editprofile" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                            <?php endif ?>
                            </div>
                        <?php } else { ?>
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <p>Nama user</p>
                                        <p>Level</p>
                                        <p>Username</p>
                                    </div>
                                    <div class="col-md-9">
                                        <p>: <?= $session->nama ?></p>
                                        <p>: <?= $session->nama_level ?></p>
                                        <p>: <?= $session->username ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div> -->
        </section>
    </div>
</div>
<?php $this->endSection() ?>