
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg> Letter Registration</div>
          <div class="panel-body">
             <?php echo validation_errors('<div style="color:red;">','</div>');?>
                 <?php if(isset($error)) echo '<span style="color:red">'.$error.'</span>';?>
                   <div class="form-group has-success">
                   <span style="color:green"><?php echo $this->session->flashdata('success_message'); ?></span>
                    </div>
                <?php if(isset($success))
                {
                echo $success."<br>";
                foreach($success_file as $key=>$value)
                {
                   echo $value."<br>";
                }
                }
                ?>
                  
                   <?php echo form_open_multipart('letter_registration/letter_insert/',"class='form-horizontal'");?> 
                

                  

<div class="form-group">
                    <label for="ref_sl" class="col-md-3 control-label">Serial No.<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                   <?php $data = array(
                                        'name'          => 'slno',
                                        'id'            => 'slno',
                                        
                                        'class'        =>'form-control upper-control',
                                        
                                          'readonly'  =>'readonly'
                                          );

                          echo form_input($data); 
           
                   ?>
                   </div>
                  </div>

                  <div class="form-group">
                    <label for="memono" class="col-md-3 control-label">Memo no.<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                   <?php $data = array(
                                        'name'          => 'memono',
                                        'id'            => 'memono',
                                        'value'         => '',
                                        'class'        =>'form-control',
                                        'required'    =>'required',
                                        
                                        );
                      echo form_input($data);
                          
           
                   ?>
                   </div>
                  </div>
 
      <div class="form-group ">
                      <label for="comments" class="col-md-3 control-label">Previous Memo Numbers:</label>
                      <div class="col-md-4 has-success">
        <textarea spellcheck="true" class="form-control upper-control" id="pre_letter_no" name="pre_letter_no" placeholder="Sender Name- XXXXXX/XXXX" style="text-transform:uppercase" onblur="upper_str(this)"><?php echo set_value('comments'); ?></textarea>
                      </div>
                    </div>

                  <div class="form-group">
                    <label for="issue_dt" class="col-md-3 control-label">Issue Date<span style="color:red; font-size:20px">*</span>:</label>
                     <div class="col-md-4 has-success">
      
      <input class="datepicker form-control"  id="issue_dt" name="issue_dt" value="<?php echo date('d/m/Y') ?>" required>

          
                     </div>
                  </div>
         <div class="form-group ">
        <label for="ltr_sub" class="col-md-3 control-label">Subject<span style="color:red; font-size:20px">*</span>:</label>
        <div class="col-md-4 has-success">
        <input type="text" spellcheck="true" class="form-control" id="ltr_sub" name="ltr_sub" value="<?php echo set_value('ltr_sub'); ?>" required>
        </div>
  </div>
 <!--  coading for FILE CREATED Field -->  

                  <div class="form-group">
        <label for="authority" class="col-md-3 control-label">Issuing Authority<span style="color:red; font-size:20px">*</span>:</label>
          
          <div class="col-md-4 has-success">
            
          <input type="text" class="form-control" id="authority" name="authority" onkeyup="autocomplet()" required autocomplete="off">
          <input type="hidden" id="authority_id" name="authority_id" value="">
                   <ul id="authority_list" class="list-group col-md-12 uli"></ul>
                 
                </div>

          </div>
          

          <div class="form-group " style="display:none" id="sub_div1">
                    <label for="add_authority_name" onblur="upper-control" class="col-md-3 control-label">Add Authority<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
<input type="text" spellcheck="true" class="form-control" onblur="upper_str(this)" id="add_authority_name" name="add_authority_name" value="<?php echo set_value('add_authority_name'); ?>" required>
                    </div>
          </div>                   

          <div class="form-group">
                    <label for="letter_reg" class="col-md-3 control-label">Category of Letter<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control" id="letter_cat" name="letter_cat" onchange="lettercat()" required>
                      <option value="">---Select one---</option>
                      <?php foreach($register as $value){ ?>
                    <option value="<?php echo $value['register_id']; ?>" ><?php echo $value['paper_type']; ?></option>
                   <?php }?>
                   
                    </select>
                  </div>
                  </div>

 <!--  coding for register type Field -->
          
              <div class="form-group">
                    <label for="reg_type" class="col-md-3 control-label">Category of Register<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control" id="reg_type"  name="reg_type" onchange="" required>
                      <option value="">---Select one---</option>
                      <?php foreach($register_type as $value){ ?>
                    <option value="<?php echo $value['reg_type_id']; ?>" ><?php echo $value['category_register']; ?></option>
                   <?php }?>
                   
                    </select>
                  </div>
                  </div>

      <div class="form-group">
                          <label for="ref_sl" class="col-md-3 control-label">Reference Serial No.<span style="color:red; font-size:20px"></span>:</label>
                          <div class="col-md-4 has-success">
                         <?php $data = array(
                                              'name'          => 'ref_sl',
                                              'id'            => 'ref_sl',
                                              'value'         => '',
                                              'class'        =>'form-control upper-control',
                                              
                                              'onkeypress'   =>' return event.charCode >= 48 && event.charCode <= 57',
                                              );
                            echo form_input($data);
                                
                 
                         ?>
                         </div>
                        </div>



 <div class="form-group" id="addr_desig">
                    <label for="department" class="col-md-3 control-label">Addressed to (Designation) <span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control designation" id="designation" onchange="show_section()"  name="designation[]" multiple required >
                      <option value="">---Select one---</option>
                      <?php foreach($designation as $value){ ?>
                    <option value="<?php echo $value['desig_id']; ?>" ><?php echo $value['desig_name']; ?></option>
                   <?php }?>
                   
                    </select>
                  </div>
                  </div>


   <div class="form-group" style="display:none" id="sub_sec">
    <label for="department" class="col-md-3 control-label">Section Name:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-4 has-success section">
    <select class="form-control"   id="section" name="section[]" >
      <option value="">-----Select one----</option>
      <?php if(isset($section_name)) { foreach ($section_name as $value) { ?>
    <option value="<?php echo $value['sec_id'] ?>" <?php if($value['sec_id']==set_value('section')) echo 'selected'; ?>><?php echo $value['sec_name'] ?></option>
     <?php } }?>
     
    </select>
  </div>
  </div>

                <!-- <div class="form-group">
                    <label for="user_id" class="col-md-3 control-label">Addressed to (name):</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control" id="user_id" name="user_id">
                      <option value="">---Select one---</option>
                    </select>
                  </div>
                  </div> -->


        <div class="form-group" style="display:block" id="to_addr_ext">
          <label for="addr_ext" class="col-md-3 control-label">Addressed to External Organisation:</label>
          <div class="col-md-4 has-success checkbox">
          <input type="checkbox" id="addr_ext" name="addr_ext" onclick="check_addr_Ext()" value="1">
        </div>
      </div>
      <div class="form-group" id="recip_no" style="display:none">
                          <label for="ref_sl" class="col-md-3 control-label">No. of Recipeints<span style="color:red; font-size:20px"></span>:</label>
                          <div class="col-md-4 has-success">
                         <?php $data = array(
                                              'name'          => 'recipeint_no',
                                              'id'            => 'recipeint_no',
                                              'value'         => '',
                                              'class'        =>'form-control upper-control',
                                              // 'required'    =>"true"
                                              
                                              );
                            echo form_input($data);
                                
                 
                         ?>
                         </div>
                        </div>

        <div class="row">
          <div class="panel panel-default col-lg-5">        
           <div class="input_letter_wrap">
                       <!-- <button class="add_letter_button btn btn-primary">Add More Pages of Letter</button><br><br><br> -->
                       <div class="form-group">
                    <label for="letterfile" class="inc1">&nbsp;&nbsp;&nbsp;&nbsp;Letter Page 1 (maximum size should be less than 1 MB)</label>
                    <input type="file" class="form-control" id="letterfile" name="letterfile[]" onchange="check_double_ext();"required>
                  </div>
              </div>
          </div>
 <div class="panel panel-default col-lg-5">   
                  <!-- <div class="input_doc_wrap">
                        <button class="add_doc_button btn btn-primary">Add More Pages of Suportive Documets</button><br><br><br>
                       <div class="form-group">
                    <label for="docfile" class="inc2">&nbsp;&nbsp;&nbsp;&nbsp;Document Page 1</label>
                    <input type="file" class="form-control" id= "docfile" name="docfile[]">
                  </div> -->
              </div>
              
  </div>
          
       </div>  
      </div>
      <div class="panel panel-default col-lg-12"> 
         <input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
      <input type="submit" class="btn btn-primary" value="Upload" />
        
          </form>
        </div>
        </div>
        </div>
        
                
      </div><!--/.col-->

    </div><!--/.row-->
    
    	<script type="text/javascript">
	
$('#letterfile').bind('change', function() {
  
 var a = this.files[0].size;
 
  if(a > 1048576)
	{
		alert("File size is more than 1 MB.");
		$("#letterfile").val('');
	}
  

});

</script>


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

 function lettercat() {
  var letter_cat = $('#letter_cat').val();
  var base_url=$("#base_url").val();
  var url=base_url+"letter_registration/lettercat/";

  $.ajax({
      url: url,
      type: 'POST',
      data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',letter_cat:letter_cat},
      success:function(data){
         //alert(data);
        $('#slno').val(data);
      }
    });
  
}

function registercat() {
  var reg_type = $('#reg_type').val();
  var base_url=$("#base_url").val();
  var url=base_url+"letter_registration/registercat/";

  $.ajax({
      url: url,
      type: 'POST',
      data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',reg_type:reg_type},
      success:function(data){
         //alert(data);
        $('#ref_sl').val(data);
      }
    });
  
}
    </script>
   