
<style type="text/css">
	@media print {
    #print-area{
         position:absolute;
         width:300px;
         height:300px;
         z-index:15;
         top:50%;
         left:50%;
         margin:-150px 0 0 -150px;
    }
}
</style>
<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<div class="container-fluid text-center" id="print-area">
					<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-blue">
							<div class="widget-user-image">
								<img class="img-responsive" src="<?php echo base_url('assets/img/qrcode/') .  $karyawan['username']  . 'code.png'; ?>" />
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username"><?php echo $karyawan['username']; ?></h3>
							<h5 class="widget-user-desc"><?php echo $karyawan['nama']; ?></h5>

						</div>
					</div>
				</div>
				<button onclick="printDiv('print-area')" class='pull-right'><i class='fa fa-print'></i> Print</button>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->

<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>