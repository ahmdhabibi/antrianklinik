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
        <section class="section profile">
            <form class="form" method="post" action="/update_password">
                <?= csrf_field() ?>
                <div class="row form-group mb-3">
                    <div class="col-md-2">
                        <label for="floatingInput">Nama User</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?= $session->nama ?>" readonly>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-md-2">
                        <label for="floatingInput">Password Baru</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pss1" required>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-md-2">
                        <label for="floatingInput">Konfirmasi Password</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pss2" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </section>
    </div>
</div>
<?php $this->endSection() ?>