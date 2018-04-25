  
        
      <div class="login-panel panel panel-default">
				<div class="panel-heading"><svg class="glyph stroked email"></svg>User access section</div>
				<div class="panel-body">
          <?php echo validation_errors('<div style="color:red;">','</div>');?>
             <?php echo form_open('user/signup',"class='form-horizontal'");?>
						<fieldset>
							
  <div class="form-group">
    <label for="name" class="col-md-3 control-label">Name:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="name" name="name"  style="text-transform:uppercase" value="<?php echo set_value('name'); ?>" required>
    </div>
  </div>


  <div class="form-group">
    <label for="gpf" class="col-md-3 control-label">Designation :</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="deg" name="deg"  style="text-transform:uppercase" value="" >
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
   
  
  
  