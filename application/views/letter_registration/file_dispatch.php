
<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg>File Dispatch</div>
          <div class="panel-body">
            <div class="col-md-12">
              
                  <?php echo validation_errors('<div style="color:red;">','</div>');?>
                  <div class="form-group">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
                  <?php echo form_open('file_inbox/dispatch/'.$results[0]["file_id"],"class='form-horizontal'");?>  
                  <div class="form-group">
                    <label for="name" class="col-md-3 control-label">File Name<span style="color:red; font-size:20px">&nbsp;</span>:</label>
                    <div class="col-md-4 has-success">
                      <input type="text" class="form-control" id="name"  value="<?php echo $results[0]["file_name"]; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="ref_srl" class="col-md-3 control-label">File REF_SRL Number<span style="color:red; font-size:20px">&nbsp;</span>:</label>
                    <div class="col-md-4 has-success">
                    <input type="text" class="form-control" id="ref_srl" name="file_ref_sl_no" value="<?php echo $results[0]["file_ref_sl_no"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Subject<span style="color:red; font-size:20px">&nbsp;</span>:</label>
                     <div class="col-md-4 has-success">
                     <input type="text" class="form-control" id="ref_srl"  value="<?php echo $results[0]["subject_name"]; ?>" readonly>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Received from<span style="color:red; font-size:20px">&nbsp;</span>:</label>
                     <div class="col-md-4 has-success">
                     <input type="text" class="form-control" id="ref_srl"  value="<?php echo $desig_name; ?>" readonly>
                    </div>
                  </div>

                 <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Addressed to (Designation)<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control designation" id="designation" onchange="show_section()" name="designation">
                      <option value="">---Select one---</option>
                      <?php foreach($designation as $value){ ?>
                    <option value="<?php echo $value['desig_id']; ?>" ><?php echo $value['desig_name']; ?></option>
                   <?php }?>
                   
                    </select>
                  </div>
                  </div>


   <div class="form-group" style="display:none" id="sub_sec">
    <label for="department" class="col-md-3 control-label">Section Name:</label>
    <div class="col-md-4 has-success section">
    <select class="form-control"   id="section" name="section[]" required>
      <option value="">-----Select one----</option>
      <?php if(isset($section_name)) { foreach ($section_name as $value) { ?>
    <option value="<?php echo $value['sec_id'] ?>" <?php if($value['sec_id']==set_value('section')) echo 'selected'; ?>><?php echo $value['sec_name'] ?></option>
     <?php } }?>
     
    </select>
  </div>
  </div>
                
                <div class="form-group">
                    <label for="user_id" class="col-md-3 control-label">Addressed to (name)<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control" id="user_id" name="user_id">
                      <option value="">---Select one---</option>
                    </select>
                  </div>
                  </div>
                  
                  
                  <div class="form-group">
    <label for="note" class="col-md-3 control-label">Note Text<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
      <?php $data = array(
      'name'        => 'note',
      'id'          => 'note',
      );
      ?>
      <?php echo form_textarea($data); ?>
    <!--<Textarea class="form-control upper-control" id="note" name="note" required></Textarea>-->
  </div></div>
  
  <div class="form-group">
    <label for="sig" class="col-md-3 control-label">Signature<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success">
    <input type="text" class="form-control" id="sig" name="sig" required>
  </div></div>

                  <input type="hidden" value="<?php echo $results[0]["file_id"]; ?>" name="file_id">
                    <input type="hidden" value="<?php echo $results[0]["br_value"]; ?>" name="br_value">  
                   <input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
                   <div class="col-md-5 widget-right">
                  <input type="reset" class="btn btn-primary pull-right" value='Reset' style="margin-right: 5px;">
                  <input type="submit" class="btn btn-primary pull-right"  style="margin-right: 5px;" value='Submit'>

                  </div>     
                  </form>
                              
               
              </div>
            </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
   
    <script type="text/javascript">

    $(document).ready(function(){
    $(".section").change(function(){

      var base_url=$("#base_url").val();
      var token_name=$("#token_name").val();
      var hash=$("#hash").val();
       var designation=$("#designation").val();
      var section=$("#section").val();
      var url=base_url+"letter_inbox/fetch_emp_name/";
       $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',designation:designation,section:section},
           success: function(result){
           
         $("#user_id").html(result);
    }});
     
  });
});

 $(document).ready(function(){
    $(".designation").change(function(){
      var base_url=$("#base_url").val();
      var token_name=$("#token_name").val();
      var hash=$("#hash").val();
      var designation=$("#designation").val();
      var url=base_url+"file_inbox/fetch_emp_name/";
       $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',designation:designation},
           success: function(result){
         $("#user_id").html(result);
    }});
     
  });
});

    </script>
   