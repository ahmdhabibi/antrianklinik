<?php
$session = \Config\Services::session();
$validation = \Config\Services::validation();
?>
<?php $this->extend('shared_pages/layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?= $heading ?></h4>
        </div>
        <!-- Menampilan alert notifikasi -->
        <div class="card-body">
            <?php session();
            if (session()->getFlashdata('notif')) : ?>
                <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                    <strong>Berhasil !</strong> <?= session()->getFlashdata('notif'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php session();
            if (session()->getFlashdata('gagal')) : ?>
                <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                    <strong>Gagal !</strong> <?= session()->getFlashdata('gagal'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('antrian_next'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Antrian</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tgl_antrian" name="tgl_antrian" onchange="getDokter()">
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="dokter_id" id="dokter_id" onchange="getJamPelayanan()">
                            <option value="">-- Pilih Dokter --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis pelayanan</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="jam_pelayanan" id="jam_pelayanan" onchange="getPelayanan()">
                            <option value="">-- Pilih Jam --</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="hidden" class="form-control" name="pelayanan_id" id="pelayanan_id" readonly>
                        <input class="form-control" id="jenis_pelayanan" readonly>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control" id="hari_pelayanan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Pasien</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pasien_id">
                            <option value="">-- Pilih Pasien --</option>
                            <?php foreach ($pasien as $p) : ?>
                                <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-outline-primary"> Simpan</button>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function getJamPelayanan() {
        let dokter_id = $('#dokter_id').val()
        let tgl_antrian = $('#tgl_antrian').val()
        $.ajax({
            url: "/antrian/get_jam_pelayanan",
            dataType: "json",
            data: {
                dokter_id: dokter_id,
                tgl_antrian: tgl_antrian,
            },
            method: "post",
            beforeSend: function() {
                $('#jam_pelayanan').empty()
                $('#jam_pelayanan').append(
                    `<option value = "" >-- Pilih Jam --</option>`
                )
            },
            success: function(responds) {
                console.log(responds)
                responds.forEach(function(responds) {
                    $('#jam_pelayanan').append(
                        `<option value = "` + responds.jam_praktek + `" >` + responds.jam_praktek + `</option>`
                    )
                })
            }
        })
    }

    function getPelayanan() {
        let dokter_id = $('#dokter_id').val()
        let tgl_antrian = $('#tgl_antrian').val()
        let jam_pelayanan = $('#jam_pelayanan').val()
        $.ajax({
            url: "/antrian/get_pelayanan",
            dataType: "json",
            data: {
                dokter_id: dokter_id,
                tgl_antrian: tgl_antrian,
                jam_pelayanan: jam_pelayanan,
            },
            method: "post",
            beforeSend: function() {
                $('#jenis_pelayanan').empty()
                $('#hari_pelayanan').empty()
            },
            success: function(responds) {
                console.log(responds)
                $('#pelayanan_id').val(responds.pelayanan_id)
                $('#jenis_pelayanan').val(responds.jenis_pelayanan)
                $('#hari_pelayanan').val(responds.hari_praktek)
            }
        })
    }

    function getDokter() {
        let tgl_antrian = $('#tgl_antrian').val();
        let jamSaatIni = new Date().getHours(); // Mendapatkan jam saat ini

        $.ajax({
            url: "/antrian/get_dokter",
            dataType: "json",
            data: {
                tgl_antrian: tgl_antrian,
            },
            method: "post",
            beforeSend: function() {
                $('#dokter_id').empty();
                $('#dokter_id').append(
                    `<option value="" style="color: green;">-- Pilih Dokter --</option>`
                );
            },
            success: function(responds) {
                console.log(responds);
                $('#dokter_id').empty();

                responds.forEach(function(respond) {
                    let warna = '';

                    // Menetapkan warna berdasarkan jenis pelayanan
                    switch (respond.jenis_pelayanan) {
                        case 'Poli Umum':
                            warna = 'green';
                            break;
                        case 'Poli Gigi':
                            warna = 'darkblue';
                            break;
                        case 'Poli Bidan':
                            warna = 'red';
                            break;
                        case 'Poli Radiologi':
                            warna = 'darkorange';
                            break;
                        default:
                            warna = 'black'; // Warna default jika tidak cocok dengan jenis pelayanan yang diberikan
                            break;
                    }

                    // Mendapatkan jam praktek dokter
                    let jamPraktek = respond.jam_praktek.split('-');
                    let jamMulai = parseInt(jamPraktek[0].trim().split(':')[0]);
                    let jamSelesai = parseInt(jamPraktek[1].trim().split(':')[0]);

                    // Memeriksa apakah masih ada slot praktek setelah jam pendaftaran pasien
                    if (jamSelesai > jamSaatIni) {
                        $('#dokter_id').append(
                            `<option value="` + respond.dokter_id + `" style="color: ` + warna + `;">` + respond.nama_dokter + ` - (` + respond.jenis_pelayanan + ` - ` + respond.jam_praktek + `)</option>`
                        );
                    }
                });
            },
        });
    }


    // function getDokter() {
    //     let tgl_antrian = $('#tgl_antrian').val();
    //     $.ajax({
    //         url: "/antrian/get_dokter",
    //         dataType: "json",
    //         data: {
    //             tgl_antrian: tgl_antrian,
    //         },
    //         method: "post",
    //         beforeSend: function() {
    //             $('#dokter_id').empty();
    //             $('#dokter_id').append(
    //                 `<option value="" style="color: green;">-- Pilih Dokter --</option>`
    //             );
    //         },
    //         success: function(responds) {
    //             console.log(responds);
    //             $('#dokter_id').empty();

    //             responds.forEach(function(respond) {
    //                 let warna = '';

    //                 // Menetapkan warna berdasarkan jenis pelayanan
    //                 switch (respond.jenis_pelayanan) {
    //                     case 'Poli Umum':
    //                         warna = 'green';
    //                         break;
    //                     case 'Poli Gigi':
    //                         warna = 'darkblue';
    //                         break;
    //                     case 'Poli Bidan':
    //                         warna = 'red';
    //                         break;
    //                     case 'Poli Radiologi':
    //                         warna = 'darkorange';
    //                         break;
    //                     default:
    //                         warna = 'black'; // Warna default jika tidak cocok dengan jenis pelayanan yang diberikan
    //                         break;
    //                 }

    //                 $('#dokter_id').append(
    //                     `<option value="` + respond.dokter_id + `" style="color: ` + warna + `;">` + respond.nama_dokter + ` - (` + respond.jenis_pelayanan + ` - ` + respond.jam_praktek + `)</option>`
    //                 );
    //             });
    //         },
    //     });
    // }


    // function getDokter() {
    //     let tgl_antrian = $('#tgl_antrian').val()
    //     $.ajax({
    //         url: "/antrian/get_dokter",
    //         dataType: "json",
    //         data: {
    //             tgl_antrian: tgl_antrian,
    //         },
    //         method: "post",
    //         beforeSend: function() {
    //             $('#dokter_id').empty()
    //             $('#dokter_id').append(
    //                 `<option value = "" >-- Pilih Dokter --</option>`
    //             )
    //         },
    //         success: function(responds) {
    //             console.log(responds)
    //             responds.forEach(function(responds) {
    //                 $('#dokter_id').append(
    //                     `<option value = "` + responds.dokter_id + `" >` + responds.nama_dokter + `</option>`
    //                 )
    //             })
    //         }
    //     })
    // }
</script>
<?php $this->endSection() ?>