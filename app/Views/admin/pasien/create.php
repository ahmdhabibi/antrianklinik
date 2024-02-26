<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pasien'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Status</label>
                    <div class="col-md-3">
                        <select class="form-control" name="status_pasien" id="status_pasien" required>
                            <option value="Non BPJS">Non BPJS</option>
                            <option value="BPJS">BPJS</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="nomor_bpjs_container">
                        <input type="text" class="form-control" name="nomor_bpjs" id="nomor_bpjs" placeholder="Masukan Nomor BPJS">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nik</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="nik" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" onchange="hitungUmur()">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Umur</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="umur" id="umur" readonly>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="tgl_lahir">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Umur</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="umur">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Gender</label>
                    <div class="col-md-9">
                        <select class="form-control" name="gender" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Alamat</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="alamat">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Whatsapp</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="telp">
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
    function hitungUmur() {
        var tglLahir = document.getElementById("tgl_lahir").value;
        var today = new Date();
        var birthDate = new Date(tglLahir);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        document.getElementById("umur").value = age;
    }
</script>
<?php $this->endSection() ?>