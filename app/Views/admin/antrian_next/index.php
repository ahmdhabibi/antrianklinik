<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $heading ?></h6>
    </div>
    <div class="card-body">
        <!-- fitur searching -->
        <form action="/antrian_next">
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
                <thead class="bg-success text-white">
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td width="100px">Tanggal dan Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Status Layanan</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td width="50px">Estimasi Kedatangan</td>
                        <td>Setting</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Pelayanan</td>
                        <td>No Antrian</td>
                        <td>Dokter</td>
                        <td width="100px">Tanggal dan Jam Dokter</td>
                        <td>Pasien</td>
                        <td>Status Layanan</td>
                        <td>Alamat</td>
                        <td>Umur</td>
                        <td width="50px">Estimasi Kedatangan</td>
                        <td>Setting</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $unik = 1;
                    foreach ($antrian as $p) : ?>
                        <?php $unik++; ?>
                        <tr>
                            <td><?= $p->jenis_pelayanan ?></td>
                            <td>
                                <?= $p->urutan ?>
                                <div>
                                    <a target="_blank" href="<?= base_url() ?>antrian/cetak/<?= $p->id ?>" class="btn btn-sm btn-outline-primary">
                                        Cetak Antrian
                                    </a>
                                </div>
                            </td>
                            <td><?= $p->nama_dokter ?></td>
                            <td>
                                <div><?= date('d-M-Y', strtotime($p->tgl_antrian)) ?></div>
                                <?= $p->jam_pelayanan ?>
                            </td>
                            <td>
                                <?= $p->nama_pasien ?>
                            </td>
                            <td>
                                <?php $color = ($p->status_layanan == 'Sudah Dilayani') ? 'success' : 'warning' ?>
                                <span class="badge badge-<?= $color ?>"><?= $p->status_layanan ?></span>
                            </td>
                            <td><?= $p->alamat_pasien ?></td>
                            <td><?= $p->umur_pasien ?></td>
                            <td><?= $p->estimasi_kedatangan ?></td>
                            <td>
                                <a href="<?= base_url() ?>antrian_next/cancel/<?= $p->id ?>" class="btn btn-sm btn-outline-danger">
                                    Batalkan
                                </a>
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