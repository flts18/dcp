 <?php  //print_r($results); ?>
	


    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg> Edit Letters</div>
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
                  
                  
                

                 <!--  <?php echo form_open('letter_registration/letter_edit/',"class='form-horizontal'");?> -->

				 <?php echo form_open('letter_registration/letter_update',"class='form-horizontal'",array('onsubmit' => 'return show_confim();'));?> 


			<div class="form-group" style="display:none;">
				<label for="ref_srl" class="col-md-3 control-label">Letter ID<span style="color:red; font-size:20px">&nbsp;</span>:</label>
					<div class="col-md-4 has-success">
						<input type="hidden" class="form-control" id="l_id" name="l_id" value="<?php echo $results[0]["letter_id"]; ?>">
					</div>
			</div>

			<div class="form-group">
				<label for="ref_srl" class="col-md-3 control-label">Memo No.<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<input type="text" class="form-control" id="memo_no" name="memo_no" required value="<?php echo $results[0]["memo_no"]; ?>">
					</div>
			</div>

			<div class="form-group ">
				<label for="ltr_cp_txt" class="col-md-3 control-label">C P No.(from)<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<input type="number" spellcheck="true" class="form-control upper-control" min="1" id="ltr_cp_from" name="ltr_cp_from" required  required style="text-transform:uppercase" onkeyup="cp_to()" *onkeypress='return event.charCode >= 48 && event.charCode <= 57;' value="<?php echo $results[0]["cp_no_from"]; ?>" >
					</div>
			</div> 

			<div class="form-group ">
				<label for="ltr_cp_to" class="col-md-3 control-label">C P No.(to)<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<input type="number" spellcheck="true"  class="form-control upper-control input-sm" min="1" id="ltr_cp_to" name="ltr_cp_to"  required style="text-transform:uppercase" *onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $results[0]["cp_no_to"]; ?>" >
					</div>
			</div>	
                  
 
			<div class="form-group ">
				<label for="comments" class="col-md-3 control-label">Subject<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<textarea spellcheck="true" class="form-control upper-control" id="sub" name="sub" required placeholder="" style="text-transform:uppercase" onblur="upper_str(this)"><?php echo $results[0]["subject"]; ?></textarea>
					</div>
			</div>

			
			
			<div class="form-group ">
				<label for="authority" class="col-md-3 control-label">Issuing Authority<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<input type="text" class="form-control" id="authority" name="authority" onkeyup="autocomplet()" required autocomplete="off" *value="<?php //echo $results[0]["sending_authority"]; ?>" value="<?php  if(is_numeric($results[0]["sending_authority"])) {echo fetch_auth_name($results[0]["sending_authority"]);} else echo $results[0]["sending_authority"];?>">
						<input type="hidden" id="authority_id" name="authority_id" value="">
							<ul id="authority_list" class="list-group col-md-12 uli"></ul>
					</div>
			</div>
          

			<div class="form-group " style="display:none" id="sub_div1">
				<label for="add_authority_name" onblur="upper-control" class="col-md-3 control-label">Add Authority<span style="color:red; font-size:20px">*</span>:</label>
					<div class="col-md-4 has-success">
						<input type="text" spellcheck="true" class="form-control" onblur="upper_str(this)" id="add_authority_name" name="add_authority_name"  style="text-transform:uppercase" value="<?php //echo set_value('add_authority_name'); ?>">
					</div>
			</div>


<!--
			
			<div class="form-group">
			<label for="department" class="col-md-3 control-label">Addressed to <span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success" style="*border:1px solid red;margin-top:10px;">
                    <input type="checkbox" value="IN" name="receiver_typeIn" id="receiver_typeIn" onclick="receivertype('receiver_typeIn','.addr-to','designation','user_id')" checked="checked">&nbsp;&nbsp;Internal&nbsp;&nbsp;
                    <input type="checkbox" value="EX" onclick="receivertype('receiver_typeEx','.extrnal-org','receiver_name','receiver_address')" id="receiver_typeEx" name="receiver_typeEx">&nbsp;&nbsp;External

                  </div>
                  </div>

					<div class="form-group designation addr-to">
                    <label for="department" class="col-md-3 control-label">Addressed to (Designation)<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control designation" id="designation" onchange="show_section()" name="designation" required>
                      <option value="">---Select one---</option>
                      <?php foreach($designation as $value){ ?>
                    <option value="<?php echo $value['desig_id']; ?>" ><?php echo $value['desig_name']; ?></option>

					<!-- <option <?php if($value['desig_name']==$results[0]['ext_receiver']) { ?> selected="selected" <?php } ?> value="<?php echo $value['desig_id'];?>"><?php echo $value['desig_name']; ?></option> -->
          <!--         <?php }?>
                   
                    </select>
                  </div>
				  </div>


					<div class="form-group designation addr-to">
				  <label for="user_id" class="col-md-3 control-label">Addressed to (name)<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <select class="form-control" id="user_id" name="user_id" required>
                     
                    </select>
                  </div>
                  </div>


				  <div class="form-group extrnal-org" style="display:none">
                    <label for="department" class="col-md-3 control-label">Organization <span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <input type="text"  class="form-control extrnal-search" id="receiver_name" name="receiver_name" >
                    
                  </div>
				  </div>
                 
                      
                  <div class="form-group extrnal-org" style="display:none">
                    <label for="" class="col-md-3 control-label">Addressed To<span style="color:red; font-size:20px">*</span>:</label>
                    <div class="col-md-4 has-success">
                    <textarea  class="form-control" id="receiver_address" name="receiver_address" ></textarea>
                    
                  </div>
                  </div>

				  <div  class="popup extrnal-hid" style="display:none">
                        <div class="popuptext" id="extrnal_suggest"></div>
                 </div>

				 -->
		
         
			<div class="panel panel-default col-lg-12 col-lg-offset-2"> 
				<input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
					<input type="submit" class="btn btn-primary" value="Submit" onclick=" return show_confim();"/>

			</form>
			</div>

        </div>
        </div>
        
                
      </div><!--/.col-->

    </div><!--/.row-->


    <script type="text/javascript">



$(document).ready(function()
{
	$("#ltr_cp_from").change(function()
	{
		var a=$("#ltr_cp_from").val();
		$("#ltr_cp_to").val(a);
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
   