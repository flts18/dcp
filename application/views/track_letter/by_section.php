<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By Section</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('Track_letter/track_letter_bysending_authority',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="search" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
    <select class="form-control" id="sec" name="sec" onchange="section()" required>
                      <option value="">---Select one---</option>
                      <?php foreach($section as $value){ ?>
                    <option value="<?php echo $value['sec_id']; ?>" <?php if($this->session->userdata('sec_id')==$value['sec_id']) echo "selected"; ?>><?php echo $value['sec_name']; ?></option>
                   <?php }?>
                   
                    </select>
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
                          </thead>
                          
                           <tbody>
                            <?php if(isset($results[0])){foreach($results[0] as $value){?>
                            <tr>
                              <td><a href="<?php echo base_url().'file_inbox/file_view/?fid='.id_encrypt($value["file_id"]);?>" style="color:#5fc4c8"><?php echo $value["file_ref_sl_no"];?></a></td>
                              <td><?php echo $value["description"];?></td>
                              <td><?php echo $results[2][$value["file_id"]];?></td>
                              <td><?php echo wordwrap($results[1][$value["file_id"]],25,"<br>\n");?></td>
                              <td><?php 
                if($value["file_status"]=='R')echo days_ago(strtotime($value["received_date_time"]));else if($value["file_status"]=='D') echo '<span style="color:red">'.wordwrap("File sent logically but not received physically",25,"<br>\n").'</span>';
                else if($value["file_status"]=='A') echo '<span style="color:red">'.wordwrap("N.A (in Almirah)",25,"<br>\n").'</span>';
                else if($value["file_move_status"]=='P') echo days_ago(strtotime($value["file_reg_date"]));
                ?></td>
                 <td><a href="<?php echo base_url().'file_inbox/file_history/'.$value['file_id'];?>" style="color:white" class="btn btn-primary">Show History</a></td>
                            </tr>
                              </tr>
                            
                           <?php }}?>
                          </tbody>
                          </table>
                          </div>
                          <?php echo $links;?>
  </div>
  
  
  </div>