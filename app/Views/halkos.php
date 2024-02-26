<?= $this->include('shared_pages/header') ?>
<?= $this->include('shared_pages/sidebar') ?>
<?= $this->include('shared_pages/topbar') ?>
<!-- blok konten dinamis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Antrian</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Antrian
                <a href="<?= base_url('Antrian/tambah'); ?>" class="btn btn-info btn-sm float-right">Tambah Data</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr>
                            <td>No Antrian</td>
                            <td>Dokter</td>
                            <td>Jam Dokter</td>
                            <td>Pasien</td>
                            <td>Pelayanan</td>
                            <td>Alamat</td>
                            <td>Umur</td>
                            <td>Estimasi</td>
                            <td>Di Panggil</td>
                            <td>Setting</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>No Antrian</td>
                            <td>Dokter</td>
                            <td>Jam Dokter</td>
                            <td>Pasien</td>
                            <td>Pelayanan</td>
                            <td>Alamat</td>
                            <td>Umur</td>
                            <td>Estimasi</td>
                            <td>Di Panggil</td>
                            <td>Setting</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nama Dokter</td>
                            <td>Jam Dokter</td>
                            <td>Pasien</td>
                            <td>Pelayanan</td>
                            <td>Alamat</td>
                            <td>Umur</td>
                            <td>Estimasi</td>
                            <td>Di Panggil</td>
                            <td>Setting</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->include('shared_pages/footer') ?>