<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">User List</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
              <div class="table-responsive">          
                  <table class="table">
                    <thead>
                      <tr>
                        <th>G.P.F NUMBER</th>
                        <th>NAME</th>
                        <th>DESIGNATION</th>
                        <th>SECTION</th>
                        <th>REGISTERED ON</th>
                        <th>USER TYPE</th> 
                        <th>STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($results[0] as $values) {?>
                      <tr>
                        <td><?php echo $values['gpf_id'];?></td>
                        <td><a href="<?php echo base_url().'user/set_access/'.$values["user_id"];?>" style="color:#5fc4c8"><?php echo $values['name'];?></a></td>
                        <td><?php $uid=$values['user_id']; echo $results[1][$uid];?></td>
                        <td><?php $uid=$values['user_id']; echo wordwrap($results[2][$uid],25,"<br>\n");?></td>
                        <td><?php echo $values['reg_date'];?></td>
                        <td><select class="form-control has-success utype" name="utype" id="<?php echo 'u'.$values['user_id'] ;?>" style="width:120px;border:2px solid gray">
                        <option value="">--Select--</option>
                        <option value="normal_user" <?php if($values['user_type']=='normal_user') echo "selected" ;?>>Normal User</option>
                       <option value="priv_user" <?php if($values['user_type']=='priv_user') echo "selected" ;?>>Priviledged User</option>
                       <option value="priv_user" <?php if($values['user_type']=='super_user') echo "selected" ;?>>Super User</option>
                      <!--   <option value="admin" <?php if($values['user_type']=='admin') echo "selected" ;?>>Administrator</option> -->
                        </select></td>
                        <td><label class="status" id="<?php echo $values['user_id'] ;?>">
                          <?php if($this->session->userdata('user_id') != $values['user_id']) {?>

                          <?php if($values['is_active']=='Y'){
                            echo'<label style="color:green">Active</label>';
                               }else{echo '<label style="color:red">Inactive</label>';}

                          ?></label></td>
                          
                          <?php }?>
                      </tr>
                      <?php }?>
                    </tbody>
                    </table>
                    <input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
                    <?php echo $links;?>
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
    
     <script type="text/javascript">

 $(document).ready(function(){
    $(".status").click(function(){

      var base_url=$("#base_url").val();
     var id=$(this).attr("id");

      var url=base_url+"user/user_status/";
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
           success: function(result){

         $("#"+id).html(result);
    }});
     
  });
});

$(document).ready(function(){
    $(".utype").change(function(){

     var base_url=$("#base_url").val();
     var id=$(this).attr("id");
     var typevalue=$(this).val();
      var url=base_url+"user/user_type/";
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id,typevalue:typevalue},
           success: function(result){
           
         
    }});
     
  });
});
    </script>