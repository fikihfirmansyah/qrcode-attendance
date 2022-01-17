<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $jabatan) { ?>
							<tr>
								<td><?= $jabatan['jabatan_id'] ?></td>
								<td><?= $jabatan['jabatan_nama'] ?></td>
								<td><a href="<?php echo site_url('Absen/detailRekapAbsensi/' . $jabatan['jabatan_id']); ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a></td>
							</tr>

						<?php } ?>
					</tbody>

				</table>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
