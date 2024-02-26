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
                        <td>No Antrian</td>
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
                        <td>No Antrian</td>
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
                            <td><?= $p->urutan ?></td>
                            <td><?= $p->nama_pasien ?></td>
                            <td>
                                <?php $color = ($p->status_layanan == 'Sudah Dilayani') ? 'success' : 'warning' ?>
                                <span class="badge badge-<?= $color ?>"><?= $p->status_layanan ?></span>
                            </td>
                            <td><?= $p->alamat_pasien ?></td>
                            <td><?= $p->umur_pasien ?></td>
                            <td><?= $p->estimasi_kedatangan ?></td>
                            <td>
                                <?php if ($p->status_layanan == 'Menunggu') : ?>
                                    <button id="diagnosa" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal" data-antrian_id="<?= $p->id ?>" data-pasien_id="<?= $p->pasien_id ?>" data-nama_pasien="<?= $p->nama_pasien ?>" data-umur_pasien="<?= $p->umur_pasien ?>" data-gender="<?= $p->gender ?>" data-status_pasien="<?= $p->status_pasien ?>" data-nomor_bpjs="<?= $p->nomor_bpjs ?>" data-dokter_id="<?= $p->dokter_id ?>" data-pelayanan_id="<?= $p->pelayanan_id ?>">
                                        Diagnosa
                                    </button>
                                <?php endif ?>
                                <?php if ($p->status_layanan == 'Sudah Dilayani') : ?>
                                    <a href="/dokterarea/status_layanan/<?= $p->id ?>" class="btn btn-sm btn-primary">Konfirm</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Entri Diagnosa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dokterarea/diagnosa'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="antrian_id" id="antrian_id">
                    <input type="hidden" name="pasien_id" id="pasien_id">
                    <input type="hidden" name="dokter_id" id="dokter_id">
                    <input type="hidden" name="pelayanan_id" id="pelayanan_id">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nama_pasien" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-3">
                            <input class="form-control" id="status_pasien" readonly>
                        </div>
                        <label class="col-md-2 col-form-label">Nomor BPJS</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nomor_bpjs" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Gender</label>
                        <div class="col-md-3">
                            <input class="form-control" id="gender" readonly>
                        </div>
                        <label class="col-md-2 col-form-label">Umur</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="umur_pasien" readonly>
                        </div>
                    </div>
                    <h5 class="text-center text-primary my-3">Hasil Diagnosa</h5>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Catatan/Keterangan</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" name="hasil_diagnosa" required>
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Catatan Obat</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" name="catatan_obat" required>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#diagnosa', function() {
        $('.modal-body #antrian_id').val($(this).data('antrian_id'))
        $('.modal-body #pasien_id').val($(this).data('pasien_id'))
        $('.modal-body #nama_pasien').val($(this).data('nama_pasien'))
        $('.modal-body #umur_pasien').val($(this).data('umur_pasien'))
        $('.modal-body #gender').val($(this).data('gender'))
        $('.modal-body #status_pasien').val($(this).data('status_pasien'))
        $('.modal-body #nomor_bpjs').val($(this).data('nomor_bpjs'))
        $('.modal-body #pelayanan_id').val($(this).data('pelayanan_id'))
        $('.modal-body #dokter_id').val($(this).data('dokter_id'))
    });
</script>
<!-- Page level plugins -->
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>
<?php $this->endSection() ?>