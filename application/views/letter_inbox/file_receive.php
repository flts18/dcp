<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg>File Receive</div>
          <div class="panel-body">
            <div class="col-md-12">
              
                  <?php echo validation_errors('<div style="color:red;">','</div>');
                      echo '<span style="color:red">'.$this->session->flashdata('error_message').'</span>';
                  ?>
                  <div class="form-group">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
                  <?php echo form_open('file_inbox/receive/'.$results[0]["file_id"],"class='form-horizontal'");?>  
                  <div class="form-group">
                    <label for="name" class="col-md-3 control-label">File Name:<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <input type="text" class="form-control" id="name"  value="<?php echo $results[0]["file_name"]; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="ref_srl" class="col-md-3 control-label">File REF_SRL Number<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <input type="text" class="form-control" id="ref_srl"  value="<?php echo $results[0]["file_ref_sl_no"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Subject<span style="color:red; font-size:20px">*</span>:</label>
                     <div class="col-md-4 has-success">
                     <input type="text" class="form-control" id="ref_srl"  value="<?php echo $results[0]["subject_name"]; ?>" readonly>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Received from<span style="color:red; font-size:20px">*</span>:</label>
                     <div class="col-md-4 has-success">
                     <input type="text" class="form-control" id="ref_srl"  value="<?php echo $desig_name;?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="show_key" class="col-md-3 control-label"></label>
                    <div class="col-md-4 has-success">
                    <input type="checkbox" id="show_key" name="show_key" onclick="k_show()">&nbsp;&nbsp;Show the Key Number <span id="skey" style="display:none"><?php echo $results[0]["dispatch_key"];?></span>
                  </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="file_key_number" class="col-md-3 control-label">Enter File key Number<span style="color:red; font-size:20px">*</span>:</label>
                     <div class="col-md-4 has-success">
                     <input type="text" class="form-control" id="file_key_number" name="file_key_number">
                     </div>
                  </div>

                  <input type="hidden" value="<?php echo $results[0]["file_id"]; ?>" name="file_id">
                     
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
   