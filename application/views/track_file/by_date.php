<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>By Date of File Creation</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('file_inbox/track_file_bydate',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="search" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
                    
                     <div class="col-md-4 has-success">
			
			<input class="datepicker" data-date-format="mm/dd/yyyy" id="issue_dt" name="issue_dt" value="<?php echo set_value('issue_dt'); ?>" required>

		      
                     </div>
                  
    
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
                              <th>FILE WITH</th>
                              <th>SECTION</th>
                              <th>PENDING FOR</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php if(isset($results[0])){foreach($results[0] as $value){?>
                            <tr>
                              <td><a href="<?php echo base_url().'file_inbox/file_history/'.$value['file_id'];?>" style="color:#5fc4c8"><?php echo $value["file_ref_sl_no"];?></a></td>
                              <td><?php echo $value["description"];?></td>
                               <td><?php echo $value["name"];?></td>
                               <td><?php echo $results[1][$value["file_id"]];?></td>
                               <td><?php $str="File sent logically but not received by recipient"; 
                              if($value["file_status"]=='R')echo days_ago(strtotime($value["received_date_time"]));else echo '<span style="color:red">'.wordwrap($str,25,"<br>\n").'</span>';
                              ?></td>
                              </tr>
                            
                           <?php  }}?>
                          </tbody>
                          </table>
                          </div>
                          <?php echo $links;?>
  </div>
  
					</form>
				</div>
			</div>
		</div>
		
  </div>