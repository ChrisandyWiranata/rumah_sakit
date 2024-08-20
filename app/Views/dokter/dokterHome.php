<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Go Antrian - Rumah Sakit</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error !</b>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <h5>Dashboard <?= ucwords(session('id')->role) ?></h5>
            </div>
        </div>

        <?php if (!empty($antrian)) : ?>
        <div class="row mt-4">
            <div class="col-12">
                <a href="<?= site_url('dokter/call') ?>" class="btn btn-primary">Panggil Antrian</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Data Antrian Pasien</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr>
                            <th>Nomor Antrian</th>
                            <th>Nama Pasien</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php foreach ($antrian as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nama_pasien'] ?></td>
                                <?php if($value['status'] == 'menunggu') : ?>
                                    <td class="text-warning"><?= ucwords($value['status']) ?></td>
                                <?php elseif($value['status'] == 'panggilan') : ?>
                                    <td class="text-danger"><?= ucwords($value['status']) ?></td>
                                <?php elseif($value['status'] == 'selesai') : ?>
                                    <td class="text-success"><?= ucwords($value['status']) ?></td>
                                <?php endif ?>
                                <td><?= $value['tanggal'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else : ?>
            <h4>Belum ada pasien</h4>
        <?php endif ?>
    </div>
</section>
<?= $this->endSection() ?>