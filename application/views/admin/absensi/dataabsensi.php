 <div class="row">
 	<div class="col-12">
 		<div class="card m-b-30">
 			<div class="card-body">
 				<table id="datatable-buttons" data-order='' class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
 					<thead>
 						<tr>
 							<th>Id</th>
 							<th>Nama</th>
 							<th>Jabatan</th>
 							<th>Tanggal</th>
 							<th>Jam Masuk</th>
 							<th>Jam Keluar</th>
 							<th>Status</th>
 							<th>Opsi</th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php foreach ($data as $absensi) { ?>
 							<tr>
 								<td><?= $absensi['id_absen'] ?></td>
 								<td><?= $absensi['nama'] ?></td>
 								<td><?= $absensi['jabatan_nama'] ?></td>
 								<td><?= $absensi['tanggal'] ?></td>
 								<td><?= $absensi['jam_masuk'] ?></td>
 								<td><?= $absensi['jam_keluar'] ?></td>
 								<td><?= $absensi['status'] ?></td>
 								<td>
 									<a onclick="return confirm('Apakah anda yakin ingin menghapus data absensi ini?')" href="<?= base_url('absen/deleteAbsensi/' .  $absensi['id_absen']) ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
 								</td>
 							</tr>

 						<?php } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div> <!-- end col -->
 </div> <!-- end row -->
