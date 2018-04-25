<style>
.starbtn,.starrr_disable { color: #ea0421; font-size: 16px;}
</style>
<?php 
if(isset($results[0]) && count($results[0]) > 0) {
?>
<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Request's For Approval</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              
                              <!-- <th data-checkbox="true"></th> -->
						        <th class="th-color" data-sortable="true">Memo No.</th>
						        <th class="th-color" data-sortable="true">Issue Date</th>
						        <th >Subject</th> 
								<th class="th-color" data-sortable="true">Requested By</th>
								<th class="th-color" data-sortable="true">Details</th>
								
								<th class="th-color">Action Status</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php 
								foreach($results[0] as $value){
								$starGivenUserRank = fetch_rank($value["star_given_by"]);
								?>
								<tr>
									<!-- <td><input type="checkbox"></td> -->
									
									<td ><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" target="_blank" style="color:green"><?php echo $value['memo_no'];?></a>
									<?php if($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank < $starGivenUserRank){ ?>
									<div class="starrr starrr_disable" data-rating='<?php echo $value["star_mark"]; ?>' title="Rating given by <?php  echo $value["ratingGivenUser"];?>"></div>
								  <?php } elseif($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank >= $starGivenUserRank) { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>" data-rating='<?php echo $value["star_mark"]; ?>'></div>
								  <?php } else { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>"></div>
								<?php } ?>
									</td>
									<td data-sortable="true"><?php echo db_dt_format($value['issue_dt']);?></td>
									<td data-sortable="true"><?php $this->load->helper('text'); echo(word_limiter($value['subject'], 4)) ;?></td>
									<td data-sortable="true"><?php echo fetch_user_name($value['action_sender']);?></td>
									<td data-sortable="true"><span style="color: #000;"><?php echo $value['action_details'];?></span></td>
									<td data-sortable="true">
										<a onclick="request_approval_approved('<?php echo $value['action_id'] ;?>');">
										<span style="color: #000;">Approved</span></a>
									</td>
									
								</tr>

								<?php 
								}
							?>
							  
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                  </div>

            </div>
          </div>
        </div>
      </div>

<?php } ?>
<?php 
if(isset($results[1]) && count($results[1]) > 0) {
?>
<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Your tasks</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              
                              <!-- <th data-checkbox="true"></th> -->
						        <th class="th-color" data-sortable="true">Memo No.</th>
						        <th class="th-color" data-sortable="true">Issue Date</th>
						        <th >Subject</th> 
								<th class="th-color" data-sortable="true">Action Given By</th>
								<th class="th-color" data-sortable="true">Action Details</th>
								<th class="th-color" data-sortable="true">Deadline</th>
								<th class="th-color">Action Status</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php 
							
								foreach($results[1] as $value){
									$starGivenUserRank = fetch_rank($value["star_given_by"]);
								?>
								<tr>
									<!-- <td><input type="checkbox"></td> -->
									
									<td ><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" target="_blank" style="color:green"><?php echo $value['memo_no'];?></a>
									
									<?php if($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank < $starGivenUserRank){ ?>
									<div class="starrr starrr_disable" data-rating='<?php echo $value["star_mark"]; ?>' title="Rating given by <?php  echo $value["ratingGivenUser"];?>"></div>
								  <?php } elseif($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank >= $starGivenUserRank) { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>" data-rating='<?php echo $value["star_mark"]; ?>'></div>
								  <?php } else { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>"></div>
								<?php } ?>
									</td>
									<td data-sortable="true"><?php echo db_dt_format($value['issue_dt']);?></td>
									 <td data-sortable="true"><?php $this->load->helper('text'); echo(word_limiter($value['subject'], 4)) ;?></td>
									<td data-sortable="true"><?php echo fetch_user_name($value['action_sender']);?></td>
									<td data-sortable="true"><?php if($value["deadline_dt"]!="0000-00-00") echo '<span style="color :'.date_color($value["deadline_dt"]). '">'; ?><?php echo $value['action_details'];?><?php echo'</span>';?></td>
									<td data-sortable="true"><?php if($value["deadline_dt"]!="0000-00-00"){ echo '<span style="color :'.date_color($value["deadline_dt"]). '">'; ?><?php echo $value["deadline_dt"];?><?php echo'</span>'; }?></td>
									<td><label class="status" id="<?php echo $value['action_id'] ;?>"><?php if($value['action_status']=='P'){echo'<span style="color:red">Pending</span>';}else if($value['action_status']=='C'){echo '<span style="color:green">Completed</span>';}else if($value['action_status']=='AT'){echo '<span style="color:green">Action Taken</span>';}?></label></td>
									
								</tr>

								<?php 
								}
													
							?>
							  
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                  </div>

            </div>
          </div>
        </div>
      </div>
<?php } ?>

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
</script>

	<script type="text/javascript">
	function request_approval_approved(action)
	{
		var base_url=$("#base_url").val();
		var url=base_url+"Letter_inbox/letter_request_approval/";
		$.ajax({url:url, 
			   type:'post',
			   data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>','action':action},
			  // alert(result);
			   success: function(result){
				//alert(result);
			 location.reload(true);
		}});
		
	}
	
	
	$(document).on('click', '.status', function(){
			    //$(".status").click(function(){
			    	//alert("okk");
			      var base_url=$("#base_url").val();
			     var id=$(this).attr("id");
			     
			      var url=base_url+"Letter_inbox/letter_action_status/";
			      $.ajax({url:url, 
			           type:'post',
			           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
			          // alert(result);
			           success: function(result){
			           	//alert(result);
			         $("#"+id).html(result);
			    }});
			     
			  });
	</script>