<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/custome.css">
    <link href="vassets/endor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/animate.css">
    <link rel="stylesheet" href="/assets/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="shortcut icon" href="/assets/img/Logo_KMJ.png">

    <title>Klinik Makmur Jaya - Home</title>
    <style>
        #information {
            background-image: url('<?= base_url("assets/"); ?>/img/bg02.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand ml-3 d-flex align-items-center" href="#">
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
                        <a class="nav-link mr-2" href="#home">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="#information">
                            Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="#contact">
                            Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" href="#helper">
                            Helper
                        </a>
                    </li>
                </ul>
                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-round btn-sm mb-0 btn-outline-danger mr-2" href="/login">Daftar / Login</a>
                </li>
            </div>
        </div>
    </nav>

    <section class="jumbotron" id="home" style="height: 100%;">
        <div class="container-fluid pt-5">
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6 align-items-center my-5" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500">
                    <h1 class="text-danger">Hallo Selamat datang</h1>
                    <p>
                        Jika hatimu terluka maka sembahyanglah, tapi jika tubuhmu sakit maka periksalah - karena
                        kesehatanmu adalah investasi terpenting.
                    </p>
                    <p>
                        Daftarkan diri Anda bersama kami, mari bersama kami merawat tubuh Anda agar selalu dalam keadaan
                        prima.
                        Dapatkan perawatan medis berkualitas dengan tenaga ahli kami, sehingga Anda dapat hidup sehat,
                        bahagia,
                        dan penuh energi.
                    </p>
                    <p>
                        Kesehatanmu adalah prioritas kami, karena Anda layak mendapatkan yang terbaik.
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                        <img src="/assets/img/bg.png" alt="" style="max-width: 100%; max-height: 100vh;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="helper" class="jumbotron">
        <div class="container">
            <h2 class="text-center">Pendaftaran Antrian</h2>
            <div class="row pt-3">
                <div class="col-md-6">
                    <h3>Antrian Online</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_1" allowfullscreen></iframe>
                    </div>
                    <p>Pendaftaran antrian secara online memungkinkan Anda untuk mendaftar dan mengatur antrian Anda melalui
                        platform online.</p>
                </div>
                <div class="col-md-6">
                    <h3>Antrian Offline</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_2" allowfullscreen></iframe>
                    </div>
                    <p>Pendaftaran antrian secara offline mengharuskan Anda untuk datang langsung ke lokasi pendaftaran
                        untuk mendaftar secara manual.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="information" class="jumbotron-fluid pb-5">
        <div class="container">
            <div class="row text-center text-white pt-5 mb-5">
                <dilv class="col">
                    <h2>FASILITAS KESEHATAN</h2>
                </dilv>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800">
                        <img src="/assets/img/poli_umum.jpeg" class="card-img-top" alt="pelayanan01" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Umum </p>
                                <p class="text-black-50">(Senin - Minggu = 07:00 - 21:00)</p>
                                <!-- <p>Senin - Rabu : dr. Bima Nugroho</p>
                                <p>Kamis - Sabtu : dr. Zainal Abidin</p>
                                <p>Minggu : Sakinah Mawadah ramadiana</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="600">
                        <img src="/assets/img/poli_gigi.jpeg" class="card-img-top" alt="pelayanan02" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Gigi </p>
                                <p class="text-black-50">(Senin - Sabtu = 16:00 - 20:00)</p>
                                <p class="text-black-50">(Kamis = 07:00 - 11:00)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800">
                        <img src="/assets/img/poli_bidan.jpeg" class="card-img-top" alt="pelayanan05" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Bidan</p>
                                <p class="text-black-50">(Senin - Minggu = 09:00 - 18:00)</p>
                                <!-- <p>Senin - Kamis: dr. Amri Alamsyah</p>
                                <p>Jumat - Minggu: dr. Nurul Fatiyah Amiyanti</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="1000">
                        <img src="/assets/img/poli_radiologi.jpeg" class="card-img-top" alt="pelayanan04" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Radiologi Ultrasonografi</p>
                                <p class="text-black-50">(Senin - Jumat = 17:00 - 19:45)</p>
                                <p class="text-black-50">(Sabtu = 08:00 - 11:45)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section id="information" class="jumbotron-fluid pb-5">
        <div class="container">
            <div class="row text-center text-white pt-5 mb-5">
                <div class="col">
                    <h2>FASILITAS KESEHATAN</h2>
                </div>
            </div>
            <div class="row custom-grid justify-content-center">
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800">
                        <img src="/assets/img/poli_umum.png" class="card-img-top" alt="pelayanan01" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Umum</p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero aliquam delectus veniam.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="600">
                        <img src="/assets/img/poli_gigi.png" class="card-img-top" alt="pelayanan02" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Gigi</p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam soluta amet inventore.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="800">
                        <img src="/assets/img/poli_radiologi.png" class="card-img-top" alt="pelayanan03" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Radiologi</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="1000">
                        <img src="/assets/img/apotek.png" class="card-img-top" alt="pelayanan04" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Apotek</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800">
                        <img src="/assets/img/poli_anak.png" class="card-img-top" alt="pelayanan05" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Anak</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="600">
                        <img src="/assets/img/poli_bidan.png" class="card-img-top" alt="pelayanan06" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli Bidan</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="800">
                        <img src="/assets/img/poli_usg.png" class="card-img-top" alt="pelayanan07" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Poli USG</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 custom-card mb-3">
                    <div class="card" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="1000">
                        <img src="/assets/img/labotarium.png" class="card-img-top" alt="pelayanan08" />
                        <div class="card-body bg-light">
                            <div class="card-text">
                                <p class="text-danger">Labotarium</p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias repellendus doloremque
                                labore!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="jumbotron-fluid pb-5" id="contact" style="height: 100%;">
        <div class="container-fluid pt-5">
            <div class="row">
                <!-- Kolom Kiri (Google Maps) -->
                <div class="col-md-6">
                    <!-- Google Maps Embed -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11217.569372875514!2d106.73299291065088!3d-6.262453511064907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb074a100117%3A0x972b770b547b5f0b!2sKlinik%20Makmur%20Jaya%203!5e0!3m2!1sid!2sid!4v1696381750947!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Kolom Kanan (Contact Us) -->
                <div class="col-md-6">
                    <!-- Judul "Contact Kami" -->
                    <h2>Contact Us</h2>
                    <!-- Formulir Kontak -->
                    <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
                        <strong>Thankyou</strong> pesan anda sudah kami terima. Salam Sehat :D
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="pelanggan-klinikmakmurjaya3">
                        <div class="form-group">
                            <label for="nama">Name:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pesan">Message:</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-send">Send</button>
                        <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="text-dark py-5" style="background: linear-gradient(to bottom, #00ff00, #ffff00);height: 100%; position: relative;">
        <div class="container mb-4">
            <div class="row">
                <div class="col-md-4">
                    <!-- Footer Logo -->
                    <img class="footer-logo img-fluid" src="/assets/img/logo_whiteBlack.png" height="90" alt="">
                    <!-- Small Description -->
                    <p>© 2019, Klinik Pratama Makmur Jaya</p>
                    <!-- Social Icons -->
                    <div class="social-icons mt-3">
                        <a href="https://www.youtube.com/channel/UCVreJabFKCMN47r1rlWmyZg" class="btn btn-link border-dark text-secondary" data-toggle="tooltip" data-placement="top" title="Youtube">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="https://www.instagram.com/makmurjaya_group/" class="btn btn-link border-dark text-secondary" data-toggle="tooltip" data-placement="top" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/klinik.makmurjaya.9/" class="btn btn-link border-dark text-secondary" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/kmakmurjaya" class="btn btn-link border-dark text-secondary" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://twitter.com/kmakmurjaya" class="btn btn-link border-dark text-secondary" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                    <!-- /Social Icons -->
                </div>


                <div class="col-md-3">
                    <!-- Latest Blog Post -->
                    <h4 class="mb-4">Klinik Pratama Makmur Jaya</h4>
                    <p>Klinik Pratama Makmur Jaya berdiri pada tanggal 1 Juni 2009, bertujuan untuk memberikan pelayanan
                        kesehatan bagi masyarakat sekitar. Dengan berkembangnya pertumbuhan penduduk serta permintaan
                        pelayanan yang lebih, tahun 2013 Klinik Pratama Makmur Jaya melebarkan pelayanan operasionalnya,
                        sehingga menambah pelayanan untuk peningkatan kesehatan dan menunjang program pemerintah khususnya
                        program Kesehatan Ibu dan Anak.</p>
                    <!-- /Latest Blog Post -->
                </div>

                <div class="col-md-2">
                    <!-- Links -->
                    <h4 class="mb-4">LINK</h4>
                    <ul class="footer-links list-unstyled">
                        <li><a href="https://klinikmakmurjaya.com/Platform MJKu">Platform MJKu</a></li>
                    </ul>
                    <!-- /Links -->
                </div>

                <div class="col-md-3">
                    <!-- Newsletter Form -->
                    <h4 class="mb-4">HUBUNGI KAMI</h4>
                    <!-- Contact Address -->
                    <address>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fas fa-map-marker-alt"></i> Jl. W R Supratman Blok Jambu No.29, Cemp. Putih, Kec.
                                Ciputat Tim., Kota Tangerang Selatan, Banten
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i> <a href="mailto:kmjkampungutan@gmail.com">kmjkampungutan@gmail.com</a>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i> (021) 742-1146 (KMJ 1)
                            </li>
                        </ul>
                    </address>
                    <!-- /Contact Address -->
                </div>
            </div>
        </div>
        </div>
        <div class="copyright" style="background-color: rgba(0,0,0,0.2);
            text-shadow: 1px 1px 1px rgb(0 0 0 / 10%);
            padding: 25px;
            font-size: 13px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;">

            <div class="container text-center">
                <span>Template Footer: Klinik Pratama Makmur Jaya © 2019, Devanalogy Studio</span>
                <span class="mx-2 text-black-50">||</span>
                <span id="editingInfo">Editing By: © <span id="currentYear"></span>, Habibi Unpam</span>
            </div>
        </div>
    </footer>

    <script>
        // Fungsi untuk mendapatkan tahun saat ini
        function getCurrentYear() {
            return new Date().getFullYear();
        }

        // Mengisi tahun saat ini ke elemen dengan ID "currentYear"
        document.getElementById("currentYear").textContent = getCurrentYear();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- script buat animasi on scrool -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        const scriptURL = 'https://script.google.com/macros/s/AKfycbxM-TuHJF-3GDH5I8ogoGjA639OK70OkhlRvXLsLNJgKtw8gY00kP1SVV0cID-r42fIqg/exec';
        const form = document.forms['pelanggan-klinikmakmurjaya3'];
        const btnSend = document.querySelector('.btn-send');
        const btnLoading = document.querySelector('.btn-loading');
        const myAlert = document.querySelector('.my-alert');

        form.addEventListener('submit', e => {
            e.preventDefault();
            //ketika tombol submit diklik
            // tampilkan tombol loading, hilangkan tombol kirim

            btnLoading.classList.toggle('d-none');
            btnSend.classList.toggle('d-none');

            fetch(scriptURL, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => {

                    // tampilkan tombol kirim, hilangkan tombol loading
                    btnLoading.classList.toggle('d-none');
                    btnSend.classList.toggle('d-none');
                    console.log('Success!', response);

                    // tampilkan alert
                    myAlert.classList.toggle('d-none');

                    //reset formnya
                    form.reset();

                })
                .catch(error => console.error('Error!', error.message));
        })
    </script>

</body>

</html>