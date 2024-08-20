
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Rumah Sakit</title>

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
                <div class="card-header">
                <div class="card-header-back">
                  <a href="<?= site_url('login') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h4>Register</h4>
              </div>

              <div class="card-body">
                <?php if(session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">x</button>
                            <b>Error !</b>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                <?php endif ?>
                <form method="POST" action="<?= site_url('register') ?>" class="needs-validation" novalidate="">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Please fill in your name
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="2" required>
                    <div class="invalid-feedback">
                        Please fill in your email
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="3" required>
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" class="form-control" name="role" tabindex="4" required>
                        <option value="pasien">Pasien</option>
                        <option value="dokter">Dokter</option>
                    </select>
                </div>

                <div class="form-group" id="alamatInput" style="display: none;">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control" name="alamat" tabindex="5">
                    <div class="invalid-feedback">
                        Please fill in your address
                    </div>
                </div>

                <div class="form-group" id="tanggalLahirInput" style="display: none;">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" tabindex="6">
                    <div class="invalid-feedback">
                        Please fill in your date of birth
                    </div>
                </div>

                <div class="form-group" id="spesialisasiInput" style="display: none;">
                    <label for="spesialisasi">Spesialisasi</label>
                    <select id="spesialisasi" class="form-control" name="spesialisasi" tabindex="7">
                      <option value="Umum">Umum</option>
                      <option value="Bedah">Bedah</option>
                      <option value="Anak">Anak</option>
                      <option value="Kandungan">Kandungan</option>
                      <option value="Mata">Mata</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="8">
                        Register
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
  <script>
    $(document).ready(function () {
      function toggleInputs() {
        var selectedRole = $('#role').val();
        $('#alamatInput').hide().find('input').removeAttr('required');
        $('#tanggalLahirInput').hide().find('input').removeAttr('required');
        $('#spesialisasiInput').hide().find('select').removeAttr('required');

        if (selectedRole === 'pasien') {
          $('#alamatInput').show().find('input').attr('required', true);
          $('#tanggalLahirInput').show().find('input').attr('required', true);
        } else if (selectedRole === 'dokter') {
          $('#spesialisasiInput').show().find('select').attr('required', true);
        }
      }

      toggleInputs();

      $('#role').change(function () {
        toggleInputs();
      });
    });
  </script>
</body>
</html>
