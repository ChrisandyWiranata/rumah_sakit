<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Antrian - Rumah Sakit</title>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('antrian') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create Antrian</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Antrian</h4>
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

            <div class="card-body col-md-6">
                <form action="<?= site_url('antrian') ?>" method="POST" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="keluhan">Keluhan:</label><br>
                        <textarea type="text" rows="4" cols="64" id="keluhan" name="keluhan" required autofocus></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dokter">Dokter:</label>
                        <select class="form-control" id="dokter" name="dokter" required>
                            <?php foreach ($dokter as $key => $value) : ?>
                            <option value="<?= $value->id_user ?>">
                                <?= $value->nama ?> (Spesialisasi: <?= $value->spesialisasi ?>)
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
