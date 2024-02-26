<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelayanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>No</td>
                        <td>Kode Pelayanan</td>
                        <td>Jenis Pelayanan</td>
                        <td>Batas maksimum</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>No</td>
                        <td>Kode Pelayanan</td>
                        <td>Jenis Pelayanan</td>
                        <td>Batas maksimum</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pelayanan as $p) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p->kode ?></td>
                            <td><?= $p->jenis ?></td>
                            <td><?= $p->batas_maksimum ?></td>
                        </tr>
                    <?php endforeach; ?>
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