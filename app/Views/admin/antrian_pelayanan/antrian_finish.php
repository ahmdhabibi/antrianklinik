<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $heading ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td>Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td>Estimasi Kedatangan</td>
                        <td>Waktu Dilayani</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td>Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td>Estimasi Kedatangan</td>
                        <td>Waktu Dilayani</td>
                        <td>Keterangan</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $unik = 1;
                    foreach ($antrian_finish as $p) : ?>
                        <?php $unik++; ?>
                        <tr>
                            <td><?= $p->jenis_pelayanan ?></td>
                            <td><?= $p->urutan ?></td>
                            <td><?= $p->nama_dokter ?></td>
                            <td><?= $p->jam_pelayanan ?></td>
                            <td><?= $p->nama_pasien ?></td>
                            <td><?= $p->alamat_pasien ?></td>
                            <td><?= $p->umur_pasien ?></td>
                            <td><?= $p->estimasi_kedatangan ?></td>
                            <td><?= $p->wkt_panggilan ?></td>
                            <td>
                                <span class="badge badge-danger"><?= $p->keterangan ?></span>
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