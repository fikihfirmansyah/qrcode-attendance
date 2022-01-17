
<div class="row">

	<div class="col-sm-12 col-xl-12">
		<!-- Map card -->
		<div class="card">
			<div class="card-header"> Notifikasi </h3>
			</div>
			<form method="post" action="<?= base_url('user/proses_absen'); ?>">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-sm-10">
						<h4> Hai  <?=$this->session->userdata('nama') . ', ' . $waktu ?></h4>
						</div>
					</div>
					
					
					
					
				</div>

			</form>
		</div>
		</section>
	</div>
</div>
