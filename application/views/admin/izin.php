<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-sm-4 col-xl-4">
				<div class="form-group">
					<label for="by_tahun">Tahun</label>
					<select class="js-select2 form-control" name="by_tahun" id="by_tahun">
						<option value="">-- Pilih Tahun --</option>
						<?php foreach ($tahun as $th) : ?>
							<option value="<?= $th->tahun; ?>" <?= ($th->tahun == $th_ini) ? 'selected' : ''; ?>>
								<?= $th->tahun; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-sm-4 col-xl-4">
				<div class="form-group">
					<label for="by_tahun">Bulan</label>
					<select class="js-select2 form-control" name="by_bulan" id="by_bulan">
						<option value="">-- Pilih Bulan --</option>
						<?php foreach (range(1, 12) as $bulan) : ?>
							<option value="<?= $bulan; ?>" <?= ($bulan == $bln_ini) ? 'selected' : ''; ?>>
								<?= bulan($bulan); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4>Rekap Izin</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="example">
								<thead class="bg-info">
									<tr>
										<th>#</th>
										<th>Nama Pegawai</th>
										<th>Jumlah Izin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($rekapIzin as $izin) : ?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $izin->nama; ?></td>
											<td><?= $izin->jumlahIzin; ?></td>
											<td>
												<a href="<?= base_url('admin/izin/list/') . $th_ini . '/' . $bln_ini . '/' . $izin->idPegawai; ?>" class="badge badge-warning text-dark" data-toggle="tooltip" data-title="Detail">Detail</a>
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

<script>
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/izin/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/izin/') ?>${tahun}/${bulan}`;
	});
</script>