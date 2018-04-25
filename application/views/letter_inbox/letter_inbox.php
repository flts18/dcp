<style>
.starbtn,.starrr_disable { color: #ea0421; font-size: 16px;}
</style>
<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
		<?php echo validation_errors('<div style="color:red;">','</div>');?>
                 <?php if(isset($error)) echo '<span style="color:red">'.$error.'</span>';?>
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Paper Inbox</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table table-condensed">
                          <thead>
                            <tr>
                              <th>REFERENCE NUMBER</th>
                              <th>MEMO NO.</th>
                              <th>PAPER ISSUING DATE</th>
                              <th>ISSUING AUTHORITY</th>
                              <th>SENDER</th>
                              <th>SUBJECT</th>
                              <th>DISPATCH  DATE</th>
                              <th>ACTION DETAILS</th>
                              <th>ACTION STATUS</th>
                              <th>DEADLINE OF ACTION</th>
                              <th> PROCESS </th>
                              <!-- <th> ATTACH </th>-->
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){
							$starGivenUserRank = fetch_rank($value["star_given_by"]);	
							?>
                            <tr class="<?php if($value['action_status']=='P') echo 'pstatus'; ?>">
                              <td><?php echo $value["category_register"].sprintf("%02d", $value["ref_serial"]);?></td>
                              
                              <td><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" style="color:green" target="_blank"><?php echo $value["memo_no"];?></a>
							  <br>
							 
							  
							  <!-- Trigger the modal with a button -->
				<?php if(isset($value["attachment_id"])){?>			  
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#custom-width-modal<?php echo $value['letter_id']; ?>">Show Report</button>
				<?php }?>
			 <div id="custom-width-modal<?php echo $value['letter_id']; ?>"class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog" style="width:45%;">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:gray">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:white">x</button>
                                                    <h4 class="modal-title" id="custom-width-modalLabel" style="color:white">From: <?php echo(($value["name"]));?></h4>
                                                </div>
                                                <div class="modal-body"  style="height:auto; overflow-y:scroll;">
												<?php 
												
												// $sentences = preg_split('/([.?!]+)/', $value["content"], -1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE); 
												// $newString = ''; 
												// foreach ($sentences as $key => $sentence) { 
													// $newString .= ($key & 1) == 0? 
														// ucfirst(strtolower(trim($sentence))) : 
														// $sentence.' '; 
												// } 
												?>
												
												<div class="row">
												   <div class="form-group ">
													
														<div class="col-md-12 has-success ">
															<textarea spellcheck="true" class="form-control note" id="note<?php echo $value['attachment_id']; ?>" name="note" *placeholder="---Notes----" style="height:300px; "><?php echo $value["content"]; ?></textarea>
														</div>
													
													</div>
											    </div>
												<div class="row">
													<div class="modal-footer">
													<!--<input type="hidden" name="content" id="content" value="<?php //echo $value["content"]; ?>">-->
														<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
														<button type="button" id="<?php echo $value['attachment_id']; ?>" class="btn btn-default waves-effect updt" data-dismiss="modal">Save</button>
													   <!-- <a href="<?php echo base_url().'Actionable_letter/edit_attachment/'.$value["attachment_id"];?>"  class="btn btn-default waves-effect " *data-dismiss="modal">Edit</a>-->
													</div>
												</div>												
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
							   </div><!-- /.modal -->
							   
							  <?php if($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank < $starGivenUserRank){ ?>
									<div class="starrr starrr_disable" data-rating='<?php echo $value["star_mark"]; ?>' title="Rating given by <?php  echo $value["ratingGivenUser"];?>"></div>
								  <?php } elseif($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank >= $starGivenUserRank) { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>" data-rating='<?php echo $value["star_mark"]; ?>'></div>
								  <?php } else { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>"></div>
								  <?php } ?>
							 
							  </td>
                              <td><?php if($value["issue_dt"]!="0000-00-00 00:00:00")echo db_dt_format($value["issue_dt"]);?></td>
                              <td><?php  if(is_numeric($value["sending_authority"]))echo fetch_auth_name($value["sending_authority"]); else{echo $value["sending_authority"];}?></td>
                              <td><?php echo $value["name"];?> &nbsp;<?php if($value["comments"]) { ?><div class="flip" id="flip<?php echo $value['letter_id']; ?>" style="width:100%">
                                    <span style="font-weight:bold;cursor:pointer"><span class="glyphicon glyphicon-pencil" style="color:blue"></span></span>
                                    </div>
                                    <div class="shpanel"  id="<?php echo 'shpanel'.$value['letter_id'];?>" readonly style="overflow-y : hidden; overflow-y : hidden; height: auto; overflow-x : hidden; padding: 10px; border-radius: 10px; border: 2px solid #73AD21;" >
                                            <?php 
                                              echo $value["comments"];
                                             ?>
                                          </div>



                                    <?php }?></td>
                              <td><?php echo $value["subject"];?></td>
                              <td><?php if($value["dispatch_dt_time"]!="0000-00-00 00:00:00")echo date("d-m-Y",strtotime($value["dispatch_dt_time"]));?></td>
                              <td><abbr title="<?php echo($value["action_remark"])?>" class="txt-dec-none"><?php echo $value["action_details"];?></abbr></td>
                              <td><label  id="<?php echo $value['action_id'] ;?>"><?php if($value['action_status']=='P'){echo'<label class="status" id ="'. $value['action_id'].'"; style="color:red">Pending</label>';}else if($value['action_status']=='C'){echo '<label style="color:green">Completed</label>';}else if($value['action_status']=='AT'){echo '<label class="status" style="color:green">Action Taken</label>';}?></label><?php if($value['action_status']=='No'){echo '<label>N.A </label>';} ?></td>
                              <td><b><?php if($value["deadline_dt"]!="0000-00-00") echo '<span style="color :'.date_color($value["deadline_dt"]). '">'.db_dt_format($value["deadline_dt"]).'</span>';?></b></td>
                              <td class="text-center">
                          
                           <?php if($value["recv_status"]!='S') 
                                  
                                  { 
                                ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url().'letter_inbox/dispatch/'.$value["letter_id"];?>"><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp;&nbsp;Dispatch&nbsp;&nbsp;&nbsp;</a>
                          
                            <?php } ?>
							
							</td>
                              
                                
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                  </div>

            </div>
          </div>
        </div>
     
    </div><!--/.row-->
   
   
			
    <script src='<?php echo base_url(); ?>style/js/rating.js'></script>
<script>

$( document ).ready(function() {
	$('.starrr_disable').unbind();
	$('.starbtn').on('starrr:change', function(e, value){
		/**console.log($(this).attr('data-id'));
		console.log(value);
		**/
		var base_url=$("#base_url").val();
		var dataId=$(this).attr('data-id');
		var url=base_url+"file_inbox/setRatingFileInbox/";
		$.ajax({url:url, 
			type:'post',
			data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo 	$this->security->get_csrf_hash(); ?>',dataId:dataId,ratingVal:value},
			success: function(result){
			}
		});
	});
});

 $(document).ready(function(){
    $(".status").click(function(){

      var base_url=$("#base_url").val();
     var id=$(this).attr("id");
//alert(id);
      var url=base_url+"Letter_inbox/letter_action_status/";
	 
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
           success: function(result){ 
         $("#"+id).html(result);
    }});
     
  });
});

$(document).ready(function(){
    $(".updt").click(function(){

      var base_url=$("#base_url").val();
     var id=$(this).attr("id");
	
	 var note =tinymce.get("note"+id).getContent();
	 
      var url=base_url+"Actionable_letter/edit_attachment/";
	// alert(note);
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id,note:note},
           success: function(result){ 
		   alert(result);
         //$("#"+id).html(result);
    }});
     
  });
});
</script>
 <script>
  tinymce.init({
    selector: '.note',
    entity_encoding : "raw",
    plugins: 'print  textcolor',
    menubar: 'file edit  view format table tools textcolor',
    toolbar: "indent outdent numlist bullist forecolor backcolor",
   // width: 400,
  });

 
  </script>