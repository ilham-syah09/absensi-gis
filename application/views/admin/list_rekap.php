<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row mb-3 text-right">
			<div class="col-xl-12">
				<a href="<?= base_url('admin/rekap/') . $th . '/' . $bln; ?>" class="btn btn-primary">Kembali</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4><?= $pegawai->nama . ' | ' . date('M Y', strtotime($th . '-' . $bln)); ?></h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="examples">
								<thead class="bg-info">
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Presensi Masuk</th>
										<th>Presensi Pulang</th>
										<th>Izin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($rekap as $i => $rkp) : ?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td><?= date('d M Y', strtotime($rkp->tanggal)); ?></td>
											<td class="text-dark">
												<?php if ($rkp->presensiMasuk == null) : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php else : ?>
													<?php if ($rkp->presensiMasuk > $setting->jamMasuk) : ?>
														<span class="badge badge-danger text-dark"><?= $rkp->presensiMasuk . ' - ' . masuk($rkp->presensiMasuk, $setting->jamMasuk); ?></span>
													<?php else : ?>
														<span class="badge badge-success text-dark"><?= $rkp->presensiMasuk; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($rkp->presensiPulang == null) : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php else : ?>
													<?php if ($rkp->presensiPulang < $setting->jamPulang) : ?>
														<span class="badge badge-danger text-dark"><?= $rkp->presensiPulang; ?></span>
													<?php else : ?>
														<span class="badge badge-success text-dark"><?= $rkp->presensiPulang; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($rkp->izin == null) : ?>
													<span class="badge badge-info text-dark">Tidak Izin</span>
												<?php else : ?>
													<?php if ($rkp->statusIzin == 'Menunggu') : ?>
														<span class="badge badge-warning text-dark"><?= $rkp->statusIzin; ?></span>
													<?php elseif ($rkp->statusIzin == 'Ditolak') : ?>
														<span class="badge badge-danger text-dark"><?= $rkp->statusIzin; ?></span>
													<?php elseif ($rkp->statusIzin == 'Disetujui') : ?>
														<span class="badge badge-success text-dark"><?= $rkp->statusIzin; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<a href="<?= base_url('admin/rekap/detail/') . $rkp->id; ?>" class="badge badge-dark text-white" data-toggle="tooltip" data-title="Detail">Detail</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>