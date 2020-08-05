            
<footer class="footer text-center">
	<?php $r = $this->m_admin->kondisi('rh_setting','id_setting=1')->row();  ?>
	<?php echo $r->nama_perusahaan ?>
	@ <?php echo date('Y') ?>
</footer>
</div>    
</div>        

<script src="assets/back/assets/libs/jquery/dist/jquery.min.js"></script>



<!-- Bootstrap tether Core JavaScript -->
<script src="assets/back/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/back/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/back/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/back/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="assets/back/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="assets/back/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="assets/back/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="assets/back/dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="assets/back/assets/libs/flot/excanvas.js"></script>
<script src="assets/back/assets/libs/flot/jquery.flot.js"></script>
<script src="assets/back/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="assets/back/assets/libs/flot/jquery.flot.time.js"></script>
<script src="assets/back/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="assets/back/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="assets/back/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="assets/back/dist/js/pages/chart/chart-page-init.js"></script>
<!-- <script src="assets/back/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script> -->
<script src="assets/back/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="assets/back/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="assets/back/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/back/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="assets/back/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/back/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="assets/back/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>


<script>

	$('#zero_config').DataTable();
	$(".select2").select2();
	jQuery('#datepicker-autoclose').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true
	});
	jQuery('#datepicker-autoclose2').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true
	});
	jQuery('#datepicker-autoclose3').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true
	});
	jQuery('#datepicker-autoclose4').datepicker({
		autoclose: true,
		format: "h:i:s",
		todayHighlight: true
	});
</script>


</body>

</html>