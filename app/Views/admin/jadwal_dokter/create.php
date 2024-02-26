<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('jadwaldokter'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Hari</label>
                    <div class="col-md-9">
                        <select class="form-control" name="nama_hari" required>
                            <option value="">-- Pilih Hari --</option>
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
                    <label class="col-md-3 col-form-label">Nama Dokter</label>
                    <div class="col-md-9">
                        <select class="form-control" name="dokter_id" id="dokter_id" onchange="getPelayanan()" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php foreach ($dokter as $p) : ?>
                                <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis pelayanan</label>
                    <div class="col-md-9">
                        <input type="hidden" class="form-control" name="pelayanan_id" id="pelayanan_id" readonly>
                        <input class="form-control" id="jenis_pelayanan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jam Praktek</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="jam_praktek" required>
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
<script>
    function getPelayanan() {
        let dokter_id = $('#dokter_id').val()
        $.ajax({
            url: "/antrian/get_layanan",
            dataType: "json",
            data: {
                dokter_id: dokter_id,
            },
            method: "post",
            beforeSend: function() {
                $('#pelayanan_id').empty()
                $('#jenis_pelayanan').empty()
            },
            success: function(responds) {
                console.log(responds)
                $('#pelayanan_id').val(responds.pelayanan_id)
                $('#jenis_pelayanan').val(responds.jenis_pelayanan)
            }
        })
    }
</script>
<?php $this->endSection() ?>