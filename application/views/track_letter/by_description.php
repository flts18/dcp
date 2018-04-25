<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By Description</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('file_inbox/track_file_bydescription',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="des" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
    <input type="text" class="form-control" id="des" name="des" value="<?php echo $this->session->userdata('description');?>" required>
    
  </div>
   <button type="submit" class="btn btn-primary">Go</button> 
  </div>
  
  
  </fieldset>
  
  
  
  <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                             <th>FILE REF. SL. NUMBER</th>
                              <th>DESCRIPTION</th>
                              <th>RECEIVED BY</th>
                              <th>SECTION</th>
                              <th>PENDING FOR</th>
                              <th>           </th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php if(isset($results[0])){foreach($results[0] as $value){?>
                            <tr>
                              <td><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" style="color:#5fc4c8"><?php echo $value["file_ref_sl_no"];?></a></td>
                              <td><?php echo $value["description"];?></td>
                              <td><?php echo $results[2][$value["file_id"]];?></td>
                              <td><?php echo $results[1][$value["file_id"]];?></td>
                              <td><?php 
							  if($value["file_status"]=='R')echo days_ago(strtotime($value["received_date_time"]));else if($value["file_status"]=='D') echo '<span style="color:red">'.wordwrap("File sent logically but not received physically",25,"<br>\n").'</span>';
                else if($value["file_status"]=='A') echo '<span style="color:red">'.wordwrap("N.A (in Almirah)",25,"<br>\n").'</span>';
                else if($value["file_move_status"]=='P') echo days_ago(strtotime($value["file_reg_date"]));
							  ?></td>
                <td><a href="<?php echo base_url().'file_inbox/file_history/'.$value['file_id'];?>" style="color:white" class="btn btn-primary">Show History</a></td>
                            </tr>
                            
                           <?php } }?>
                          </tbody>
                          </table>
                          </div>
                          <?php echo $links;?>
  </div>
  </div>
  </div>
  </div>
  </div>
  
 