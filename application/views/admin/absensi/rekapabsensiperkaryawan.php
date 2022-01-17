<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<div class="table-responsive">

					<form method="post" class="col-sm-12 mb-2" action="<?= base_url('rekap-absensi-karyawan-filter') ?>">
						<input type="date" name="awal" id="awal">
						<input type="date" name="akhir" id="akhir">
						<input type="text" name="username" value="<?= $this->uri->segment(3) ?>" hidden>
						<input type="text" name="nama" value="<?= $nama ?>" hidden>

						<button class="btn btn-primary" type="submit" formtarget="_blank"> Filter </button>

					</form>
					<table id="datatable-buttons" data-order='' class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Username</th>
								<th>Tanggal</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Status</th>

							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $a) { ?>
								<tr>
									<td><?= $a['id_absen'] ?></td>
									<td><?= $a['username'] ?></td>
									<td><?= $a['tanggal'] ?></td>
									<td><?= $a['jam_masuk'] ?></td>
									<td><?= $a['jam_keluar'] ?></td>
									<td><?= $a['status'] ?></td>

								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div> <!-- end col -->
</div> <!-- end row -->
