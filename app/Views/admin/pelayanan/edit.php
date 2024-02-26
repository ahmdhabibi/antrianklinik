<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pelayanan/' . $pelayanan->id . '/update'); ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $pelayanan->id ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Pelayanan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kode" value="<?= $pelayanan->kode ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Pelayanan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="jenis" value="<?= $pelayanan->jenis ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Batas Maksimum</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="batas_maksimum" value="<?= $pelayanan->batas_maksimum ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-outline-primary"> Update</button>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>