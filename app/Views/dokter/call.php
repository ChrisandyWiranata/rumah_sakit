<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Call Antrian &mdash; Rumah Sakit</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Rekam Medis</h4></div>

              <div class="card-body">
                <?php if(session()->getFlashdata('Success')) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">x</button>
                            <b>Success !</b>
                            <?= session()->getFlashdata('Success') ?>
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
                <form method="POST" action="<?= site_url('rekam') ?>" class="needs-validation" novalidate="">
                <?= csrf_field(); ?>
                  <div class="form-group">
                    <label>Kode Antrian: <label id="id_antrian"><?= $rekam->id_antrian ?></label></label><br>
                    <label>Tanggal: <label id="tanggal"><?= $rekam->tanggal ?></label></label><br>
                    <label>Nama Pasien: <label id="nama_pasien"><?= $rekam->nama_pasien ?></label></label><br>
                    <label>Nama Dokter: <label id="nama_dokter"><?= $rekam->nama_dokter ?></label></label><br>
                    <label>Spesialisasi: <label id="kategori"><?= $rekam->spesialisasi ?></label></label><br>
                    <label>Keluhan: <label id="keluhan"><?= $rekam->keluhan ?></label></label><br>
                  </div>
                  <div class="form-group">
                    <label for="tindakan">Tindakan: </label>
                    <textarea id="tindakan" class="form-control" name="tindakan" tabindex="1" required autofocus></textarea>
                    <div class="invalid-feedback">
                      Please fill in your move
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Submit
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Chrisandy Wiranata 2024
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>

</body>
</html>
