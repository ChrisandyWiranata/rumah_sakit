<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Home - Rumah Sakit</title>
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
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users (Pasien)</h4>
                        </div>
                        <div class="card-body"><?= $totalUsers ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-hospital"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Rekam Medis in Hospital</h4>
                        </div>
                        <div class="card-body"><?= $total ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Rekam Medis by Pasien</h4>
                            <div>Nama Pasien: <?= (!empty($nama_pasien)) ? $nama_pasien->nama_pasien : '' ?></div> 
                            <div class="card-body"><?= (!empty($total_rekam_medis_pasien)) ? $total_rekam_medis_pasien : 0 ?></div>
                            <form action="<?= site_url('admin/pasien') ?>" method="post">
                            <?= csrf_field() ?>
                                <div class="form-group">
                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Masukkan nama pasien" required>
                                    <div class="invalid-feedback">
                                    Please fill in your nama
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Rekam Medis by Category</h4>
                            <div class="card-body"><?= (!empty($total_rekam_medis_category)) ? $total_rekam_medis_category : 0 ?></div>
                            <form action="<?= site_url('admin/category') ?>" method="post">
                            <?= csrf_field() ?>
                                <select id="categorySelect" name="categorySelect" class="form-control">
                                    <option value="umum" <?= (!empty($kategori) && $kategori->kategori == 'Umum') ? 'selected' : '' ?>>Umum</option>
                                    <option value="mata" <?= (!empty($kategori) && $kategori->kategori == 'Mata') ? 'selected' : '' ?>>Mata</option>
                                    <option value="kandungan" <?= (!empty($kategori) && $kategori->kategori == 'Kandungan') ? 'selected' : '' ?>>Kandungan</option>
                                    <option value="bedah" <?= (!empty($kategori) && $kategori->kategori == 'Bedah') ? 'selected' : '' ?>>Bedah</option>
                                    <option value="anak" <?= (!empty($kategori) && $kategori->kategori == 'Anak') ? 'selected' : '' ?>>Anak</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-12">
            <div class="card-header">
                <h4>Medical Records Trend</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="200" height="100"></canvas>
            </div>
        </div>

        <?php if(!empty($rekam_medis_pasien)) : ?>
            <div class="card">
                <div class="card-header">
                    <h4>Rekam Medis Pasien</h4>
                </div>
                <div class="card-body table-responsive">
                        <h5>Nama Pasien: <?= $nama_pasien->nama_pasien ?></h5>
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Tindakan</th>
                                    <th>Tanggal</th>
                                </tr>
                                <?php foreach ($rekam_medis_pasien as $key => $value) : ?>
                                    <tr>
                                        <th><?= $key + 1 ?></th>
                                        <th><?= $value->nama_pasien ?></th>
                                        <th><?= $value->nama_dokter ?></th>
                                        <th><?= $value->keluhan ?></th>
                                        <th><?= $value->tindakan ?></th>
                                        <th><?= date('Y-m-d', strtotime($value->created_at)) ?></th>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(!empty($rekam_medis_kategori)) : ?>
            <div class="card">
                <div class="card-header">
                    <h4>Rekam Medis Pasien</h4>
                </div>
                <div class="card-body table-responsive">
                        <h5>Spesialisasi: <?= $kategori->kategori ?></h5>
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Tindakan</th>
                                    <th>Tanggal</th>
                                </tr>
                                <?php foreach ($rekam_medis_kategori as $key => $value) : ?>
                                    <tr>
                                        <th><?= $key + 1 ?></th>
                                        <th><?= $value->nama_pasien ?></th>
                                        <th><?= $value->nama_dokter ?></th>
                                        <th><?= $value->keluhan ?></th>
                                        <th><?= $value->tindakan ?></th>
                                        <th><?= date('Y-m-d', strtotime($value->created_at)) ?></th>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chartData = {
        labels: <?= $chart_years ?>,
        datasets: [{
            label: 'Total Medical Records',
            data: <?= $chart_totals ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>
