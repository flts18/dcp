<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By File Name</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('file_inbox/track_file_ref_sl',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="name" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
    <input type="text" class="form-control" id="name" name="name" value=<?php  echo $this->session->userdata('file_name'); ?> >
    
  </div>
   <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i>&nbsp;Go</button> 
  </div>
  

			</fieldset>
            <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                             <th>ID</th>
                             <th>FILE NAME</th>
                              <th>SUBJECT</th>
                              <th>FILE WITH</th>
                              <th>SECTION</th>
                              <th>PENDING FOR</th>
							  <th>LOCATION</th>
                              <th>HISTORY</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                          <?php if(isset($results)){foreach($results as $key=>$value){?>
                            <tr>
                                
                                
                                 <td class="text-center">
							
									<?php  if($results[$key]==true){ ?><a class=" btn btn-default btn-sm" style="background:#1ebfae;color:#ffffff;border-radius:5px;" href="<?php echo base_url().'file_inbox/file_view/?fid='.id_encrypt($value["file_id"]);?>" style="color:#5fc4c8"><?php } else{  ?> <a class=" btn btn-default btn-sm" data-toggle="modal" data-target="#panel-modal" style="background:#1ebfae;color:#ffffff;border-radius:5px;"><?php } echo $value["file_id"];?></a>
									
									<?php  if($results[$key]==true){ ?><a class="btn btn-danger btn-circle" style="background:#f39c12;border:none;" href="<?php echo base_url().'attach_to_file/view_plan/'.$value["file_id"];?>" style="color:#5fc4c8"><?php } else{  ?> <a class="btn btn-danger btn-circle" data-toggle="modal" data-target="#panel-modal" style="background:#f39c12;border:none;"><?php } ?>POI</a>
									
								</td>
								
								
                              <td><?php //print_r($results[3][$key]);
                              if($results[$key]==true){ ?><a href="<?php echo base_url().'file_inbox/file_view/?fid='.id_encrypt($value["file_id"]);?>" style="color:#5fc4c8"><?php } else{  ?> <a class=" waves-effect waves-light" data-toggle="modal" data-target="#panel-modal" style="color:#5fc4c8;cursor:pointer"><?php } echo $value["file_ref_sl_no"];?></a></td>
                              <td style="width:50%;"><?php echo $value["subject"];?></td>
                             <td><?php echo fetch_user_name($value["reciver_user_id"]);?></td>
                             <td><?php echo $value["sec_name"];?></td>
                              <td><?php 
                if($value["file_status"]=='R')echo days_ago(strtotime($value["received_date_time"]));else if($value["file_status"]=='D') echo "<span class='btn btn-danger btn-sm'>".wordwrap('Not received yet',25,'<br>\n')."</span>";
                else if($value["file_status"]=='A') echo "<span class='btn btn-danger btn-sm'>".wordwrap('N.A (in Almirah)',25,'<br>\n')."</span>";
                else if($value["file_move_status"]=='P') echo days_ago(strtotime($value["file_reg_date"]));
                ?></td>
				<td><?php echo $value['store_at'];?></td>
                <td><a href="<?php echo base_url().'file_inbox/file_history/'.$value['file_id'];?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-book"></i>&nbsp;Show History</a></td>
                              </tr>
                            
                           <?php  }}?>
                          </tbody>
                          </table>
                          </div>
                          <?php echo $links;?>
  </div>
  
  
  </div>
					</form>
				</div>
			</div>
		</div>
		
  </div>
  <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-0 b-0">
                                                <div class="panel panel-color panel-primary">
                                                    <div class="panel-heading"> 
                                                        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button> 
                                                        <h3 class="panel-title">File Permission</h3> 
                                                    </div> 
                                                    <div class="panel-body"> 
                                                        <p>Sorry! you dont have permission to open this file.</p> 
                                                    </div> 
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->