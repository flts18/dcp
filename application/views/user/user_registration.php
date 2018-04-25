<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="<?php echo base_url(); ?>style/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/css/custom_style.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body style="padding-top:0px">
  <div><img class="img-responsive" style="margin:0 auto" src="<?php echo base_url(); ?>style/images/img_login_headr.jpg"></div><br><br>
		
        <div class="col-sm-6 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">     
       
        <div class="col-md-9">
        
      <div class="login-panel panel panel-default">
				<div class="panel-heading"><svg class="glyph stroked email"></svg>Registration</div>
				<div class="panel-body">
          <?php echo validation_errors('<div style="color:red;">','</div>');?>
             <?php echo form_open('user/signup',"class='form-horizontal'");?>
						<fieldset>
							
  
  <div class="form-group">
    <label for="gpf" class="col-md-3 control-label">GPF Number:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="gpf" name="gpf"  style="text-transform:uppercase" value="<?php echo set_value('gpf'); ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-md-3 control-label">Name:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="name" name="name"  style="text-transform:uppercase" value="<?php echo set_value('name'); ?>" required>
    </div>
  </div>
  
  <div class="form-group">
    <label for="designation" class="col-md-3 control-label">Designation<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select  onchange="desig()" size="3" class="form-control" id="designation" name="designation[]">
      <?php if(isset($designation)) { foreach ($designation as $value) { ?>

    <option value="<?php echo $value['desig_id'] ?>" <?php if($value['desig_id']==set_value('designation')) echo 'selected'; ?>><?php echo $value['desig_name'] ?></option>
     <?php } }?>
     <option value="others">Others</option>
    </select>
  </div>
  </div>
  
  <div class="form-group " style="display:none" id="sub_desig">
    <label for="ref_srl" class="col-md-3 control-label">Add Designation<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="add_desig" name="add_desig"  style="text-transform:uppercase" value="<?php echo set_value('add_desig'); ?>" required>
    </div>
  </div>
  
  <div class="form-group ">
    <label for="department" class="col-md-3 control-label">Section Name<span style="color:red; font-size:20px">*</span>:(Press Ctrl key for multiple selection.)</label>
    <div class="col-md-4 has-success">
    <select class="form-control section_list" multiple="multiple" onchange="add_section()"   size="3" id="section" name="section[]" required>
      <?php if(isset($section_name)) { foreach ($section_name as $value) { ?>
    <option value="<?php echo $value['sec_id'] ?>" <?php if($value['sec_id']==set_value('section')) echo 'selected'; ?>><?php echo $value['sec_name'] ?></option>
     <?php } }?>
     <!-- <option value="others">Others</option> -->
    </select>
  </div>
  </div>

  
  <!-- 
  <div class="form-group " style="display:none" id="sub_sec">
    <label for="add_sec" class="col-md-3 control-label">Add Section<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="add_sec" name="add_sec"  style="text-transform:uppercase" value="<?php echo set_value('add_sec'); ?>" required>
    </div>
  </div> -->
<div class="form-group" id="subsec" style="display:none" class="subsec">
    <label for="department" class="col-md-3 control-label">Sub Section Name<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select class="form-control" onchange="ajaxfilerefno();filtercategory()"  id="subsec_list" name="subsec_list" required>
      
     <!-- <option value="others">Others</option> -->
    </select>
  </div>
  </div>
   
  <div class="form-group">
    <label for="email" class="col-md-3 control-label">Email Id:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
  </div>
  </div>

  <div class="form-group">
    <label for="department" class="col-md-3 control-label">Gender<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select class="form-control"  id="gender" name="gender" required>
     
    <option value="M">Male</option>
    <option value="F">Female</option>
    
    </select>
  </div>
  </div>

  <div class="form-group">
    <label for="phone" class="col-md-3 control-label">Contact No:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
  </div>
  </div>
  
  <div class="form-group">
    <label for="uname" class="col-md-3 control-label">Username:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="uname" name="uname" value="<?php echo set_value('uname'); ?>">
  </div>
  </div>
  
  <div class="form-group">
    <label for="pwd" class="col-md-3 control-label">Password<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="password" class="form-control" id="pwd" name="pwd" required>
    </div>
  </div>
  
 
  
   <div class="form-group">
                 
                       <div class="form-group">
                       <label class="col-md-3 control-label"></label>
<div class="col-md-4">
    <button type="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-primary">Reset</button>  
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
            <a href="<?php echo base_url(); ?>main_controller" style="color:#03C"><u>Login</u></a>    
                  <!--<button type="reset" class="btn btn-primary">Reset</button>   -->
                  
                </div>
  </div>

			</fieldset>

      <input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
					</form>

				</div>
			</div>
		</div>
        </div>
		
  <script src="<?php echo base_url(); ?>style/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url(); ?>style/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>style/js/custom.js"></script>
</body>

</html>
<script type="text/javascript">

$(document).ready(function(){
    $(".section_list").change(function(){
      //alert("okk");
      var base_url=$("#base_url").val();
      
       var section=$("#section").val();
       //alert(section);
     // var section=$("#section").val();
      var url=base_url+"User/fetch_subsec/";
      //alert(url);
       $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',section:section},
           success: function(result){
            //alert(result);
            if(result){
              document.getElementById("subsec").style.display="block";
              document.getElementById("subsec_list").disabled = false;
            }
            else{
              document.getElementById("subsec").style.display="none";
              document.getElementById("subsec_list").disabled = true;
            }
         $("#subsec_list").html(result);
    }});
     
  });
});
</script>