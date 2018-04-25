<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="<?php echo base_url(); ?>style/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body style="padding-top:0px;background:#ffffff">
  <div><img class="img-responsive" style="margin:0 auto" src="<?php echo base_url(); ?>style/images/img_login_headr.jpg"></div><br><br>
  
  <form role="form" action="<?php echo site_url('user/ckh_mailid'); ?>" method="post";>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div style="background:#ddd">
				<div class="panel-heading" style="border-bottom:1px solid #fff;"><svg class="glyph stroked email"></svg>Forget Password</div>
                
				<div class="panel-body" style="padding-left:50px">
         
		 		<fieldset>
							
  
  <div class="form-group">
    <label for="username" class="col-md-3 control-label">Email id:</label>
    <div class="col-md-8 has-success">
    <input type="text" class="form-control" id="email" name="email">
  </div>
  </div>
  
  
<div class="form-group">
      <br><center><span style="color:red"><?php echo $this->session->flashdata('err_message'); ?></span></center>
  </div>
  <div class="form-group">
      <center><span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span></center>
  </div>
  <div class="form-group">
<div style="padding-left:80px">
    <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-primary">Reset</button>  
      &nbsp;&nbsp;&nbsp;&nbsp;
  


  <a href="<?php echo base_url(); ?>user/login" style="color:#03C"><u>Log in</u></a><br>
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
  
  </div></div>
			</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
		
  <script src="<?php echo base_url(); ?>style/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url(); ?>style/js/bootstrap.min.js"></script>
</body>

</html>

