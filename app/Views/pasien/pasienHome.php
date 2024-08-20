<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Home - Rumah Sakit</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <h5>Dashboard <?= ucwords(session('id')->role) ?></h5>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Rekam Medis <?= ucwords(session('id')->username) ?></h4>
                        </div>
                        <div class="card-body"><?= $total_rekam_medis ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Rekam Medis >>> <?= ucwords(session('id')->username) ?></h4>
            </div>
            <div class="card-body table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Nama Dokter</th>
                                <th>Kategori</th>
                                <th>Keluhan</th>
                                <th>Tindakan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                            <?php foreach ($pasien as $key => $value) : ?>
                                <tr>
                                    <th><?= $key + 1 ?></th>
                                    <th><?= $value->nama_dokter ?></th>
                                    <th><?= $value->kategori ?></th>
                                    <th><?= $value->keluhan ?></th>
                                    <th><?= $value->tindakan ?></th>
                                    <th><?= date('Y-m-d', strtotime($value->created_at)) ?></th>
                                    <th><?= date('H:i', strtotime($value->created_at)) ?></th>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>