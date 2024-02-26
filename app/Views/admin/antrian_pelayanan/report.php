<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $heading ?></h6>
    </div>
    <div class="card-body">
        <!-- fitur searching -->
        <div class="row d-flex justify-content-between">
            <div class=" col-md-4">
                <form action="/report">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-group">Tanggal awal</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label class="form-group">Tanggal akhir</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" required>
                                <button type="submit" class="btn btn-sm btn-outline-success ml-4">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <!-- fitur cetak pdf -->
                <form target="_blank" action="/printpdf">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-group">Tanggal awal</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="date" class="form-control" name="tgl_awal" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-group">Tanggal akhir</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="date" class="form-control" name="tgl_akhir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-group">Jenis pelayanan</label>
                            <div class="input-group input-group-sm mb-3">
                                <select type="date" class="form-control" name="pelayanan_id" required>
                                    <option value="">-- Pilih pelayanan --</option>
                                    <?php foreach ($pelayanan as $p) : ?>
                                        <option value="<?= $p->id ?>"><?= $p->jenis ?></option>
                                    <?php endforeach ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-outline-danger ml-3">Print PDF</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered text-center" width="100%" cellspacing="0">
            <thead class="bg-info text-white">
                <tr>
                    <td>No</td>
                    <td>Pelayanan</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>No</td>
                    <td>Pelayanan</td>
                    <td>Jumlah Antrian</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $no = 1;
                foreach ($pelayanan as $p) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->jenis ?></td>
                        <td><?= count($antrian[$p->jenis]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php $this->endSection() ?>