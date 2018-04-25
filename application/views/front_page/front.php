<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link href="<?php echo base_url(); ?>style/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/custom_style.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>style/js/jquery-1.11.1.min.js"></script>

<!--Icons-->


<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span>File / Letter</span> Tracking System</a>
        <ul class="user-menu">
          <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><i class="glyphicon glyphicon-user" ></i>&nbsp;   <?php echo $this->session->userdata('fullname');?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              
             
              <li><a href="<?php echo base_url().'user/logout';?>"><svg class="glyph stroked cancel"><use xlink:href=""></use></svg> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
              
    </div><!-- /.container-fluid -->
  </nav>
<div class="col-sm-12  col-lg-12  main">    
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><center><font size="+3">Welcome to Letter and File Tracking System</font></center></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							

 


						<div class="container-fluid bg-3 text-center">
						  <h3></h3>
						  <img src="<?php echo base_url(); ?>/style/images/cid-logo.jpg" class="" alt="CID LOGO" wth="200" height="200"><br>

						 <a href="<?php echo base_url().'home_controller/lettertraking'; ?>"> <img src="<?php echo base_url(); ?>/style/images/letter_img.jpg" class="" alt="Bird" width="250" height="250"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 <a href="<?php echo base_url().'home_controller/filetraking'; ?>"> <img src="<?php echo base_url(); ?>/style/images/file_img.jpg" class="" alt="Bird" width="250" height="250"></a>
						  <h3></h3>
						</div>


						<div class="container-fluid bg-3 text-center text-justify">
						  <h3></h3><br>
						  <br>
						</div>

						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
</div>		
		<script src="<?php echo base_url(); ?>style/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>style/js/custom.js"></script>
</body>

</html>
