<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Home - Rumah Sakit</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
<?= $this->include('layout/dashboard') ?>

</section>
<?= $this->endSection() ?>