<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>NIP</th>
							<th>Nama Lengkap</th>
							<th>Username</th>
							<th>Tanggal</th>
							<th>Jam Masuk</th>
							<th>Jam Keluar</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $k) { ?>
							<tr>
								<td><?= $k['nip'] ?></td>
								<td><?= $k['nama'] ?></td>
								<td><?= $k['username'] ?></td>
								<td><?= $k['tanggal'] ?></td>
								<td><?= $k['jam_masuk'] ?></td>
								<td><?= $k['jam_keluar'] ?></td>
								<td><a href="<?php echo site_url('Absen/rekapAbsensiPerKaryawan/' . $k['username']); ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a></td>
							</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
