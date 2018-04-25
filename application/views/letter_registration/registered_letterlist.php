<style>
.starbtn,.starrr_disable { color: #ea0421; font-size: 16px;}
</style>
<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Registered Paper List</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table id="editTable">
                          <thead>
                            <tr>
                              <th>RECEIVED DATE</th>
                              <th>REFERENCE NUMBER</th>
                              <!--<th>REGISTER</th>-->
                              <!--<th>SERIAL NUMBER</th>-->
                              <th>TYPE OF PAPER</th>
                              <th>MEMO NUMBER</th>
                              <th>ISSUE DATE</th>
                              <th>SENDING AUTHORITY</th>
                              <th>ADDRESSING DESIGNATION</th>
                              <th>SUBJECT</th>
                              <th>ACTION</th>
                              
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){
								$starGivenUserRank = fetch_rank($value["star_given_by"]);
								?>
                            <tr <?php if($value["letter_move_status"]=='P') echo 'class="pstatus"';?>>
                              <td><?php echo db_dt_format($value["reg_dt"]);?></td>
                              <td><?php echo $value["category_register"].sprintf("%02d", $value["ref_serial"]);?></td>
                              <!--<td><?php echo $value["category_register"];?></td>-->
                              <!--<td><?php echo $value["sl_no"];?></td>-->
                              <td><?php echo $value["paper_type"];?></td>
                              <td><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" style="color:green" target="_blank"><?php echo $value["memo_no"];?></a>
                              <?php if($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank < $starGivenUserRank){ ?>
									<div class="starrr starrr_disable" data-rating='<?php echo $value["star_mark"]; ?>' title="Rating given by <?php  echo $value["ratingGivenUser"];?>"></div>
								  <?php } elseif($value["star_mark"] > 0 && $value["star_given_by"] > 0 && $currentUserRank >= $starGivenUserRank) { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>" data-rating='<?php echo $value["star_mark"]; ?>'></div>
								  <?php } else { ?> 
								  <div class="starrr starbtn" data-id="<?php echo $value["letter_id"];?>"></div>
								<?php } ?>
                              </td>
                              <td><?php echo db_dt_format($value["issue_dt"]);?></td>

							<td><?php if ($value["sending_authority"]==1)
							   {
									echo $value["peti_name"]. '<br>' .$value["peti_address"];
							   }
							   else if($value["sending_authority"]==17)
							   {
									echo $value["email_sender"]. '<br>' .$value["email"];
							   }
							   else
							   {
									echo $value["authority_name"];
							   }
								
							?></td>
                              <!-- <td><?php echo $value["authority_name"]; ?></td> -->


                              <td><?php echo $value["desig_name"];?></td>
                              <td><?php echo $value["subject"];?></td>
                               
                               <td><?php if($value["letter_move_status"]=='P'){?>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url().'letter_inbox/dispatch/'.$value["letter_id"];?>">Dispatch</a>
                                
                                <?php } else if($value["letter_move_status"]=='M') echo 

                                  '<div class="flip" id="flip'.$value['letter_id'] .'" style="width:100%">
                                    <span class="btn btn-success btn-sm">Dispatched</span>
                                    </div>'
                                    ; ?>
                                    <div class="shpanel"  id="<?php echo 'shpanel'.$value['letter_id'];?>" readonly style="overflow-y : scroll; overflow-y : overlay; height: auto; overflow-x : hidden; padding: 10px; border-radius: 10px; border: 2px solid #73AD21;" >
                                            <?php $endorsed="";
                                            foreach(letter_endorsed($value['letter_id']) as $val)
                                            {
                                              $endorsed.=$val['name'].' -> ';
                                            }
                                           if(isset($val['ext_receiver'])){$endorsed.=$val['ext_receiver'];}
                                             echo trim($endorsed,' -> ');
                                             ?>
                                          </div>
                                  </td>
								  
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/jquery.dataTables.min.css">
    <script src='<?php echo base_url(); ?>style/js/rating.js'></script>
<script>

$( document ).ready(function() {
    
    $('#editTable').dataTable();
    
	$('.starrr_disable').unbind();
	$('.starbtn').on('starrr:change', function(e, value){
		/**console.log($(this).attr('data-id'));
		console.log(value);
		**/
		var base_url='<?php echo base_url(); ?>';
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
    
    