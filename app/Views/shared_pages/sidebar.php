<!-- Sidebar -->
<ul class="navbar-nav bg-white sidebar sidebar-light  accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text">Pelayanan Antrian</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading mt-3">
        Interface
    </div>

    <?php foreach ($dtmenu as $dtm) : ?>
        <?php foreach ($dtm as $menu) : ?>
            <li class="nav-item menu-items">
                <?php if ($menu->punya_submenu != 1) : ?>
                    <a class="nav-link" href="<?= $menu->url; ?>">
                        <i class="<?= $menu->icon ?>"></i>
                        <span><?= $menu->nama ?></span>
                    </a>
                <?php else : ?>
                    <a class="nav-link collapsed" data-toggle="collapse" href="#" data-target="#<?= $menu->submenu ?>" aria-expanded="true" aria-controls="<?= $menu->submenu ?>">
                        <i class="<?= $menu->icon ?>"></i>
                        <span><?= $menu->nama ?></span>
                    </a>
                    <div id="<?= $menu->submenu ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php foreach ($dtsubmenu[$menu->id] as $d) : ?>
                                <a class="collapse-item" href="<?= $d->url ?>"><?= $d->nama ?></a>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="/profile">
            <i class="fas fa-user-tag"></i>
            <span>Profile</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/ubahpassword">
            <i class="fas fa-lock-open"></i>
            <span>Ubah Password</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->