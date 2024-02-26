<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('jadwaldokter/' . $jadwal->id . '/update'); ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $jadwal->id ?>">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Hari</label>
                    <div class="col-md-9">
                        <select class="form-control" name="nama_hari" required>
                            <option value="<?= $jadwal->nama_hari ?>"><?= $jadwal->nama_hari ?></option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis pelayanan</label>
                    <div class="col-md-9">
                        <select class="form-control" name="pelayanan_id" required>
                            <?php foreach ($jenis_pelayanan as $p) : ?>
                                <option value="<?= $p->id ?>" <?= ($jadwal->pelayanan_id == $p->id) ? 'selected' : '' ?>><?= $p->jenis ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Dokter</label>
                    <div class="col-md-9">
                        <select class="form-control" name="dokter_id" required>
                            <?php foreach ($dokter as $p) : ?>
                                <option value="<?= $p->id ?>" <?= ($jadwal->dokter_id == $p->id) ? 'selected' : '' ?>><?= $p->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jam Praktek</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="jam_praktek" value="<?= $jadwal->jam_praktek ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-outline-primary"> Update Data</button>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>