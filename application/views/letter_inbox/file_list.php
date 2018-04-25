<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"><svg class="glyph stroked email"></svg>File List</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              
                              <th>FILE REF. SL. NUMBER</th>
                              <th>FILE NAME</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){?>
                            <tr>
                              <td><?php echo $value["file_ref_sl_no"];?></td>
                              <td><?php echo $value["file_name"];?></td>
                              <td><a href="<?php echo base_url().'attach_to_file/index/'.$value["file_id"];?>" style="color:#5fc4c8">Attach Correspondance Page</a></td>
                              
                              
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    <?php echo $links;?>
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
    
    