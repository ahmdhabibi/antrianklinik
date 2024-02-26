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
        <!-- fitur searching -->
        <form action="/guest/jadwal_antrian">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <div class="input-group input-group-sm mb-3">
                        <select type="text" class="form-control" name="pelayanan_id" aria-describedby="button-addon2">
                            <option value="">-- Pilih Pelayanan --</option>
                            <?php foreach ($pelayanan as $p) : ?>
                                <option value="<?= $p->id ?>"><?= $p->jenis ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info" id="button-addon2">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td>Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Status</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td>Estimasi</td>
                        <td>Konfirmasi Pelayanan</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td>Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Status</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td>Estimasi</td>
                        <td>Konfirmasi Pelayanan</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($antrian as $p) : ?>
                        <tr>
                            <td><?= $p->jenis_pelayanan ?></td>
                            <td><?= $p->urutan ?></td>
                            <td><?= $p->nama_dokter ?></td>
                            <td><?= $p->jam_pelayanan ?></td>
                            <td><?= $p->nama_pasien ?></td>
                            <td>
                                <?php $color = ($p->status_layanan == 'Sudah Dilayani') ? 'success' : 'warning' ?>
                                <span class="badge badge-<?= $color ?>"><?= $p->status_layanan ?></span>
                            </td>
                            <td><?= $p->alamat_pasien ?></td>
                            <td><?= $p->umur_pasien ?></td>
                            <td><?= $p->estimasi_kedatangan ?></td>
                            <td>
                                <a href="/dokterarea/status_layanan/<?= $p->id ?>" class="btn btn-sm btn-primary">Konfirm</a>
                                <button href="#" class="btn btn-sm btn-success">Diagnosa</button>
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