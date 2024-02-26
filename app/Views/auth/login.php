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

    <title>Halaman Login</title>
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
                <div class="col-md-6 mx-auto">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <div class="text-black mb-3">
                                <h3 class="card-title mb-3">Silahkan Masuk</h3>
                                <span class="text-black-50">Masukkan Username dan Password "Tanggal Lahir Anda"</span>
                            </div>
                            <!-- Menampilan alert notifikasi -->
                            <?php session();
                            if (session()->getFlashdata('notif')) : ?>
                                <div class="alert alert-<?= session()->color ?> alert-dismissible fade show" role="alert">
                                    <strong>Notif !</strong> <?= session()->getFlashdata('notif'); ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <form class="text-black-50" method="post" action="/ceklogin">
                                <?= csrf_field() ?>
                                <div class="form-group mb-3">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent">
                                                <i class="bi bi-person-square"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="pss" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-gradient border-0">Masuk</button>
                            </form>
                            <p class="mt-3">Belum punya akun? <a href="/register" class="text-danger">Daftar di sini</a></p>
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
        const passwordInput = document.getElementById("password");
        const togglePassword = document.querySelector(".bi-eye");

        // Fungsi untuk menampilkan atau menyembunyikan password
        togglePassword.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.classList.remove("bi-eye");
                togglePassword.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                togglePassword.classList.remove("bi-eye-slash");
                togglePassword.classList.add("bi-eye");
            }
        });
    </script>
</body>

</html>