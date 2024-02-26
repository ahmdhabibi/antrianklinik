<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        p,
        span,
        table {
            font-size: 12px
        }

        table {
            width: 100%;
            border: 1px solid #dee2e6;
        }

        table#tb-item tr th,
        table#tb-item tr td {
            border: 1px solid #000
        }
    </style>
</head>

<body>
    <br />
    <table cellpadding="0">
        <tr>
            <td width="25%" style="height: 15px">Periode</td>
            <td width="75%" style="height: 15px">: <?= $periode ?></td>
        </tr>
        <tr>
            <td width="25%" style="height: 15px">Jenis Pelayanan</td>
            <td width="75%" style="height: 15px">: <?= $data->jenis_pelayanan ?></td>
        </tr>
        <!-- <tr>
            <td width="25%" style="height: 15px">Dokter</td>
            <td width="75%" style="height: 15px">: <?= $data->nama ?></td>
        </tr> -->
    </table>
    <br /><br />
    <tr>
        <td width="8%" style="height: 40px">No</td>
        <td width="15%" style="height: 40px">Tgl Antrian</td>
        <td width="27%" style="height: 40px">Nama Pasien</td>
        <td width="30%" style="height: 40px">Alamat</td>
        <td width="30%" style="height: 40px">Dokter</td>
        <td width="10%" style="height: 40px">Estimasi Datang</td>
        <td width="10%" style="height: 40px">Jam Dilayani</td>
    </tr>
    <?php
    $no = 1;
    foreach ($antrian as $p) : ?>
        <tr>
            <td width="8%" style="height: 25px"><?= $no++ ?></td>
            <td width="15%" style="height: 25px"><?= date('d-M-Y', strtotime($p->tgl_antrian)) ?></td>
            <td width="27%" style="height: 25px"><?= $p->nama_pasien ?></td>
            <td width="27%" style="height: 25px"><?= $p->nama_dokter ?></td>
            <td width="30%" style="height: 25px"><?= $p->alamat_pasien ?></td>
            <td width="10%" style="height: 25px"><?= $p->estimasi_kedatangan ?></td>
            <td width="10%" style="height: 25px"><?= $p->dipanggil ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>

</html>