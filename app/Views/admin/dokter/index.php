<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
    </div>
    <div class="card-body">
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
        <a href="<?= base_url('dokter/new'); ?>" class="btn btn-outline-info mb-4">Tambah Dokter</a>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr>
                        <td>No</td>
                        <td>Nip</td>
                        <td>Nama</td>
                        <td>Jabatan</td>
                        <td>Jenis Kelamin</td>
                        <td>Umur</td>
                        <td>Alamat</td>
                        <td>Whatsapp</td>
                        <td>Pengaturan</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>No</td>
                        <td>Nip</td>
                        <td>Nama</td>
                        <td>Jabatan</td>
                        <td>Jenis Kelamin</td>
                        <td>Umur</td>
                        <td>Alamat</td>
                        <td>Whatsapp</td>
                        <td>Pengaturan</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dokter as $p) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p->nip ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->jenis_pelayanan ?></td>
                            <td><?= $p->gender ?></td>
                            <td><?= $p->umur ?></td>
                            <td><?= $p->alamat ?></td>
                            <td><?= $p->telp ?></td>
                            <td>
                                <a href="<?= base_url() ?>dokter/<?= $p->id ?>/edit" class="btn btn-sm btn-outline-primary">Ubah</a>
                                <form class="d-inline" action="<?= base_url() ?>dokter/<?= $p->id ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data dokter ini ?');">Hapus</button>
                                </form>
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