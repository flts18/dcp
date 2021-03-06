<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>By Date of Paper Creation</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('track_letter/track_letter_bydate',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="search" class="col-md-3 control-label">Search by date from<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
                    
                     <div class="col-md-12 has-success">
			
			<input class="form-control datepicker" data-date-format="mm/dd/yyyy" id="from_issue_dt" name="from_issue_dt"  value="<?php echo $this->session->userdata('from_reg_dt');?>"       required>

		      
                     </div>
                  
    
  </div>


  <div class="form-group">
  <label for="search" class="col-md-1 control-label">To <span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
                    
                     <div class="col-md-12 has-success">
      
      <input class="form-control datepicker " data-date-format="mm/dd/yyyy" id="to_issue_dt" name="to_issue_dt"  value="<?php echo $this->session->userdata('to_reg_dt');?>"       required>

          
                     </div>
                  
    
  </div>

   <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i>&nbsp;Go</button> 
  </div>
  

			</fieldset>
            <div class="table-responsive">          
                        <table class="table">
                          <thead>
                          <tr>
                             <th>SLNO</th>
                             <th>REGISTRATION DATE</th>
                             <th>CATEGORY</th>
                             <th>MEMO NUMBER</th>
                             <th>ISSUING DATE</th>
                             <th>ISSUING AUTHORITY</th>
                              <th>PAPER WITH</th>
                              <th>SECTION</th>
                              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php if(isset($results[0])){foreach($results[0] as $value){?>
                            <tr>
                              <td><?php echo $value["sl_no"];?></td>
                              <td><?php echo db_dt_format($value["reg_dt"]);?></td>
                              <td><?php echo $value["paper_type"];?></td>
                              <td><a href="<?php echo base_url().'/'.'pdf_resource/files/'.$value['letter_name'];?>" target="_blank" style="color:green"><?php echo $value["memo_no"];?></a></td>
                                <td><?php echo db_dt_format($value["issue_dt"]);?></td>
                                <td><?php echo $value["authority_name"];?></td>
                              <td><?php if($value["file_id"] == '0') echo $results[2][$value["letter_id"]]; else echo $results[3][$value["letter_id"]];?><?php if(isset($value["ext_receiver"])) echo " and ".$value["ext_receiver"];?></td>
                              <td><?php if($value["file_id"] == '0') echo $results[1][$value["letter_id"]]; else echo "";?></td>
                             
                <td><a href="<?php echo base_url().'track_letter/letter_history/'.$value['letter_id'];?>"class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-book"></i>&nbsp;Show History</a></td>
              </tr>
                           <?php } }?>
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