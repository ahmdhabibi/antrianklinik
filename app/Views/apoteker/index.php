<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4><?= $heading ?></h4>
    </div>
    <div class="card-body">
        <!-- Menampilan alert notifikasi -->
        <?php session();
        if (session()->getFlashdata('notif')) : ?>
            <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                <strong>Notifikasi !</strong> <?= session()->getFlashdata('notif'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama Pasien</td>
                        <td>Alamat</td>
                        <td>Gender</td>
                        <td>Umur</td>
                        <td>Status</td>
                        <td>Diagnosa</td>
                        <td>Catatan Obat</td>
                        <td>Keterangan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>No</td>
                        <td>Nama Pasien</td>
                        <td>Alamat</td>
                        <td>Gender</td>
                        <td>Umur</td>
                        <td>Status</td>
                        <td>Diagnosa</td>
                        <td>Catatan Obat</td>
                        <td>Keterangan</td>
                        <td>Aksi</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $k = 1;
                    foreach ($list_tgu_obat as $p) : ?>
                        <tr>
                            <td><?= $k++ ?></td>
                            <td><?= $p->nama_pasien ?></td>
                            <td><?= $p->alamat_pasien ?></td>
                            <td><?= $p->gender ?></td>
                            <td><?= $p->umur_pasien ?></td>
                            <td>
                                <?php $color = ($p->status == 'Finish') ? 'success' : 'warning' ?>
                                <span class="badge badge-<?= $color ?>"><?= $p->status ?></span>
                            </td>
                            <td><?= $p->hasil_diagnosa ?></td>
                            <td><?= $p->catatan_obat ?></td>
                            <td><?= $p->keterangan ?></td>
                            <td>
                                <?php if ($p->status == 'Tunggu Obat') : ?>
                                    <a href="/apoteker/konfirmasi/<?= $p->id ?>" class="btn btn-sm btn-primary">Konfirm</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>
<?php $this->endSection() ?>