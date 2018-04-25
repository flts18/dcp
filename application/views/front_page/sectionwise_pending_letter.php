<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Pending Letter <?php if(isset($section_name)) echo '('.$section_name .')';?></div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                             
                              <th>MEMO NO.</th>
                              <th>LETTER ISSUING DATE</th>
                              <th>ISSUING AUTHORITY</th>
                              <th>LETTER WITH</th>
                              <th>PENDING FOR</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){?>
                            <tr>
                              <td><a href="<?php echo base_url().'repository/'.$value['location_path'].'/'.$value['letter_name'];?>" target="_blank"><?php echo $value["memo_no"];?></a></td>
                              <td><?php if($value["issue_dt"]!="0000-00-00 00:00:00")echo $value["issue_dt"];?></td>
                              <td><?php echo $value["authority_name"];?></td>
                              <td><?php echo $value["name"];?></td>
                              <td><?php echo days_ago(strtotime($value["dispatch_dt_time"]));?></td>
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
    
   