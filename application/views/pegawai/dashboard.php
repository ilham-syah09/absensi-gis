<section class="section">
	<div class="section-header">

		<h1><?= 'Selamat datang, ' . $this->dt_pegawai->nama; ?></h1>

	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
				<div class="card">
					<div class="card-header justify-content-center bg-secondary">
						<h5>Biodata</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12 text-center mb-3">
								<img src="<?= base_url('uploads/profiles/') . $this->dt_pegawai->image; ?>" alt="Image Profile" class="img-thumbnail" width="200">
							</div>
							<div class="col-sm-12">
								<div class="bg-primary p-2 text-white mb-2">
									<span>Nama - <?= $this->dt_pegawai->nama; ?></span>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="bg-primary p-2 text-white mb-2">
									<span>NIP - <?= $this->dt_pegawai->nip; ?></span>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="bg-primary p-2 text-white">
									<span>Email - <?= $this->dt_pegawai->email; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
				<div class="card">
					<div class="card-header justify-content-center bg-secondary">
						<h5>Presensi hari ini</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<?php if (in_array(date('N'), explode(',', $setting->hariKerja))) : ?>
								<div class="col-md-12">
									<h6><?= hari(date('N')) . ', ' . date('d M Y'); ?></h6>
								</div>
								<div class="col-sm-12">
									<div class="bg-primary p-2 text-white mb-2 float-left">
										<span>Jam Masuk <?= $setting->jamMasuk; ?></span>
									</div>
									<div class="bg-success p-2 text-white mb-2 float-right">
										<span><i class="fas fa-hand-paper"></i></span>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="bg-primary p-2 text-white float-left">
										<span>Jam Keluar <?= $setting->jamPulang; ?></span>
									</div>
									<div class="bg-success p-2 text-white mb-2 float-right">
										<span><i class="fas fa-hand-paper"></i></span>
									</div>
								</div>
							<?php else : ?>
								<div class="col-sm-12">
									<div class="bg-danger p-2 text-dark">
										<h5>Hari libur</h5>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="card">
					<div class="card-header justify-content-center bg-secondary">
						<h5>Lokasi Kantor</h5>
					</div>
					<div class="card-body">
						<iframe width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?= "https://maps.google.com/maps?q=" . $setting->lintangBujur . "&amp;output=embed"; ?>">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>