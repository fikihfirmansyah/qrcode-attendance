<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<form action="<?= base_url('Jam/editJam/' . $jam['id_jam']) ?>" method="post">
					<input type="hidden" name="id" value="<?= $jam['id_jam'] ?>">
					<div class="form-group row">
						<label for="jabatan_nama" class="col-sm-2 col-form-label">Jam Masuk</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" id="jam_masuk" name="jam_masuk" value="<?= $jam['jam_masuk'] ?>">
							<?= form_error('jam_masuk', '<small class="text-danger ml-3 mt-1">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="jabatan_nama" class="col-sm-2 col-form-label">Jam keluar</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" id="jam_keluar" name="jam_keluar" value="<?= $jam['jam_keluar'] ?>">
							<?= form_error('jam_keluar', '<small class="text-danger ml-3 mt-1">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="jabatan_nama" class="col-sm-2 col-form-label">Toleransi Masuk</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" id="jam_keluar" name="toleransi_masuk" value="<?= $jam['toleransi_masuk'] ?>">
							<?= form_error('toleransi_masuk', '<small class="text-danger ml-3 mt-1">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">

							<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus-circle"></i> Edit Data</button>

						</div>
					</div>
				</form>
				<a href="<?= base_url('data-jam'); ?>">
					<button class="btn btn-danger btn-block"> <i class="far fa-arrow-alt-circle-left"></i> Kembali</button>
				</a>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
