<style>
	#my_camera {
		width: 100%;
		height: 240px;
		border: 1px solid black;
	}
</style>

<?php
$lintangBujur = explode(', ', $setting->lintangBujur);
?>

<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Presensi hari ini</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead class="bg-info">
									<tr>
										<th>Presensi Masuk</th>
										<th>Presensi Pulang</th>
										<th>Izin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (in_array(date('N'), explode(',', $setting->hariKerja))) : ?>
										<tr>
											<td>
												<?php if ($presensiHariIni) : ?>
													<?php if ($presensiHariIni[0]->presensiMasuk == null) : ?>
														<span class="badge badge-warning text-dark">Belum Presensi</span>
													<?php else : ?>
														<?php if ($presensiHariIni[0]->presensiMasuk > $setting->jamMasuk) : ?>
															<span class="badge badge-danger text-dark"><?= $presensiHariIni[0]->presensiMasuk; ?></span>
														<?php else : ?>
															<span class="badge badge-success text-dark"><?= $presensiHariIni[0]->presensiMasuk; ?></span>
														<?php endif; ?>
													<?php endif; ?>
												<?php else : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($presensiHariIni) : ?>
													<?php if ($presensiHariIni[0]->presensiPulang == null) : ?>
														<span class="badge badge-warning text-dark">Belum Presensi</span>
													<?php else : ?>
														<?php if ($presensiHariIni[0]->presensiPulang < $setting->jamPulang) : ?>
															<span class="badge badge-danger text-dark"><?= $presensiHariIni[0]->presensiPulang; ?></span>
														<?php else : ?>
															<span class="badge badge-success text-dark"><?= $presensiHariIni[0]->presensiPulang; ?></span>
														<?php endif; ?>
													<?php endif; ?>
												<?php else : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($presensiHariIni) : ?>
													<?php if ($presensiHariIni[0]->izin == null) : ?>
														<span class="badge badge-info text-dark">Tidak Izin</span>
													<?php elseif ($presensiHariIni[0]->statusIzin == 'Menunggu') : ?>
														<span class="badge badge-warning text-dark"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php elseif ($presensiHariIni[0]->statusIzin == 'Ditolak') : ?>
														<span class="badge badge-danger text-dark"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php elseif ($presensiHariIni[0]->statusIzin == 'Disetujui') : ?>
														<span class="badge badge-success text-dark"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php endif; ?>
												<?php else : ?>
													<span class="badge badge-info text-dark">Tidak Izin</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if (!$presensiHariIni) : ?>
													<a href="#" class="badge badge-info text-dark" data-toggle="modal" data-target="#modalPresensi" data-title="Presensi" id="btn-presensi" data-typepresensi="Masuk">Presensi</a>
													<a href="#" class="badge badge-success text-dark" data-toggle="modal" data-target="#modalIzin" data-title="Izin">Izin</a>
												<?php else : ?>
													<?php if ($presensiHariIni[0]->izin == null) : ?>
														<?php if ($presensiHariIni[0]->presensiPulang == null) : ?>
															<a href="#" class="badge badge-info text-dark" data-toggle="modal" data-target="#modalPresensi" data-title="Presensi" id="btn-presensi" data-typepresensi="Pulang">Presensi</a>
															<a href="#" class="badge badge-success text-dark" data-toggle="modal" data-target="#modalIzin" data-title="Izin">Izin</a>
														<?php endif; ?>
													<?php endif; ?>
												<?php endif; ?>
											</td>
										</tr>
									<?php else : ?>
										<tr>
											<td colspan="4" class="text-center bg-danger text-white">Hari libur</td>
										</tr>
									<?php endif; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
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
						<h4>Riwayat Presensi</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="example">
								<thead class="bg-info">
									<tr>
										<th>#</th>
										<th>Tanggal</th>
										<th>Presensi Masuk</th>
										<th>Presensi Pulang</th>
										<th>Izin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($presensi as $pres) : ?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= date('d M Y', strtotime($pres->tanggal)); ?></td>
											<td class="text-dark">
												<?php if ($pres->presensiMasuk == null) : ?>
													<span class="badge badge-warning text-dark">Belum Presensi</span>
												<?php else : ?>
													<?php if ($pres->presensiMasuk > $setting->jamMasuk) : ?>
														<span class="badge badge-danger text-dark"><?= $pres->presensiMasuk; ?></span>
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
												<a href="<?= base_url('pegawai/presensi/detail/') . $pres->id; ?>" class="badge badge-warning text-dark" data-toggle="tooltip" data-title="Detail">Detail</a>
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

<!-- modal presensi -->
<div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="modalPresensi" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="headerPresensi"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header bg-secondary">
								<h5>Live Kamera</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<input type="hidden" name="typePresensi" id="typePresensi">
									<div class="col-sm-12 text-center mb-3">
										<div id="my_camera"></div>
									</div>
									<div class="col-sm-12 text-center text-dark">
										<button type="button" class="btn btn-info text-dark" onClick="openCamera()">Buka Kamera</button>
										<button type="button" class="btn btn-warning text-dark" onClick="ambilGambar()">Ambil Gambar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header bg-secondary">
								<h5>Hasil</h5>
							</div>
							<div class="card-body">
								<div class="col-sm-12 text-center mb-3">
									<div id="hasilGambar"></div>
								</div>
								<div class="col-sm-12  mb-3">
									<input type="hidden" name="jarak" id="jrk">
									<div class="table-responsive">
										<table class="table">
											<tr>
												<td>Jarak</td>
												<td>:</td>
												<td id="jarak"></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="col-sm-12 text-center">
									<button type="button" class="btn btn-success text-dark" onClick="kirimPresensi()">Kirim Presensi</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- modal izin -->
<div class="modal fade" id="modalIzin" tabindex="-1" role="dialog" aria-labelledby="modalIzin" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Permohonan Izin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pegawai/presensi/izin'); ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="alasan">Alasan</label>
								<textarea name="alasan" cols="30" rows="20" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="document">Document Pendukung</label>
								<input type="file" name="document" class="form-control" accept=".jpeg, .jpg, .png, .pdf">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/webcam/webcam.min.js'); ?>"></script>

<script>
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('pegawai/presensi/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('pegawai/presensi/') ?>${tahun}/${bulan}`;
	});

	let lat1 = '<?= $lintangBujur[0]; ?>';
	let long2 = '<?= $lintangBujur[1]; ?>';
	let jarakKantor = <?= $setting->jarak; ?>

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.watchPosition(showPosition);
		} else {
			$('#jarak').text("Geolocation is not supported by this browser.");
		}
	}

	function showPosition(position) {
		let lat2 = position.coords.latitude;
		let long2 = position.coords.longitude;

		let jarak = getDistanceFromLatLonInKm(lat1, long2, lat2, long2).toFixed(1);

		$('#jrk').val(jarak);
		$('#jarak').text(`${jarak} meter dari kantor`);

		console.log(getDistanceFromLatLonInKm(lat1, long2, lat2, long2).toFixed(1));
	}

	function getDistanceFromLatLonInKm(latitude1, longitude1, latitude2, longitude2, units) {
		var R = 6371; // km
		var dLat = toRad(latitude2 - latitude1);
		var dLon = toRad(longitude2 - longitude1);
		var latitude1 = toRad(latitude1);
		var latitude2 = toRad(latitude2);

		var a =
			Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.sin(dLon / 2) *
			Math.sin(dLon / 2) *
			Math.cos(latitude1) *
			Math.cos(latitude2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		var d = R * c;

		return d * 1000;
	}

	// Converts numeric degrees to radians
	function toRad(Value) {
		return (Value * Math.PI) / 180;
	}

	$('#btn-presensi').click(function() {
		let typePresensi = $(this).data('typepresensi');

		$('#typePresensi').val(typePresensi);

		if (typePresensi === 'Masuk') {
			$('#headerPresensi').text('Presensi Masuk');
		} else {
			$('#headerPresensi').text('Presensi Pulang');
		}

		getLocation();
	});

	// Konfigurasi dan pengaturan kamera
	function openCamera() {
		Webcam.set({
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach('#my_camera');
	}

	function ambilGambar() {
		//  snapshot dan mendapatkan data gambar
		Webcam.snap(function(data_uri) {
			// display results in page
			document.getElementById('hasilGambar').innerHTML =
				'<img id="imageprev" class="img-thumbnail" src="' + data_uri + '"/>';
		});

		Webcam.reset();
	}

	function kirimPresensi() {
		// Get base64 value from <img id='imageprev'> source
		var base64image = document.getElementById("imageprev").src;

		let typePresensi = $('#typePresensi').val();

		var url = '';

		if (typePresensi === 'Masuk') {
			url = '<?= base_url('pegawai/presensi/masuk'); ?>';
		} else {
			url = '<?= base_url('pegawai/presensi/pulang'); ?>'
		}

		let jarak = $('#jrk').val();

		if (jarak > jarakKantor) {
			iziToast.warning({
				title: 'Warning',
				message: `Jarak dari lokasi Anda ke Kantor tidak boleh lebih dari ${jarakKantor} meter`,
				position: 'topRight'
			});

			return 0;
		}

		Webcam.upload(base64image, url, function(code, result) {
			let data = JSON.parse(result);

			if (data.status === 'success') {
				iziToast.success({
					title: 'Sukses',
					message: data.msg,
					position: 'topRight'
				});
			} else {
				iziToast.error({
					title: 'Gagal',
					message: data.msg,
					position: 'topRight'
				});
			}
			setTimeout(function() {
				document.location.href = `<?= base_url('pegawai/presensi'); ?>`;
			}, 6000);
		});
	}
</script>