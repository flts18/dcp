

<body>
    <div class="col-lg-12">
          <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Add Sub Section</div>
          <div class="panel-body">
            <div class="col-md-12">
              
                
         <?php echo validation_errors('<div style="color:red;">','</div>');?>
          <div class="form-group has-success">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
                    <div class="form-group has-success">
                   <span style="color:red"><?php echo $this->session->flashdata('error_message'); ?></span>
                    </div>
             <?php echo form_open('user/insert_sub_section',"class='form-horizontal'");?>
            <fieldset>
              
  
  <div class="form-group">
  <label for="sec" class="col-md-3 control-label">Section Name<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <select class="form-control" id="sec" name="sec" onchange="section()" required>
                      <option value="">---Select one---</option>
                      <?php foreach($section as $value){ ?>
                    <option value="<?php echo $value['sec_id']; ?>" <?php if($this->session->userdata('sec_id')==$value['sec_id']) echo "selected"; ?>><?php echo $value['sec_name']; ?></option>
                   <?php }?>
                   
                    </select>
   </div>

</div>


 
  <div class="form-group">
    <label for="sec_name" class="col-md-3 control-label">Sub Section Name<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="sec_name" name="sec_name" style="text-transform:uppercase" required>
  </div></div>
  
  <div class="form-group">
    <label for="sec_code" class="col-md-3 control-label">Sub Section Code<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="sec_code" name="sec_code" style="text-transform:uppercase" required>
  </div></div>




 
         
          
          

  

                  <div class="form-group">
                     <div class="col-md-5 widget-right">
                       <input type="reset" class="btn btn-primary pull-right" value='Reset' style="margin-right: 5px;">
                       <input type="submit" class="btn btn-primary pull-right"  style="margin-right: 5px;" value='Submit'>
                                    
                 
                  <!--<button type="reset" class="btn btn-primary">Reset</button>   -->
                   </div>
                </div>



      </fieldset>
          
        </div></div></div></div>
      </div>
    </div>
    
  
</body>


  
  
  
  
	


