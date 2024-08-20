<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Antrian - Rumah Sakit</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Pasien</h1>
        <?php if(session('id')->role == 'pasien') : ?>
            <div class="section-header-button">
                <a href="<?= site_url('antrian/add') ?>" class="btn btn-primary">Add New</a>
            </div>
        <?php endif ?>
    </div>

    <?php if(session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif ?>
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
        <?php foreach ($antrian as $specialization => $data) : ?>
            <?php if(!empty($data)) : ?>
            <div class="card">
                <div class="card-header">
                    <h4>Data Antrian Pasien</h4>
                </div>
                <div class="card-body table-responsive">
                        <h5>Spesialisasi: <?= $specialization ?></h5>
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Nomor Antrian</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <?php if(session('id')->role == 'admin') : ?>
                                        <th>Action</th>
                                    <?php endif ?>
                                </tr>
                                <?php foreach ($data as $key => $value) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['nama_pasien'] ?></td>
                                        <td><?= $value['nama_dokter'] ?></td>
                                        <?php if($value['status'] == 'menunggu') : ?>
                                            <td class="text-warning"><?= ucwords($value['status']) ?></td>
                                        <?php elseif($value['status'] == 'panggilan') : ?>
                                            <td class="text-danger"><?= ucwords($value['status']) ?></td>
                                        <?php elseif($value['status'] == 'selesai') : ?>
                                            <td class="text-success"><?= ucwords($value['status']) ?></td>
                                        <?php endif ?>
                                        <td><?= $value['tanggal'] ?></td>
                                        <?php if(session('id')->role == 'admin') : ?>
                                            <td style="width: 15%">
                                                <form action="<?= site_url('antrian/'.$value['id_antrian']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button href="<?= site_url('antrian/delete/'.$value['id_antrian']) ?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
</section>
<?= $this->endSection() ?>
