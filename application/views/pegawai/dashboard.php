<section class="section">
	<div class="section-header">

		<h1><?= 'Selamat datang di Sistem Presensi PT Tri Lestari Sandang Industri, ' . $this->dt_pegawai->nama; ?></h1>

	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header justify-content-center bg-primary">
						<h5 class="text-white">Presensi hari ini</h5>
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
									<?php if ($presensiHariIni) : ?>
										<?php if ($presensiHariIni[0]->izin == null) : ?>
											<?php if ($presensiHariIni[0]->presensiMasuk != null) : ?>
												<div class="bg-success p-2 text-white mb-2 float-right">
													<span><i class="fas fa-hand-paper"></i></span>
												</div>
											<?php else : ?>
												<div class="bg-danger p-2 text-white mb-2 float-right">
													<span><i class="fas fa-hand-paper"></i></span>
												</div>
											<?php endif; ?>
										<?php else : ?>
											<div class="bg-info p-2 text-white mb-2 float-right">
												<span><i class="fas fa-info"></i></span>
											</div>
										<?php endif; ?>
									<?php else : ?>
										<div class="bg-danger p-2 text-white mb-2 float-right">
											<span><i class="fas fa-hand-paper"></i></span>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-sm-12">
									<div class="bg-primary p-2 text-white float-left">
										<span>Jam Keluar <?= $setting->jamPulang; ?></span>
									</div>
									<?php if ($presensiHariIni) : ?>
										<?php if ($presensiHariIni[0]->izin == null) : ?>
											<?php if ($presensiHariIni[0]->presensiPulang != null) : ?>
												<div class="bg-success p-2 text-white mb-2 float-right">
													<span><i class="fas fa-hand-paper"></i></span>
												</div>
											<?php else : ?>
												<div class="bg-danger p-2 text-white mb-2 float-right">
													<span><i class="fas fa-hand-paper"></i></span>
												</div>
											<?php endif; ?>
										<?php else : ?>
											<div class="bg-info p-2 text-white mb-2 float-right">
												<span><i class="fas fa-info"></i></span>
											</div>
										<?php endif; ?>
									<?php else : ?>
										<div class="bg-danger p-2 text-white mb-2 float-right">
											<span><i class="fas fa-hand-paper"></i></span>
										</div>
									<?php endif; ?>
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
			<div class="col-md-8">
				<div class="card">
					<div class="card-header justify-content-center bg-primary">
						<h5 class="text-white">Lokasi Kantor</h5>
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