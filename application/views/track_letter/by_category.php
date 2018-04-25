<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By Category</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('track_letter/track_letter_bycategory',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="des" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
   <select class="form-control" id="cat" name="cat" onchange="section()" required>
                      <option value="">---Select one---</option>
                      <?php foreach($paper_type as $value){ ?>
                    <option value="<?php echo $value['register_id']; ?>" <?php if($this->session->userdata('paper_type')==$value['register_id']) echo "selected"; ?>><?php echo $value['paper_type']; ?></option>
                   <?php }?>
                      </select>
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
                             
                <td><a href="<?php echo base_url().'track_letter/letter_history/'.$value['letter_id'];?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-book"></i>&nbsp;Show History</a></td>
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
  
 