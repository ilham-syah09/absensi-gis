<section class="section">
	<div class="section-header">
		<h1><?= $title; ?></h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addLembur">Add Lembur</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="example">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Jam</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($lembur as $lmb) : ?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
											<td><?= $lmb->nama; ?></td>
											<td><?= $lmb->tanggal; ?></td>
											<td><?= $lmb->jam . ' Jam'; ?></td>
											<td>
												<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editLembur" data-id="<?= $lmb->id; ?>" data-tanggal="<?= $lmb->tanggal; ?>" data-jam="<?= $lmb->jam; ?>">Edit</a>
												<a href="<?= base_url('admin/lembur/delete/' . $lmb->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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

<!-- modal add -->
<div class="modal fade" id="addLembur" tabindex="-1" role="dialog" aria-labelledby="addLembur" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Lembur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/lembur/add'); ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Pegawai</label>
								<select name="idPegawai" class="form-control">
									<option value="">-- Pilih Pegawai --</option>
									<?php foreach ($pegawai as $peg) : ?>
										<option value="<?= $peg->id; ?>"><?= $peg->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
								<input type="date" class="form-control" name="tanggal">
							</div>
							<div class="form-group">
								<label>Jam</label>
								<input type="number" class="form-control" name="jam">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editLembur" tabindex="-1" role="dialog" aria-labelledby="editLembur" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Lembur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/lembur/edit'); ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Tanggal</label>
								<input type="hidden" name="id" id="id_lembur">
								<input type="date" class="form-control" name="tanggal" id="tanggal">
							</div>
							<div class="form-group">
								<label>Jam</label>
								<input type="number" class="form-control" name="jam" id="jam">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let tanggal = $(this).data('tanggal');
			let jam = $(this).data('jam');

			$('#id_lembur').val(id);
			$('#tanggal').val(tanggal);
			$('#jam').val(jam);
		});
	});
</script>