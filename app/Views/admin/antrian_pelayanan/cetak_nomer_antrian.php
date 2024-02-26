<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        @media print {
            button.btn.btn-sm.btn-danger {
                display: none;
            }
        }
    </style>
    <title>Cetak Nomer Antrian</title>
</head>

<body class="text-dark">
    <div class="container mx-2 mt-5">
        <div class="row mt-3 mb-3">
            <div class="col">
                <button class="btn btn-sm btn-danger" onclick="window.print()">
                    <i class=" bi bi-printer me-2"></i><i class="fas fa-print"></i> Print
                </button>
                <a class="btn btn-sm btn-outline-dark" href="/antrian">
                    <i class=" bi bi-printer me-2"></i><i class="fas fa-reply"></i> kembali
                </a>
            </div>
        </div>

        <div class="border border-dark w-50 p-3">
            <div class="d-flex" style="background-color:#000; width:100%; height: 30%;">
                <img src="/assets/img/logo_whiteBlack.png" alt="logo" class="w-25" style="height: 110px;">
                <div class="d-flex flex-column text-white" style="margin-left: 6px; width:100%;">
                    <h4 class="mt-3">Klinik Makmur Jaya 3</h4>
                    <span style="font-size: 14px;">Jl. Ceger Raya No.15, Jurang Manggu Tim., Kec. Pd. Aren, Kota Tangerang Selatan</span>
                </div>
            </div>


            <div class="mt-3" style="color: #000;">

                <div class="row mb-3 pt-3">
                    <div class="col-md-4">Tanggal Antrian</div>
                    <div class="col-md-8">: <?= date('d F Y', strtotime($antrian->tgl_antrian)) ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">Nama Pasien</div>
                    <div class="col-md-8">: <?= $antrian->nama_pasien ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">Jenis Pelayanan</div>
                    <div class="col-md-8">: <?= $antrian->jenis_pelayanan ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">Nomer Antrian</div>
                    <div class="col-md-8">: <?= $antrian->urutan ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">Nama Dokter:</div>
                    <div class="col-md-8">: <?= $antrian->nama_dokter ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">Estimasi kedatangan</div>
                    <div class="col-md-8">: <?= $antrian->estimasi_kedatangan ?></div>
                </div>
            </div>

            <span class="font-weight-bold text-danger">Perhatian.</span>
            <span class="font-weight-bold font-italic text-dark">
                "Silahkan datang 10 menit lebih awal sebelum estimasi dipanggil".
            </span>
        </div>


        <!-- <h3 class="mb-3">Kliniku</h3>
        <div class="row">
            <div class="col-md-2">Nama Pasien</div>
            <div class="col-md-7">: <?= $antrian->nama_pasien ?></div>
        </div>
        <div class="row">
            <div class="col-md-2">Jenis Pelayanan</div>
            <div class="col-md-7">: <?= $antrian->jenis_pelayanan ?></div>
        </div>
        <div class="row">
            <div class="col-md-2">Nama Dokter</div>
            <div class="col-md-7">: <?= $antrian->nama_dokter ?></div>
        </div>
        <div class="row mb-4">
            <div class="col-md-2">Estimasi Kedatangan</div>
            <div class="col-md-7">: <?= $antrian->estimasi_kedatangan ?></div>
        </div>
        <h5>Semoga Lekas Sembuh</h5> -->
    </div>
</body>

</html>