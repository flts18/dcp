<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Find the File</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('Track_letter/track_letter_bytext',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="des" class="col-md-3 control-label">Search by Barcode or File name:<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
    <input type="text" class="form-control" id="text" name="text" value="<?php echo $this->session->userdata('text');?>" required>
    
  </div>
   <button type="submit" class="btn btn-primary">Go</button> 
  </div>
  
  
  </fieldset>
  
  
  
  <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                             <th>MEMO NO.</th>
                              <th>REGISTRATION DATE</th>
                              <th>LETTER NAME</th>
                              <th>           </th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php {foreach($results as $value){?>
                            <tr>
                              <td><?php echo $value["memo_no"];?></a></td>
                              <td><?php echo $value["reg_dt"];?></td>
                              <td><a href="<?php echo base_url().'repository/'.$value["location_path"].'/'.$value["letter_name"];?>" style="color:#5fc4c8" target="_blank"><?php echo $value["letter_name"];?></td>
                                <td><a href="<?php echo base_url().'track_letter/letter_history/'.$value['letter_id'];?>" style="color:white" class="btn btn-primary">Show History</a></td>
                
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
  
 