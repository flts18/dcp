<style>
.starbtn,.starrr_disable { color: #ea0421; font-size: 16px;}
</style>
<div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
         <div class="panel-heading"><svg class="glyph stroked email"></svg>Star Papers</div>
		 <div class="panel-body">
		   <?php echo form_open('letter_registration/star_letter_reports',"class='form-horizontal rating_form'");?>  
 		  <fieldset>
		  <div class="form-group" id="date_show">
		  <label for="search" class="col-md-3 control-label">Ratings<span style="color:red; font-size:20px">*</span>:</label>
			<div class="col-md-3 has-success">
			<select class="form-control" id="rating_display_option" name="rating_val"  required>
			<?php for($i=1; $i < 6; $i++) { $str = ($i == 1) ? 'Star' : 'Stars'; ?>
				<option value="<?php echo $i; ?>"><?php echo $i.' '.$str; ?></option>
			<?php } ?>				  
			</select>
				<div class="starrr starrr_disable" id="rating_display"></div>
				<?php for($i=1; $i < 6; $i++) { $str = ($i == 1) ? 'Star' : 'Stars'; ?>
					<div class="starrr starrr_disable" data-rating='<?php echo $i; ?>' title="<?php echo $i.' '.$str; ?>" id="custom_rating_<?php echo $i; ?>" style="display : none;"></div>
				<?php } ?>				
		   </div>
			
		  </div>
		  
		  </fieldset>
		  </div>
          <div class="panel-body">
            <div class="canvas-wrapper">
                    <div class="table-responsive">          
                        <table id="editTable">
                          <thead>
                            <tr>
                              <th>RECEIVED DATE</th>
                              <th>REFERENCE NUMBER</th>
                              <th>TYPE OF PAPER</th>
                              <th>MEMO NUMBER</th>
                              <th>ISSUE DATE</th>
                              <th>SENDING AUTHORITY</th>
                              <th>ADDRESSING DESIGNATION</th>
                              <th>SUBJECT</th>
							</tr>
                          </thead>
                          
                           <tbody>
                            <?php foreach($results as $value){ ?>
                            <tr <?php if($value["letter_move_status"]=='P') echo 'class="pstatus"';?>>
                              <td><?php echo db_dt_format($value["reg_dt"]);?></td>
                              <td><?php echo $value["category_register"].sprintf("%02d", $value["ref_serial"]);?></td>
                              <td><?php echo $value["paper_type"];?></td>
                              <td><a href="<?php echo base_url().'pdf_resource/files/'.$value['letter_name'];?>" style="color:green" target="_blank"><?php echo $value["memo_no"];?></a>
								<div class="starrr starrr_disable" data-rating='<?php echo $value["star_mark"]; ?>' title="Rating given by <?php  echo $value["ratingGivenUser"];?>"></div>
							  
							  </td>
                              <td><?php echo db_dt_format($value["issue_dt"]);?></td>
                              <td><?php echo $value["authority_name"]; ?></td>
                              <td><?php echo $value["desig_name"];?></td>
                              <td><?php echo $value["subject"];?></td>
                               
                               
								  
                            </tr>
                            
                           <?php } ?>
                          </tbody>
                          </table>
                          </div>
                    
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/jquery.dataTables.min.css">
<script src='<?php echo base_url(); ?>style/js/rating.js'></script>
<script>
var rating = '<?php echo $rating ?>';
var strTitle = '';
if(rating == 1)
{
	strTitle = rating+' Star';
} else {
	strTitle = rating+' Stars';
}
$('#rating_display_option').val(rating);
$('#rating_display').attr('data-rating',rating);
$('#rating_display').attr('title',strTitle);

$( document ).ready(function() {
	
	$('#rating_display_option').change(function(){
		var rating = $(this).val();
		$('#rating_display').css('display','none');
		$('#custom_rating_'+rating).css('display','');
		
		$('.rating_form').submit();
	});
	
	$('#editTable').dataTable();
	
	$('.starrr_disable').unbind();
	$('.starbtn').on('starrr:change', function(e, value){
		/**console.log($(this).attr('data-id'));
		console.log(value);
		**/
		var base_url='<?php echo base_url(); ?>';
		var dataId=$(this).attr('data-id');
		var url=base_url+"file_inbox/setRatingFileInbox/";
		$.ajax({url:url, 
			type:'post',
			data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo 	$this->security->get_csrf_hash(); ?>',dataId:dataId,ratingVal:value},
			success: function(result){
			}
		});
	});
});
</script>
    
    