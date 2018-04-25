<!DOCTYPE html>
<html>
<head>
  
<meta http-equiv="pragma" content="no-cache" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url(); ?>style/images/logo.png" type="image/gif" >
<title>PTS</title>

<link href="<?php echo base_url(); ?>style/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/custom_style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/datatable/responsive.dataTables.min.css">

<link href="<?php echo base_url(); ?>style/css/main.css" rel="stylesheet">

<input type="hidden" value="<?php echo base_url(); ?>" id="site_url">
<script src="<?php echo base_url(); ?>style/js/jquery-1.11.1.min.js"></script>



</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top"  role="navigation">
    <div class="container-fluid">
      <div class="navbar-header" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span><?php  if($this->session->userdata('file_letter')=="letter"){ echo "Paper" ;}?></span> Tracking System</a>
       
		<ul class="user-menu">
          <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked"><use xlink:href="#stroked"></use></svg> <i class="glyphicon glyphicon-user" ></i>&nbsp;  <?php echo $this->session->userdata('fullname');?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo base_url().'user/profile';?>"><svg class="glyph stroked"><use xlink:href="#stroked"></use></svg> <i class="glyphicon glyphicon-user" ></i>&nbsp; Profile</a></li>
              <li><a href="<?php echo base_url().'user/setting';?>"><svg class="glyph stroked"><use xlink:href="#stroked"></use></svg> <i class="glyphicon glyphicon-cog" ></i> &nbsp;Setting </a></li>
              <li><a href="<?php echo base_url().'user/logout';?>"><svg class="glyph stroked cancel"><use xlink:href=""></use></svg> <i class="glyphicon glyphicon-off" ></i>&nbsp;Logout</a></li>
            </ul>
          </li>
        </ul>

<?php if($this->session->userdata('file_letter')=="letter") {?>
<input type="hidden" name ="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ;?>" >
         <p class="user-menu" id="nc">
          
        </p>
        <?php } ?>
      <?php if($this->session->userdata('totalIns') > 0) { ?>
		<a class="instruction_button" href="javascript:void(0);" onclick="instructionClick();">Remark on instruction(s)</a>
		<?php } ?>
      </div>
              
    </div><!-- /.container-fluid -->
  </nav>
<?php if($this->session->userdata('totalIns') > 0) { ?>
    <style>

    .instruction_button {
      background-color: #004A7F;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      border: none;
      color: #FFFFFF;
      cursor: pointer;
      display: inline-block;
      font-family: Arial;
      //font-size: 20px;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none !important;
      margin-top: 10px;
    }
    @-webkit-keyframes glowing {
      0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
    }
    
    @-moz-keyframes glowing {
      0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
    }
    
    @-o-keyframes glowing {
      0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
    }
    
    @keyframes glowing {
      0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
    }
    
    .instruction_button {
      -webkit-animation: glowing 1500ms infinite;
      -moz-animation: glowing 1500ms infinite;
      -o-animation: glowing 1500ms infinite;
      animation: glowing 1500ms infinite;
    }
    
    </style>
	<script type="text/javascript">
		function instructionClick()
		{
			$('#remarkIns').html('<img  class="col-md-offset-3" src="<?php echo base_url(); ?>style/images/loading_img.gif" />');
			$('#remarkInstructionModal').modal('show'); 
			$.ajax({url:'<?php echo base_url(); ?>home_controller/getRemarksIns', 
			   type:'post',
			   data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
				success: function(result){
					var data = JSON.parse(result);
					$("#remarkIns").html(data);
				}
			});
		}
	</script>
	<!-- Modal -->
	<div class="modal fade" id="remarkInstructionModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="border-color: #ffb53e;">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">New Instruction Remark(s)</h4>
				</div>
				<div class="modal-body" id="remarkIns">
					
				</div>
			</div>
		</div>
	</div>
<?php } ?>