<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row mb-3 text-right">
			<div class="col-xl-12">
				<a href="<?= base_url('admin/izin/') . $th . '/' . $bln; ?>" class="btn btn-primary">Kembali</a>
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
							<table class="table table-bordered table-hover" id="example">
								<thead class="bg-info">
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Alasan Izin</th>
										<th>Document</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($izin as $i => $izin) : ?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td><?= $izin->tanggal; ?></td>
											<td><?= $izin->alasanIzin; ?></td>
											<td>
												<a href="<?= base_url('uploads/izin/' . $izin->document); ?>" class="btn btn-info" target="_blank">Lihat Dokumen</a>
											</td>
											<td>
												<?php if ($izin->statusIzin == 'Menunggu') : ?>
													<span class="badge badge-warning text-dark"><?= $izin->statusIzin; ?></span>
												<?php elseif ($izin->statusIzin == 'Ditolak') : ?>
													<span class="badge badge-danger text-dark"><?= $izin->statusIzin; ?></span>
												<?php elseif ($izin->statusIzin == 'Disetujui') : ?>
													<span class="badge badge-success text-dark"><?= $izin->statusIzin; ?></span>
												<?php endif; ?>
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