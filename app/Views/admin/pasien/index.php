<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $heading ?></h6>
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
        <a href="<?= base_url('pasien/new'); ?>" class="btn btn-outline-info ml-2 mb-4">Tambah Data Pasien</a>
        <div class="table-responsive">
            <!-- fitur searching -->
            <form action="/pasien">
                <div class="row justify-content-end">
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-3">
                            <select type="text" class="form-control" name="status_pasien" aria-describedby="button-addon2">
                                <option value="">Semua Status</option>
                                <option value="Non BPJS">Non BPJS</option>
                                <option value="BPJS">BPJS</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info" id="button-addon2">Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-responsive table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Birthdate</th>
                        <th>Umur</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Status</th>
                        <th>No BPJS</th>
                        <th>Pengaturan</th>
                    </tr>
                </thead>
                <tfoot class="bg-gray-200">
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Birthdate</th>
                        <th>Umur</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Status</th>
                        <th>No BPJS</th>
                        <th>Pengaturan</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($pasien as $p) :
                        // Hitung umur berdasarkan tanggal lahir
                        $tgl_lahir = new DateTime($p->tgl_lahir);
                        $today = new DateTime();
                        $umur = $today->diff($tgl_lahir)->y;
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p->nik ?></td>
                            <td><?= $p->nama ?></td>
                            <td>
                                <?= date('d-m-Y', strtotime($p->tgl_lahir)) ?>
                            </td>
                            <td><?= $p->umur ?></td>
                            <td><?= $p->gender ?></td>
                            <td><?= $p->alamat ?></td>
                            <td><?= $p->telp ?></td>
                            <td><?= $p->status_pasien ?></td>
                            <td><?= $p->nomor_bpjs ?></td>
                            <td>
                                <a href="<?= base_url() ?>pasien/<?= $p->id ?>/edit" class="btn btn-sm btn-outline-info">Ubah</a>
                                <form class="d-inline" action="<?= base_url() ?>pasien/<?= $p->id ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini ?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
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