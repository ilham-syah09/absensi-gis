<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row mb-3 text-right">
			<div class="col-xl-12">
				<a href="<?= base_url('pegawai/presensi/') . date('Y', strtotime($presensi->tanggal)) . '/' . date('m', strtotime($presensi->tanggal)); ?>" class="btn btn-primary">Kembali</a>
			</div>
		</div>
		<div class="row">
			<?php if ($presensi->izin == null) : ?>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header bg-secondary">
							<h4>Presensi Masuk</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<?php if ($presensi->presensiMasuk != null) : ?>
									<div class="col-md-12 text-center">
										<img src="<?= base_url('uploads/presensi/') . $presensi->pictureMasuk; ?>" alt="Picture Presensi Masuk" class="img-thumbnail" width="400">
									</div>
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered" width="100%" cellspacing="0">
												<thead>
													<tr>
														<td>Jadwal Masuk</td>
														<td>:</td>
														<td><?= $setting->jamMasuk; ?></td>
													</tr>
													<tr>
														<td>Presensi Masuk</td>
														<td>:</td>
														<td><?= $presensi->presensiMasuk; ?></td>
													</tr>
													<?php if ($presensi->presensiMasuk > $setting->jamMasuk) : ?>
														<tr>
															<td>Status</td>
															<td>:</td>
															<td>
																<span class="badge badge-danger text-dark"><?= masuk($presensi->presensiMasuk, $setting->jamMasuk); ?></span>
															</td>
														</tr>
													<?php else : ?>
														<tr>
															<td>Status</td>
															<td>:</td>
															<td>
																<span class="badge badge-success text-dark">Tepat Waktu</span>
															</td>
														</tr>
													<?php endif; ?>
												</thead>
											</table>
										</div>
									</div>
								<?php else : ?>
									<div class="col-md-12 bg-danger p-3 text-center">
										<span class="h4 text-dark">Belum Presensi</span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header bg-secondary">
							<h4>Presensi Pulang</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<?php if ($presensi->presensiPulang != null) : ?>
									<div class="col-md-12 text-center">
										<img src="<?= base_url('uploads/presensi/') . $presensi->picturePulang; ?>" alt="Picture Presensi Pulang" class="img-thumbnail" width="400">
									</div>
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered" width="100%" cellspacing="0">
												<thead>
													<tr>
														<td>Jadwal Masuk</td>
														<td>:</td>
														<td><?= $setting->jamPulang; ?></td>
													</tr>
													<tr>
														<td>Presensi Masuk</td>
														<td>:</td>
														<td><?= $presensi->presensiPulang; ?></td>
													</tr>
													<?php if ($presensi->presensiPulang < $setting->jamPulang) : ?>
														<tr>
															<td>Status</td>
															<td>:</td>
															<td>
																<span class="badge badge-danger text-dark">Sebelum Waktunya</span>
															</td>
														</tr>
													<?php else : ?>
														<tr>
															<td>Status</td>
															<td>:</td>
															<td>
																<span class="badge badge-success text-dark">Tepat Waktu</span>
															</td>
														</tr>
													<?php endif; ?>
												</thead>
											</table>
										</div>
									</div>
								<?php else : ?>
									<div class="col-md-12 bg-danger p-3 text-center">
										<span class="h4 text-dark">Belum Presensi</span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header bg-primary text-white">
							<h4>Detail Izin</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 bg-secondary text-center">
									<img src="<?= base_url('assets/img/file.png'); ?>" alt="Picture Presensi Masuk" class="img-circle" width="150">
									<h5>File Bukti Izin</h5>
									<a href="<?= base_url('uploads/izin/') . $presensi->document; ?>" class="btn btn-primary mb-3" target="_blank">Download</a>
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered" width="100%" cellspacing="0">
											<thead>
												<tr>
													<td>Waktu Izin</td>
													<td>:</td>
													<td><?= $presensi->izin; ?></td>
												</tr>
												<tr>
													<td>Alasan Izin</td>
													<td>:</td>
													<td><?= $presensi->alasanIzin; ?></td>
												</tr>
												<tr>
													<td>Status</td>
													<td>:</td>
													<td>
														<?php if ($presensi->statusIzin == 'Menunggu') : ?>
															<span class="badge badge-warning text-dark"><?= $presensi->statusIzin; ?></span>
														<?php elseif ($presensi->statusIzin == 'Ditolak') : ?>
															<span class="badge badge-danger text-dark"><?= $presensi->statusIzin; ?></span>
														<?php elseif ($presensi->statusIzin == 'Disetujui') : ?>
															<span class="badge badge-success text-dark"><?= $presensi->statusIzin; ?></span>
														<?php endif; ?>
													</td>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>