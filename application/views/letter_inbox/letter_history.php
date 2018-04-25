<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Letter History</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Sender Name</th>
                              <th>Sender Section</th>
                              <th>Receiver Name</th>
                              <th>Receiver Section</th>
                              <th>Date</th>
                              <th>Action Details</th>
                              <th>Action Status</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php if(isset($history) && count($history[0])){ foreach($history[0] as $value){?>
                            <tr>
                              
                              <td><?php  echo $history[1][$value['trail_letter_id']];?></td>
                              <td><?php  echo trim($history[3][$value['trail_letter_id']],',');?></td>
                              <td><?php  echo $history[2][$value['trail_letter_id']];?><?php if(isset($value["ext_receiver"])){ echo "  ".$value["ext_receiver"];}?></td>
                              <td><?php  echo trim($history[4][$value['trail_letter_id']],',');?></td>
                              <td><?php  echo $value['date_of_action'];?></td>
                              <td><?php  echo $value['action_details'];?></td>
                              <td><?php  if($value['action_status']=='P') echo "Pending"; else if($value['action_status']=='C') echo "Completed"; else if($value['action_status']=='AT') echo "Action Taken"; else if($value['action_status']=='No') echo "Not Actionable"; ?></td>
                            </tr>
                        
                           <?php }}else{ ?>
                           <tr><td colspan="7"><h4 style="color:#F00">No file movement</h4></td></tr>
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
    
    