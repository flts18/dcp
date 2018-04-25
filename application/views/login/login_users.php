<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default col-md-8 col-md-offset-2" *style="border:1px solid red;">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Login Users</div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                         <table border="0" data-toggle="table"  data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
                          <thead>
                            <tr>
                              
                              <th>USER NAME</th>
                              <th>LOGIN TIME</th>
							  <!-- <th>PHONE</th> -->
                              
                              
                            </tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results['results'] as $value){?>
                            <tr>
                              
                              <td><?php echo $value["name"];?></td>
                             <!--  <td><?php echo $value["last_login"];?></td> -->
                              
                              <td><?php if($value["last_login"]!="0000-00-00 00:00:00")echo date("d-m-Y H:i:s",strtotime($value["last_login"]));?></td>
                              
							  <!-- <td><a href="tel:'<?php echo $value['phone'];?>'" style="color:green;"><?php echo $value["phone"];?></a></td> -->
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    <?php //echo $links;?>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
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

      var url=base_url+"Letter_inbox/letter_action_status/";
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
           success: function(result){
         $("#"+id).html(result);
    }});
     
  });
});

 $(document).ready(function(){
    $(".accept_status").click(function(){
  
      var base_url=$("#base_url").val();
     var id=$(this).attr("id");

      var url=base_url+"Letter_inbox/letter_status_accept/";
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
           success: function(result){
         $("#"+id).html(result);
    }});
     
  });
});
$(document).ready(function(){
	
    $(".pending").click(function(){
		
    var idd='#shpanel'+$(this).attr("id");
	//alert(idd);
      $('.shpanel').not($(idd)).slideUp(800);
		$(idd).slideToggle();
		
		 // $(idd).scrollTo($(idd).right,$(idd).bottom);
        //$('html,body').animate({scrollTop: $(this).offset().top}, 800); 
    });
});
$(document).ready(function(){
    $(".next_date").click(function(){
  var idd='#shpanel'+$(this).attr("id");
      var base_url=$("#base_url").val();
	  var nxt_dt=($("#nxt_dt"+$(this).attr("id")).val());
	 // alert(nxt_dt);
	  var act_name=($("#act_name"+$(this).attr("id")).val());
     var id=$(this).attr("id");
     //alert(act_name);
      var url=base_url+"Letter_inbox/letter_status_postpond/";
	 // alert(url);
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id,act_name:act_name,nxt_dt:nxt_dt},
           success: function(result){
			$(idd).slideToggle();  
         $("#"+id).html(result);
    }});
     
  });
});
</script>