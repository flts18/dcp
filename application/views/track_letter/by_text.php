<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By Search Key</div>
          <div class="panel-body">
            <div class="col-md-12">
          
          <?php echo form_open('Track_letter/track_letter_bytext',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="des" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">

    <input type="text" class="form-control" id="text" name="text" value="<?php echo $this->session->userdata('text');?>" required>
    
  </div>
   <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i>&nbsp;Go</button> 
  </div>
  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Search Type:</label>
                    <div class="col-md-4 has-success">
                    <div class="radio">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="NORMAL"  id="search_typ" name="search_typ"  <?php if($this->session->userdata("search_type")=="NORMAL" || $this->session->userdata("search_type")=="") echo "checked"; ?>>&nbsp;&nbsp;Normal Search            
					
				   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" value="EXACT" name="search_typ" id="search_typ" <?php if($this->session->userdata("search_type")=="EXACT") echo "checked"; ?>>&nbsp;&nbsp;Exact Matching Search
					</div>
                  </div>
                  </div>
  
  </fieldset>
  
  
  
  <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                             <th>SLNO</th>
                             <th>CATEGORY</th>
                             <th>MEMO NUMBER</th>
                             <th>ISSUING DATE</th>
                             <th>ISSUING AUTHORITY</th>
                              <th>PAPER WITH</th>
                              <th>CONTENT</th>
                              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php {if(isset($results)){ foreach($results as $value){?>
                           <tr>
								<td><?php echo $value["sl_no"];?></td>
								<!-- <td><?php echo $value["reg_dt"];?></td> -->
								<td><?php echo $value["paper_type"];?></td>
								<td><a href="<?php echo base_url().'/'.'pdf_resource/files/'.$value['letter_name'];?>" style="color:green" target="_blank"><?php echo $value["memo_no"];?></a></td>
                                <td><?php echo db_dt_format($value["issue_dt"]);?></td>
                                <td><?php echo $value["authority_name"];?></td>
								
								
								<td>
								<?php 
									if($value["file_id"] == '0') {
										if(isset($value['receiver_id']) && $value['receiver_id']!=0)
										{
											echo $value["receiverName"];
										} else if($value['ext_receiver']!=NULL) {
											echo $value["ext_receiver"];
										} else
										{
											echo $value["receiverName"];
										}
									} 
										//echo $results[2][$value["letter_id"]]; 
									else {
										
										if(isset($value['receiver_id']) && $value['receiver_id']!=0)
										{
											echo $value["file_ref_sl_no"];
										} else if($value['ext_receiver']!=NULL) {
											echo 'N/A';
										} else
										{
											echo $value["file_ref_sl_no"];
										}
										
										//echo $results[3][$value["letter_id"]];
									}
										
								?>
								</td>
                              <td><?php 
                                //echo stripos($value['content'],trim($this->session->userdata('text')));
                               $text=explode(" ",$this->session->userdata('text'));
                              // echo $this->session->userdata('text')."<br>";
                               //echo stripos($value['content'],trim($this->session->userdata('text')))."<br>";
                               if(stripos($value['content'],trim($this->session->userdata('text'))))
                               {
                               echo  substr($value['content'],stripos($value['content'],trim($this->session->userdata('text'))),60);
                               }
                                else
                                {
                                    foreach($text as $val)
                                    {
                             
                                      if($po=stripos($value['content'],trim($val)))
                                          {
                                        echo  substr($value['content'],$po,60)."<br>";
                                         break;
                                         }

                                    }

                                }
                               


                           
                              //stripos() echo $value['content'];

                              ?></td>
                             
                <td><a href="<?php echo base_url().'track_letter/letter_history/'.$value['letter_id'];?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-book"></i>&nbsp;Show History</a></td>
              </tr>
                            
							<?php } } }?>
                          </tbody>
                          </table>
                          </div>
                          <?php echo $links;?>
  </div>
  </div>
  </div>
  </div>
  </div>
  
 