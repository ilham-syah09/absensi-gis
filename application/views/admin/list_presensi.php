<meta http-equiv="refresh" content="30">

<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row mb-3 text-right">
			<div class="col-xl-12">
				<a href="<?= base_url('admin/presensi/') . date('Y', strtotime($tanggal)) . '/' . date('m', strtotime($tanggal)); ?>" class="btn btn-primary">Kembali</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4><?= date('d M Y', strtotime($tanggal)); ?></h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="example">
								<thead class="bg-info">
									<tr>
										<th>Nama Pegawai</th>
										<th>Presensi Masuk</th>
										<th>Presensi Pulang</th>
										<th>Izin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($presensi as $pres) : ?>
										<tr>
											<td><?= $pres->nama; ?></td>
											<td class="text-dark">
												<?php if ($pres->presensiMasuk == null) : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php else : ?>
													<?php if ($pres->presensiMasuk > $setting->jamMasuk) : ?>
														<span class="badge badge-danger text-dark"><?= $pres->presensiMasuk . ' - ' . masuk($pres->presensiMasuk, $setting->jamMasuk); ?></span>
													<?php else : ?>
														<span class="badge badge-success text-dark"><?= $pres->presensiMasuk; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($pres->presensiPulang == null) : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php else : ?>
													<?php if ($pres->presensiPulang < $setting->jamPulang) : ?>
														<span class="badge badge-danger text-dark"><?= $pres->presensiPulang; ?></span>
													<?php else : ?>
														<span class="badge badge-success text-dark"><?= $pres->presensiPulang; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($pres->izin == null) : ?>
													<span class="badge badge-info text-dark">Tidak Izin</span>
												<?php else : ?>
													<?php if ($pres->statusIzin == 'Menunggu') : ?>
														<span class="badge badge-warning text-dark"><?= $pres->statusIzin; ?></span>
													<?php elseif ($pres->statusIzin == 'Ditolak') : ?>
														<span class="badge badge-danger text-dark"><?= $pres->statusIzin; ?></span>
													<?php elseif ($pres->statusIzin == 'Disetujui') : ?>
														<span class="badge badge-success text-dark"><?= $pres->statusIzin; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td>
												<a href="<?= base_url('admin/presensi/detail/') . $pres->id; ?>" class="badge badge-warning text-dark" data-toggle="tooltip" data-title="Detail">Detail</a>
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