<script>
function change_pwd()
{
	var pwdobj=document.getElementById("npwd").value;
	var cpwdobj=document.getElementById("cpwd").value;
	if(pwdobj!=cpwdobj)
	{
		alert("New and Confirm Password Missmatched");
		return false;
		}
		return true;
}
</script>

<body>
		<div class="col-lg-12">
          <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Setting</div>
          <div class="panel-body">
            <div class="col-md-12">
              
                
          <?php echo validation_errors('<div style="color:red;">','</div>');?>
          <div class="form-group has-success">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
                    <div class="form-group has-success">
                   <span style="color:red"><?php echo $this->session->flashdata('error_message'); ?></span>
                    </div>
             <?php echo form_open('user/setting',"class='form-horizontal'");?>
						<fieldset>
							
  
  
  
  <div class="form-group">
    <label for="opwd" class="col-md-4 control-label">Old Password<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="password" class="form-control" id="opwd" name="opwd" required>
  </div></div>
  
  <div class="form-group">
    <label for="npwd" class="col-md-4 control-label">New Password<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="password" class="form-control" id="npwd" name="npwd" required>
  </div></div>
  
  <div class="form-group">
    <label for="cpwd" class="col-md-4 control-label">Confirm Password<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="password" class="form-control" id="cpwd" name="cpwd" onBlur="change_pwd()" required>
  </div></div>
  
 
  <div class="form-group">
                 
                       <div class="form-group">
                       <label class="col-md-3 control-label"></label>
<div class="col-md-4">
  <button type="submit" class="btn btn-primary">Change</button>
  <button type="reset" class="btn btn-primary">Reset</button>

			</fieldset>
					
				</div></div></div></div>
			</div>
		</div>
		
  
</body>


