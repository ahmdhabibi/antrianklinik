<?php $session = \Config\Services::session(); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark bg-warning topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <?php
            // Mendapatkan informasi tanggal saat ini
            $tanggal_sekarang = date("d");
            $bulan_sekarang = date("n");
            $tahun_sekarang = date("Y");

            // Mendapatkan nama hari berdasarkan tanggal saat ini dalam bahasa Indonesia
            $nama_hari = date("l", strtotime($tahun_sekarang . "-" . $bulan_sekarang . "-" . $tanggal_sekarang));
            $nama_hari_indonesia = [
                "Sunday" => "Minggu",
                "Monday" => "Senin",
                "Tuesday" => "Selasa",
                "Wednesday" => "Rabu",
                "Thursday" => "Kamis",
                "Friday" => "Jumat",
                "Saturday" => "Sabtu"
            ];
            $nama_hari = $nama_hari_indonesia[$nama_hari];

            // Mendapatkan nama bulan berdasarkan tanggal saat ini dalam bahasa Indonesia
            $nama_bulan = date("F", strtotime($tahun_sekarang . "-" . $bulan_sekarang . "-" . $tanggal_sekarang));
            $nama_bulan_indonesia = [
                "January" => "Januari",
                "February" => "Februari",
                "March" => "Maret",
                "April" => "April",
                "May" => "Mei",
                "June" => "Juni",
                "July" => "Juli",
                "August" => "Agustus",
                "September" => "September",
                "October" => "Oktober",
                "November" => "November",
                "December" => "Desember"
            ];
            $nama_bulan = $nama_bulan_indonesia[$nama_bulan];
            ?>
            <div class="container-fluid text-white" style="font-size: small;">
                <?= $nama_hari . ", " . $tanggal_sekarang . " " . $nama_bulan . " " . $tahun_sekarang; ?>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white small"><?= $session->nama ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/'); ?>img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- End of Topbar -->