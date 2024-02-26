<?php $session = \Config\Services::session(); ?>
<div class="table-responsive">
    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-info text-white">
            <tr>
                <td>Pelayanan</td>
                <td>No Antrian</td>
                <td>Dokter</td>
                <td>Jam Dokter</td>
                <td>Pasien</td>
                <td>Alamat</td>
                <td>Umur</td>
                <td width="50px">Estimasi Kedatangan</td>
                <td width="50px">Dipanggil</td>
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
                <td width="50px">Estimasi Kedatangan</td>
                <td width="50px">Dipanggil</td>
                <td>Keterangan</td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($antrian as $p) : ?>
                <tr>
                    <td><?= $p->jenis_pelayanan ?></td>
                    <td>
                        <?= $p->urutan ?>
                        <?php if (($p->nama_pasien == $session->nama)) : ?>
                            <div>
                                <a target="_blank" href="<?= base_url() ?>guest/cetak/<?= $p->id ?>" class="btn btn-sm btn-outline-primary">
                                    Cetak Antrian
                                </a>
                            </div>
                        <?php endif ?>
                    </td>
                    <td><?= $p->nama_dokter ?></td>
                    <td><?= $p->jam_pelayanan ?></td>
                    <td>
                        <?= ($p->nama_pasien == $session->nama) ? '<span class="badge badge-success">' . $p->nama_pasien . '</span>' : $p->nama_pasien ?>
                    </td>
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