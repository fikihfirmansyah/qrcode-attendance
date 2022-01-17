<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>username</th>
							<!-- <th>Image</th> -->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($karyawan as $k) { ?>
							<tr>
								<td><?= $k['nip'] ?></td>
								<td><?= $k['nama'] ?></td>
								<td><?= $k['username'] ?></td>
								<!-- <td><img src="<?= base_url('assets/images/') . $k['image']; ?>" class="img-fluid img-thumbnail" width="200" height="40" alt="..."></td> -->
								<td><a href="<?php echo site_url('Absen/cetakqr/' . $k['nip']); ?>" class="btn btn-primary"><i class="fas fa-edit"></i>Cetak QR</a>
							</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
