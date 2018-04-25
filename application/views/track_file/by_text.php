<div class="row">
		                
          <div class="col-lg-12">
          <div class="panel panel-default">
          
          <div class="panel-heading"><svg class="glyph stroked email"></svg>Track By Search Key</div>
		  
          <div class="panel-body">
            <div class="col-md-12">
          <h5 style="color: red;">Note: This may take several seconds, Please wait!</h5>
          <?php echo form_open('file_inbox/track_file_bytext',"class='form-horizontal'");?>  
 					<fieldset>
							
  <div class="form-group">
  <label for="des" class="col-md-3 control-label">Search<span style="color:red; font-size:20px">*</span>:</label>
    <div class="col-md-3 has-success">
    <input type="text" class="form-control" id="text" name="text" value="<?php echo $this->session->userdata('text');?>" required>
    
  </div>
   <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i>&nbsp;Go</button>
	<?php if($this->session->userdata('text') != '') { ?>
	<a onclick="clearSearch();" class="btn btn-default" href="#">Clear Search</a>
	<?php } ?>
  </div>
  <div class="form-group">
                    <label for="department" class="col-md-3 control-label">Search Type:</label>
                    <div class="col-md-4 has-success">
                    <div class="radio">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="NORMAL"  id="search_typ" name="search_typ"  
					<?php if($this->session->userdata("search_type")=="NORMAL" || $this->session->userdata("search_type")=="") echo "checked"; ?>>&nbsp;&nbsp;Normal Search            
					
				   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" value="EXACT" name="search_typ" id="search_typ" <?php if($this->session->userdata("search_type")=="EXACT") echo "checked"; ?>>&nbsp;&nbsp;CP Content Search
					</div>
                  </div>
                  </div>
  
  
  </fieldset>
  </form>
  
  
  <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                               <th>ID</th>
                              <th>FILE NAME</th>
                              <th>SUBJECT</th>
                              <th>CORESPONDANCE PAGE NAME</th>
							  <th>FILE WITH</th>
							  <th>LOCATION</th>
                              <th>           </th>
                            </tr>
                          </thead>
                          
                           <tbody>
                               <?php if(isset($results[0]) && count($results[0]) > 0){
								foreach($results[0] as $key=>$value){?>
                            <tr>
                           
                                
                                <td class="text-center">
                                    
                                    
                                    	<?php  if($results[1][$key]==true){ ?><a class=" btn btn-default btn-sm" style="background:#1ebfae;color:#ffffff;border-radius:5px;" href="<?php echo base_url().'file_inbox/file_view/?fid='.id_encrypt($value["file_id"]);?>" style="color:#5fc4c8"><?php } else{  ?> <a class=" btn btn-default btn-sm" data-toggle="modal" data-target="#panel-modal" style="background:#1ebfae;color:#ffffff;border-radius:5px;"><?php } echo $value["file_id"];?></a>
									
									<?php if(isset($value["file_type"])) {if($value["file_type"]=="CRIME") { ?>
									
									
									<?php  if($results[1][$key]==true){ ?><a class="btn btn-danger btn-circle" style="background:#f39c12;border:none;" href="<?php echo base_url().'attach_to_file/view_plan/'.$value["file_id"];?>" style="color:#5fc4c8"><?php } else{  ?> <a class="btn btn-danger btn-circle" data-toggle="modal" data-target="#panel-modal" style="background:#f39c12;border:none;">POI</a>
									
									<?php } ?>
									<?php } } ?>

								</td>
				

                                
                             <td><?php  if($results[1][$key]==true){ ?><a href="<?php echo base_url().'file_inbox/file_view/?fid='.id_encrypt($value["file_id"]);?>" style="color:#5fc4c8"><?php } else{  ?> <a class=" waves-effect waves-light" data-toggle="modal" data-target="#panel-modal" style="color:#5fc4c8;cursor:pointer"><?php } echo $value["file_ref_sl_no"];?></a></td>
                              <td style="width:50%;"><?php echo $value["subject"];?></td>
                              <td><?php echo $value["memo_no"];?></td>
							 <td><?php if(isset($value['reciver_user_id']))echo fetch_user_name($value['reciver_user_id']);
							 
							 else echo fetch_user_name($value['user_id']);?></td>
							 <td><?php echo $value['store_at'];?></td>
                                <td><a href="<?php echo base_url().'file_inbox/file_history/'.$value['file_id'];?>" style="color:white" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-book"></i>&nbsp;Show History</a></td>
                
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
 <script>
 function clearSearch()
 {
	 <?php unset($_SESSION['text']); ?>
	 location.href='<?php echo base_url()."file_inbox/track_file_bytext" ?>';
 }
 </script>