<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update User - Rumah Sakit</title>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('user') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Update User</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Edit User</h4>
            </div>
            <div class="card-body col-md-6">
                <form action="<?= site_url('user/'.$user->id) ?>" method="POST" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="username">Nama User *</label>
                        <input type="text" id="username" name="username" value="<?= $user->username ?>" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Email User *</label>
                        <input type="email" id="email" name="email" value="<?= $user->email ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password User *</label>
                        <input type="password" id="password" name="password" value="<?= $user->password ?>" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>