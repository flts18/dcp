 <div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>User Profile</div>
          <div class="panel-body">
            <div class="col-md-12">
              
                
          <?php echo validation_errors('<div style="color:red;">','</div>');?>
          <div class="form-group has-success">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
          <?php echo form_open('user/profile_update',"class='form-horizontal'");?>  
          
             
						<fieldset>
							
  
  <div class="form-group">
    <label for="gpf" class="col-md-3 control-label">GPF Number:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="gpf" name="gpf"  style="text-transform:uppercase" readonly value="<?php if (isset($data_value[0]['gpf_id']))echo $data_value[0]['gpf_id']; ?>" >
  </div>
  </div>
  
  <div class="form-group">
    <label for="name" class="col-md-3 control-label">Name:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="name" name="name"  style="text-transform:uppercase" value="<?php  if (isset($data_value[0]['name']))echo $data_value[0]['name'] ;?>" readonly>
    </div>
  </div>

  <div class="form-group">
     <label for="designation" class="col-md-3 control-label">Designation<span style="color:red; font-size:20px">*</span>:</label>
    
    <div class="col-md-4 has-success">
         <select  onchange="desig()" size="4" class="form-control" id="designation" name="designation[]">
         <?php $arr=explode(',', $data_value[0]['desig_id']);  foreach ($designation as $value) {  
           $c=0;
          foreach ($arr as $v) 
          {
            if($value['desig_id']==$v)
              $c++;
         }
         
         if($c>0)
         {
         ?>

         <option value="<?php echo $value['desig_id'] ?>" selected><?php echo $value['desig_name'] ?></option>
         
 <?php } else {?>
 <option value="<?php echo $value['desig_id'] ?>"><?php echo $value['desig_name'] ?></option>
        <?php }  }?>
         <option value="others">Others</option>
         </select>


       <!-- <input type="text" class="form-control" id="desig_id" name="desig_id" spellcheck="true" value="<?php if (isset($data_value[0]['desig_id']))echo $data_value[0]['desig_id']; ?>" required>-->
  </div>
  </div>

  <div class="form-group " style="display:none" id="sub_desig">
    <label for="ref_srl" class="col-md-3 control-label">Add Designation<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="add_desig" name="add_desig"  style="text-transform:uppercase" value="<?php echo set_value('add_desig'); ?>" >
    </div>
  </div>
    
<div class="form-group">
    <label for="department" class="col-md-3 control-label">Section Name<span style="color:red; font-size:20px">*</span>:(Press Ctrl key for multiple selection.)</label>
    <div class="col-md-4 has-success">
    <select class="form-control section_list" multiple="multiple" onchange="add_section();" size="4" id="section" name="section[]" >
      <?php $arr=explode(',', $data_value[0]['sec_id']);  foreach ($section_name as $value) {  
           $str="";
          foreach ($arr as $v) 
          {
            if($value['sec_id']==$v)
              $str="selected";
           
         }
         
        
         ?>
        <option value="<?php echo $value['sec_id'] ?>" <?php echo($str) ?>><?php echo $value['sec_name'] ?></option>
                 
        <?php } ?>
     <option value="others">Others</option>
    </select>
  </div>
  </div>

  
  
  <div class="form-group " style="display:none" id="sub_sec">
    <label for="add_sec" class="col-md-3 control-label">Add Section<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="add_sec" name="add_sec"  style="text-transform:uppercase" value="<?php echo set_value('add_sec'); ?>" >
    </div>
  </div>

<div class="form-group" id="subsec" style="display:none" class="subsec">
    <label for="department" class="col-md-3 control-label">Sub Section Name<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select class="form-control" multiple="multiple" onchange="" size="3" id="subsec_list" name="subsec_list[]" >
      
     <option value="others">Others</option>
    </select>
  </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-md-3 control-label">Email Id:</label>
    <div class="col-md-4 has-success">
    <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($data_value[0]['email']))echo $data_value[0]['email']; ?>" >
  </div>
  </div>

 <div class="form-group">
    <label for="department" class="col-md-3 control-label">Gender<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select class="form-control"  id="gender" name="gender">
    
    <option value="M"  <?php if (isset($data_value[0]['gender']) && $data_value[0]['gender']=="M")echo 'selected'; ?>>Male</option>
    <option value="F" <?php if (isset($data_value[0]['gender']) && $data_value[0]['gender']=="F")echo 'selected'; ?>>Female</option>
    
    </select>
  </div>
  </div>

  <div class="form-group">
    <label for="phone" class="col-md-3 control-label">Contact No:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="phone" maxlength="10" name="phone" value="<?php if (isset($data_value[0]['phone']))echo $data_value[0]['phone']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
  </div>
  </div>
  
  <div class="form-group">
    <label for="uname" class="col-md-3 control-label">Username:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="uname" name="uname" value="<?php if (isset($data_value[0]['user_name']))echo $data_value[0]['user_name']; ?>">
  </div>
  </div>
  
 
  
 <div class="form-group">
  <label class="col-md-3 control-label"></label>
<div class="col-md-4">
  <button type="submit" class="btn btn-primary">Update</button>
  </div></div>
  

			</fieldset>
      <input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
					</form>
				</div>
			</div>
		</div>
		
  </div>
  <script type="text/javascript">

$(document).ready(function(){
    $(".section_list").click(function(){
      //alert("okk");
      var base_url=$("#base_url").val();
      
       var section=$("#section").val();
      // alert(section);
     var section=$("#section").val();
      var url=base_url+"User/fetch_subsec/";
      //alert(url);
       $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',section:section},
           success: function(result){
            if(result){
              //alert(result);
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