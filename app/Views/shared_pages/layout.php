<?= $this->include('shared_pages/header') ?>
<?= $this->include('shared_pages/sidebar') ?>
<?= $this->include('shared_pages/topbar') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $heading ?></h1> -->

    <!-- blok konten dinamis -->
    <?= $this->renderSection('content') ?>

</div>
<!-- End of Main Content -->
<?= $this->include('shared_pages/footer') ?>