<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-danger">
						<i class="fas fa-boxes"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Total Jabatan</h4>
						</div>
						<div class="card-body">
							<?= $jabatan; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-primary">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Pegawai Aktif</h4>
						</div>
						<div class="card-body">
							<?= $pegawaiAktif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-info">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Pegawai TIdak Aktif</h4>
						</div>
						<div class="card-body">
							<?= $pegawaiTidakAktif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5>Lokasi Kantor</h5>
					</div>
					<div class="card-body">
						<iframe width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?= "https://maps.google.com/maps?q=" . $setting->lintangBujur . "&amp;output=embed"; ?>">
						</iframe>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<div class="bg-primary p-3 text-white text-center mb-2">
							<span>Jam Masuk <?= $setting->jamMasuk; ?></span>
						</div>
						<div class="bg-primary p-3 text-white text-center">
							<span>Jam Keluar <?= $setting->jamPulang; ?></span>
						</div>
						<div class="p-3">
							<h5>Hari Kerja</h5>
							<ul>
								<?php foreach (explode(',', $setting->hariKerja) as $n) : ?>
									<li><?= hari($n); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>