<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('dokter/' . $dokter->id . '/update'); ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $dokter->id ?>">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nip</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nip" value="<?= $dokter->nip ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" value="<?= $dokter->nama ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis pelayanan</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pelayanan_id" required>
                            <?php foreach ($jenis_pelayanan as $pelayanan) : ?>
                                <option value="<?= $pelayanan->id ?>" <?= ($pelayanan->id == $dokter->pelayanan_id) ? 'selected' : '' ?>>
                                    <?= $pelayanan->jenis ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="gender" required>
                            <option value="Laki-laki">laki-laki</option>
                            <option value="Perempuan">perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Umur</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="umur" value="<?= $dokter->umur ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="alamat" value="<?= $dokter->alamat ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Whatsapp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="telp" value="<?= $dokter->telp ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-outline-primary"> Update</button>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>