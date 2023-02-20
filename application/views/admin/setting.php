<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header bg-primary text-dark">
						<div class="row">
							<div class="col-xl-12">
								<h3>Pengaturan Jadwal Absensi</h3>
								<p class="m-0">Atur jadwal Jam Masuk dan Jam Keluar</p>
								<p class="m-0">Atur Lokasi Kantor</p>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form action="<?= base_url('admin/setting/edit'); ?>" method="post">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Jam Masuk</label>
										<input type="hidden" name="id_setting" value="<?= $setting->id; ?>">
										<input type="text" class="form-control js-masked-time" name="jamMasuk" value="<?= date('H:i', strtotime($setting->jamMasuk)); ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Jam Keluar</label>
										<input type="text" class="form-control js-masked-time" name="jamKeluar" value="<?= date('H:i', strtotime($setting->jamKeluar)); ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Garis Lintang-Bujut</label>
										<input type="text" class="form-control" name="lintangBujur" value="<?= $setting->lintangBujur; ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Batas Jarak</label>
										<input type="number" class="form-control" name="jarak" value="<?= $setting->jarak; ?>">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
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
							<span>Jam Keluar <?= $setting->jamKeluar; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?= base_url('assets/js/jquery.maskedinput/'); ?>jquery.maskedinput.min.js"></script>

<script>
	$('.js-masked-time').mask('99:99');
</script>