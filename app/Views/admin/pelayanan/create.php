<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pelayanan'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kode Pelayanan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="kode" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Pelayanan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="jenis" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Batas Maksimum</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="batas_maksimum" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label"></label>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-outline-primary"> Simpan</button>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>