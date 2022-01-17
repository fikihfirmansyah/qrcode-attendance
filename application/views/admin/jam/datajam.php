 <div class="row">
 	<div class="col-12">
 		<div class="card m-b-30">
 			<div class="card-body">
 				<table id="datatable-buttons" data-order='' class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
 					<thead>
 						<tr>
 							<th>Id</th>
 							<th>Jam Masuk</th>
 							<th>Jam Keluar</th>
                            <th>Toleransi masuk</th>
 							<th>Opsi</th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php foreach ($data as $jam) { ?>
 							<tr>
 								<td><?= $jam['id_jam'] ?></td>
 								<td><?= $jam['jam_masuk'] ?></td>
                                <td><?= $jam['jam_keluar'] ?></td>
                                <td><?= $jam['toleransi_masuk'] ?></td>
 								<td>
 									<a  href="<?= base_url('jam/editJam/' .  $jam['id_jam']) ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
 								</td>
 							</tr>

 						<?php } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div> <!-- end col -->
 </div> <!-- end row -->
