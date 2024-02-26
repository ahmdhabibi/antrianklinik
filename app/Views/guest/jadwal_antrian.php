<?php $session = \Config\Services::session() ?>
<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4><?= $heading ?></h4>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col">
                <!-- Menampilan alert notifikasi -->
                <?php session();
                if (session()->getFlashdata('notif')) : ?>
                    <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                        <strong>Notifikasi </strong> <?= session()->getFlashdata('notif'); ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <a href="<?= base_url('guest/daftar_antrian'); ?>" class="btn btn-outline-info ml-2">Daftar Antrian</a>
            </div>
        </div>
        <!-- fitur searching -->
        <form action="">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <div class="input-group input-group-sm mb-3">
                        <select type="text" class="form-control" id="pelayanan_id" aria-describedby="button-addon2" onchange="list_antrian_pelayanan()">
                            <option value="">-- Pilih Pelayanan --</option>
                            <?php foreach ($pelayanan as $p) : ?>
                                <option value="<?= $p->id ?>"><?= $p->jenis ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info" id="button-addon2">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="list-antrian"></div>
    </div>
</div>
<!-- Page level plugins -->
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>
<script>
    function list_antrian_pelayanan() {
        let pelayanan_id = $('#pelayanan_id').val()
        $.ajax({
            url: "/guest/list_antrian",
            dataType: "json",
            data: {
                pelayanan_id: pelayanan_id
            },
            success: function(responds) {
                console.log(responds)
                $('#list-antrian').html(responds)
            }
        })
    }
    $(document).ready(function() {
        setInterval(function() {
            list_antrian_pelayanan()
        }, 2000);
    })
</script>
<?php $this->endSection() ?>