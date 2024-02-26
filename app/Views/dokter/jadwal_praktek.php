<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4><?= $heading ?></h4>
        <!-- Menampilan alert notifikasi -->
        <?php session();
        if (session()->getFlashdata('notif')) : ?>
            <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                <strong>Berhasil !</strong> <?= session()->getFlashdata('notif'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr>
                        <td>No</td>
                        <td>Hari</td>
                        <td>Jenis Pelayanan</td>
                        <td>Dokter</td>
                        <td>Jam Praktek</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>No</td>
                        <td>Hari</td>
                        <td>Jenis Pelayanan</td>
                        <td>Dokter</td>
                        <td>Jam Praktek</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($jadwal_dokter as $p) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p->nama_hari ?></td>
                            <td><?= $p->jenis_pelayanan ?></td>
                            <td><?= $p->nama_dokter ?></td>
                            <td><?= $p->jam_praktek ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection() ?>