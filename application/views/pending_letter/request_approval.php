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
                              
                              <th>MEMO NO.</th>
                              <th>SENT TO</th>
                              <th>ISSUING AUTHORITY</th>
                              <th>SUBJECT</th>
                              <th>Request DETAILS</th>
                              <th>Request STATUS</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){?>
                            <tr id="<?php echo 'c2'.$value['action_id'] ;?>">
								<td><a style="color:green;" href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" target="_blank"><?php echo $value["memo_no"];?></a></td>
								<td>
								  <?php if($value["action_receiver"] !=0 ) echo fetch_user_name($value["action_receiver"]);
								   else if($value["recv_id"] !=0) echo fetch_user_name($value["recv_id"]);
								  
								  ?>
								</td>
								<td><?php echo $value["authority_name"];?></td>
								<td><?php echo $value["subject"];?></td>
								<td><?php echo $value["action_details"];?></td>
								<td>
								<strong>
								<?php if($value["request_approval_status"] == 0) { ?>
								<span style="color: red; ">Pending</span>
								<?php } elseif($value["request_approval_status"] == 1) { ?>
								<span style="color: green; ">Approved</span>
								<?php } ?>
								</strong>
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
    