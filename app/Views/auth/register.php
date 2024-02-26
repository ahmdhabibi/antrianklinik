<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/custome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="/assets/img/Logo_KMJ.png">

    <title>Halaman Pendaftaran</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand ml-3 d-flex align-items-center" href="/#home">
                <img src="/assets/img/Logo_KMJ.png" alt="Klinik Makmur Jaya">
                <span class="ml-3 brand-text-green">Klinik Makmur</span>
                <span class="brand-text-yellow">Jaya 3</span>
            </a>

            <!-- Tombol Toggle dengan tiga garis lurus -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <div class="toggle-lines"></div>
                <div class="toggle-lines"></div>
                <div class="toggle-lines"></div>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto ml-xl-auto mr-xl-7">
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="/#home">
                            <i class="fa fa-user opacity-6 text-dark mr-1"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="/#information">
                            <i class="fa fa-user opacity-6 text-dark mr-1"></i>
                            Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="/#contact">
                            <i class="fas fa-user-circle opacity-6 text-dark mr-1"></i>
                            Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="/#helper">
                            <i class="fas fa-key opacity-6 text-dark mr-1"></i>
                            Helper
                        </a>
                    </li>
                </ul>
                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-round btn-block mb-0 btn-dark text-white-50 mr-2" href="/">Home</a>
                </li>
            </div>
        </div>
    </nav>

    <section id="information" class="jumbotron mt-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <div class="text-black mb-3">
                                <h3 class="card-title mb-3">Silahkan Daftar</h3>
                                <!-- Menampilan alert notifikasi -->
                                <?php session();
                                if (session()->getFlashdata('notif')) : ?>
                                    <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                                        <strong>Berhasil !</strong> <?= session()->getFlashdata('notif'); ?>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form class="text-black-50" method="post" action="/simpan">
                                <?= csrf_field() ?>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="username" name="username" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="password1">Password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="pss1" name="pss1" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent toggle-password" id="togglePassword1">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="pss2">Konfirmasi Password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="pss2" name="pss2" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent toggle-password" id="togglePassword2">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="nik">NIK <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nik" name="nik" required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" onchange="hitungUmur()" required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="umur">Umur <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="umur" name="umur" readonly required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="gender" required>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="telp">Telp / Whatsapp <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="telp" name="telp" required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="status_pasien">Status Pasien <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="status_pasien" id="status_pasien" required>
                                                <option value="Non BPJS">Non BPJS</option>
                                                <option value="BPJS">BPJS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <div class="col-md-3">
                                        <label for="nomor_bpjs">Nomor BPJS <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nomor_bpjs" name="nomor_bpjs" required>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bi bi-person-square"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-gradient border-0">Daftar</button>
                            </form>
                            <p class="mt-3">Sudah punya akun? <a href="/login" class="text-danger">Login di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- for password -->
    <script>
        // Mengambil elemen input password dan ikon mata
        const passwordInput1 = document.getElementById("pss1");
        const passwordInput2 = document.getElementById("pss2");
        const togglePassword1 = document.getElementById("togglePassword1");
        const togglePassword2 = document.getElementById("togglePassword2");

        // Fungsi untuk menampilkan atau menyembunyikan password
        togglePassword1.addEventListener("click", function() {
            if (passwordInput1.type === "password") {
                passwordInput1.type = "text";
                togglePassword1.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput1.type = "password";
                togglePassword1.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });

        togglePassword2.addEventListener("click", function() {
            if (passwordInput2.type === "password") {
                passwordInput2.type = "text";
                togglePassword2.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput2.type = "password";
                togglePassword2.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });

        function hitungUmur() {
            // Ambil nilai tanggal lahir dari input
            var tanggalLahir = new Date(document.getElementById('tgl_lahir').value);

            // Hitung umur
            var today = new Date();
            var umur = today.getFullYear() - tanggalLahir.getFullYear();

            // Periksa apakah ulang tahun sudah berlalu atau belum
            if (today.getMonth() < tanggalLahir.getMonth() || (today.getMonth() === tanggalLahir.getMonth() && today.getDate() < tanggalLahir.getDate())) {
                umur--;
            }

            // Tampilkan umur di input umur
            document.getElementById('umur').value = umur;
        }
    </script>

</body>

</html>