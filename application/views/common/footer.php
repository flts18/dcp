<script src="<?php echo base_url(); ?>style/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>style/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>style/js/custom.js"></script>


<script src="<?php echo base_url(); ?>style/js/bootstrap-table.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>style/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>style/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>style/js/jquery.scrollUp.min.js"></script>

<script src="<?php echo base_url(); ?>style/js/main.js"></script>


<script>
	$(window).unload(function(){
		$.ajax({
			url:'<?php echo base_url()."user/forceLogoutOnbrowserClose/" ?>', 
			type:'post',
			async:false,
			data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>','force_logout': true},
			success: function(result){

			}
		});
	});
	
	$(document).ready(function(){
		
		$.ajax({
			url:'<?php echo base_url()."user/checkCurrentUserExists/" ?>', 
			type:'post',
			data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>','checkExists': true},
			success: function(result){

			}
		});
	});
	
  </script>


</body>

</html>

