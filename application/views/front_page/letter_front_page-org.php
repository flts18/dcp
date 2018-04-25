<script src="<?php echo base_url(); ?>style/js/lumino.glyphs.js"></script>
<script>
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
	<style>
	.large {
    font-size: 18px;
}

 
.table>thead:first-child>tr:first-child>th,
.table>thead>tr>th, 
.table>tbody>tr>th, 
.table>tfoot>tr>th 
 {
	*border: 3px solid #bdc3c7;
    border: 1px solid #BFBFBF;
	*color:#e74c3c;
	font-size:13px;
	*border:none;
	padding:5px;
	font-weight:bold;
	color:black;
	background: #d3d3d3;
}

.table>thead>tr>td, 
.table>tbody>tr>td, 
.table>tfoot>tr>td{
border: 1px solid #BFBFBF;
  *background: #708090;
  background: white;
  padding:5px;
  *font-size:10px;
  *color:#fff;
  color:black;
  font-weight:lighter;
}

td:hover{
  background: #708090;
  background: white;
  *color:#fff;
  color:black;
} 



	</style>
	<div class="col-lg-12  main">			
		<div class="row" *style="border:1px solid red;">
			<div class="col-lg-12" *style="margin-top:-10px;*border:1px solid red;">
				<h3 class="page-header" style="margin:-2px;"><p>Dashboard</p></h3>
			</div>
		</div><!--/.row-->


<div class="" *style="*margin-top:-25px;border:1px solid red;">
		<div class="row" *style="border:1px solid red;">
			<div class="col-lg-12" *style="border:1px solid red;">
				<h4 class="page-header">Letters</h4>
			</div>
		</div><!--/.row-->

<div class="row col-md-13">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding"><a href="<?php echo base_url().'letter_inbox' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo letter_inbox_count() ;?></div>
							<div class="text-muted small" style="color:#CC0000"><b>My Receive</b></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $my_sent ;?></div>
							<div class="text-muted small" style="color:#0033CC"><b>My Sent</b></div>
						</div>
					</div>
				</div>
			</div>
				<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding"><a href="<?php echo base_url().'actionable_letter/my_pending' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked open letter"><use xlink:href="#stroked-open-letter"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large" style="color:#996600"><b><?php echo $my_pending[0]?></b></div>
							<div class="text-muted"><div class="small" style="color:#00C78C"><b>My Tasks</b></div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $active_user ;?>/<?php echo $total_user ;?></div>
							<div class="text-muted small" style="color:#C67171"><b>Total Users</b></div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-emerald panel-widget ">
					<div class="row no-padding"><a href="<?php echo base_url().'letter_inbox' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $active_user ;?></div>
							<div class="text-muted small" style="color:#CC0000"><b>Active User</b></div>
						</div>
					</div>
				</div>
			</div> -->
			
			<!-- <div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-amethyst panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked clock"><use xlink:href="#stroked-clock"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="medium" style="color:#996600"><b><?php echo date("h:i:s a", strtotime($login_time ));?></b></div>
							<div class="text-muted"><div class="small" style="color:#00C78C"><b>Login Time</b></div></div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
		</div>



	<div class="" *style="*margin-top:-25px;border:1px solid red;">

		<div class="row">
			<div class="col-lg-12" style="margin:-25px 0 0 5px;">
				<h4 class="page-header">Files</h4>
			</div>
		</div><!--/.row-->




		<div class="row col-md-13">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-magenta panel-widget">
					<div class="row no-padding"><a href="<?php echo base_url().'file_inbox' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $my_recive_file;?></div>
							<div class="text-muted small" style="color:#CC0000"><b>Receive Files</b></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-steel panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $my_sent ;?></div>
							<div class="text-muted small" style="color:#0033CC"><b>Sent Files</b></div>
						</div>
					</div>
				</div>
			</div>
		<?php if($this->session->userdata('user_type')=="super_user"){?>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-crimson panel-widget">
					<div class="row no-padding"><a href="<?php echo base_url().'file_registration/usrwise_crimeFile' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked folder"><use xlink:href="#stroked-folder"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large" style="color:#996600"><b><?php echo $crime_data['total']; ?></b></div>
							<div class="text-muted"><div class="small" style="color:#00C78C"><b>Crime File</b></div></div>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
			
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-amethyst panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked clock"><use xlink:href="#stroked-clock"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="medium" style="color:#996600"><b><?php echo date("h:i:s a", strtotime($login_time ));?></b></div>
							<div class="text-muted"><div class="small" style="color:#00C78C"><b>Login Time</b></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
<?php  if(check_mark() !=false){ ?>
			<div class="alert bg-danger" role="alert">
			<?php $mark=check_mark(); 
				foreach($mark as $value){	?>
				
					<p style="color:white;"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg> <?php echo $value['file_ref_sl_no']."  (".$value['file_id'].")  "." file will be sent to you. "?> <a href="#" class="pull-right"></a></p>
			<?php }?>
				</div>
<?php }?>


		<div class="row col-md-13">
				<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="alert bg-warning">
						Your pending task for today
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table"   data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr>
						        <!-- <th data-checkbox="true"></th> -->
						        <th class="th-color" data-sortable="true">Memo No.</th>
						        <th class="th-color" data-sortable="true">Issue Date</th>
						        <!-- <th data-sortable="true">Action Status</th> -->
								<th class="th-color" data-sortable="true">Action Given By</th>
								<th class="th-color" data-sortable="true">Action Details</th>
								<th class="th-color">Action Status</th>
								
						    </tr>
						    </thead>

							<tbody>
					<?php foreach($to_do_list as $value){?>
							<tr>
						        <!-- <td><input type="checkbox"></td> -->
						        
						        <td ><a href="<?php echo base_url().$value['location_path'].'/'.$value['letter_name'];?>" target="_blank" style="color:green"><?php echo $value['memo_no'];?></a></td>
						        <td data-sortable="true"><?php echo $value['issue_dt'];?></td>
						        <!-- <td data-sortable="true"><?php echo $value['action_status'];?></td> -->
								<td data-sortable="true"><?php echo fetch_user_name($value['sender_id']);?></td>
								<td data-sortable="true"><?php if($value["deadline_dt"]!="0000-00-00") echo '<span style="color :'.date_color($value["deadline_dt"]). '">'; ?><?php echo $value['action_details'];?><?php echo'</span>';?></td>
						    	<td><label class="status" id="<?php echo $value['action_id'] ;?>"><?php if($value['action_status']=='P'){echo'<span style="color:red">Pending</span>';}else if($value['action_status']=='C'){echo '<span style="color:green">Completed</span>';}else if($value['action_status']=='AT'){echo '<span style="color:green">Action Taken</span>';}?></label></td>
						    	
						    </tr>

							<?php } ?>

							

						    </tbody>
						</table>
						<?php if(count($to_do_list)==0) echo"Presently no task found.";?>
					</div>
				</div>
			</div>
			
			<?php if($this->session->userdata('user_type')=="super_user"){ ?>
			<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="alert bg-success">
						List of Task given for today
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table"  data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr >
						        <!-- <th data-checkbox="true"></th> -->
						        <th data-sortable="true" >Memo No.</th>
						        <th data-sortable="true">Issue Date</th>
						        <!-- <th data-sortable="true">Action Status</th> -->
								<th data-sortable="true">Action Given To</th>
								<th data-sortable="true">Action Details</th>
								<th>Action Status</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-ok" ></i></th>
						    </tr>
						    <thead>

							<tbody>
					<?php foreach($action_given as $value){?>
							<tr>
						        <!-- <td><input type="checkbox"></td> -->
						        
						        <td data-sortable="true" class="strikethrough"><a href="<?php echo base_url().$value['location_path'].'/'.$value['letter_name'];?>" target="_blank" style="color:green"><?php echo $value['memo_no'];?></a></td>
						        <td data-sortable="true"><?php echo $value['issue_dt'];?></td>
						        <!-- <td data-sortable="true"><?php echo $value['action_status'];?></td> -->
								<td data-sortable="true"><?php echo $value["name"];?></td>
								<td data-sortable="true"><?php if($value["deadline_dt"]!="0000-00-00") echo '<span style="color :'.date_color($value["deadline_dt"]). '">'; ?><?php echo $value['action_details'];?><?php echo'</span>';?></td>
						    	<td><span  ><?php if($value['action_status']=='P'){echo'<span style="color:red">Pending</span>';}else if($value['action_status']=='C'){echo '<span style="color:green">Completed</span>';}else if($value['action_status']=='AT'){echo '<span style="color:green">Action Taken</span>';}?></span></td>
						    	<td data-sortable="true"><label class="accept_status" id="<?php echo $value['action_id'] ;?>"><?php  if($value['action_status']=='AT'){echo'<span style="color:red">Accept</span>';}else if($value['action_status']=='C'){echo '<span style="color:green">Accepted</label>';} ?></label></td>
						    </tr>

							<?php } ?>

							

						    </tbody>
						</table>
						<?php if(count($action_given)==0) echo"Presently no task found.";?>
					</div>
				</div>
			</div></div>
			<?php }?>
			
			
			<div class="row col-lg-13">
			<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="alert bg-danger">
						<!-- Super Users currently using FLTS -->

						Your Upcoming Task 
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table" data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr>
						        
						        <th data-sortable="true">Memo No.</th>
						        <th data-sortable="true">Issue Date</th>
								<th data-sortable="true">Action Given By</th>
						        <th data-sortable="true">Action Details</th>
								<th data-sortable="true">Deadline Date</th>
						        
						    </tr>
						    </thead>

							<tbody>


							
							<?php foreach($my_upcoming_task as $value){?>
							
							<tr>
								<td><?php echo $value['memo_no']; ?></td>
								<td><?php echo $value['issue_dt']; ?></td>
								<td><?php echo fetch_user_name($value['sender_id']);?></td>
								<td><?php echo $value['action_details']; ?></td>
								<td><?php echo $value['deadline_dt']; ?></td>										
							</tr>
							<?php } ?>
							
							
							

							

						    </tbody>
						</table>
					</div>
				</div>
				</div>
			
			
			<?php if($this->session->userdata('user_type')=="super_user"){ ?>
			<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="alert bg-danger">
						<!-- Section Using FLTS -->
						Upcoming Tasks Given
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table" data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr>
						        
						         <th data-sortable="true">Memo No.</th>
						        <th data-sortable="true">Issue Date</th>
								<th data-sortable="true">Action Given To</th>
						        <th data-sortable="true">Action Details</th>
								<th data-sortable="true">Action Status</th>
								<th data-sortable="true">Deadline Given</th>
						    </tr>
						    </thead>
			
							<tbody>
	
								<?php foreach($upcoming_task as $value){?>
							<tr>
								<td><?php echo $value['memo_no'];?></td>
								<td><?php echo $value['issue_dt'];?></td>
								<td><?php echo $value['name'];?></td>
								<td><?php echo $value['action_details'];?></td>
								<td><?php echo $value['action_status'];?></td>
								<td><?php echo $value['deadline_dt'];?></td>
							</tr>
							<?php } ?>
								
								


								
			
						    </tbody>
						</table>
					</div>
				</div>
			</div>
			
			<?php }?>
		</div><!--/.row-->	
		
		
		<div class="row">
			<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="panel-heading">
						<!-- Super Users currently using FLTS -->

						Implementation Details of Senior Officers
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table" data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr>
						        
						        <th data-sortable="true">Implementing </th>
						        <th data-sortable="true">Not implementing </th>
						        
						    </tr>
						    </thead>

							<tbody>

							<tr>
							    
								<td>DS Traditional Crime&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>IGP I CID</td>
						    </tr>

							<tr>
							    
								<td>DS North 24 Parganas&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>DIG Special</td>
						    </tr>


							<tr>

								<td>SS North&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>SS MALDA</td>
							</tr>


							<tr>

								<td>SS WEST&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>SS CENTRAL</td>
							</tr>

							<tr>
							    <td>Director,QDEB&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>Director SBDC, CID,WB</td>
						    </tr>

							<tr>
								<td>DS ATS & DS Cyber Crime&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>Director, FPB</td>
							</tr>

							<tr>
								<td>DS HQ (I)&nbsp;&nbsp;<sup class="new">NEW</sup></td>
								<td>DS HQ (II) & DS CIW</td>
							</tr>


							<tr>
							    <td>ADG CID</td>
								<td>DS Burdwan & DS Hooghly</td>
								
						    </tr>

							<tr>
							    <td>IGP II CID</td>
								<td>DS Special Cell,CID,WB</td>
						    </tr>

							<tr>
							    <td>DIG OPS</td>
								<td>DS Law & DS Cyber Crime Cell,CID,WB</td>
						    </tr>

							<tr>
							    <td>DIG CID</td>
								<td>DS (Siliguri)</td>
						    </tr>

							


					
							<tr>
							    <td>SS Special</td>
								<td>DS Siliguri Spl.</td>
						    </tr>

							<tr>
							    <td>SS HQ</td>
								<td>DS Railway & Highway Crime Cell</td>
						    </tr>

							<tr>
							    <td>SS OPS</td>
								<td>DS Malda</td>
						    </tr>

							<tr>
							    <td>SS ANTI C&F</td>
								<td>DS Bankura</td>
						    </tr>

							<tr>
							    <td>SS SOUTH</td>
								<td>DS Murshidabad</td>
						    </tr>

							<tr>
							    <td>DS SOUTH</td>
								<td>Legal Advisor,CID,WB</td>
						    </tr>

							<tr>
							    <td>DS ANTI CHEATING AND FRAUD</td>
								<td></td>
						    </tr>

							
							


						    </tbody>
						</table>
					</div>
				</div>
			</div>
			



		
			<div class="col-lg-6" *style="border:1px solid red;">
			<div class="panel panel-primary">
				<div class="panel-heading">
						<!-- Section Using FLTS -->
						Implementation Details of Section
					</div>
					<div class="panel-body">
						<table border="0" data-toggle="table" data-url="tables/data1.json"  *data-show-refresh="true" *data-show-toggle="true" *data-show-columns="true" *data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" *data-sort-order="desc">
						    <thead>
						    <tr>
						        
						         <th data-sortable="true">Implementing</th>
						        <th data-sortable="true">Not Implementing </th>
						    </tr>
						    </thead>
			
							<tbody>

								<tr>
									<td>POWC&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>Medical Section</td>
								</tr>

								
								<tr>
									<td>CIW Section&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>Computer Section</td>
								</tr>

								
								<tr>
									<td>ACCOUNTS CC&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>M.Unit</td>
								</tr>

								<tr>
									<td>GAZETTED OFFICERS CELL&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DRBT</td>
								</tr>
								<tr>
									<td>MODERNISATION&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>Photo Section</td>
								</tr>

								<tr>
									<td>GL-I&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>ACCOUNTS PENSION</td>
								</tr>
								<tr>
									<td>GL-II&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>ATS</td>
								</tr>

								<tr>
									<td>BDDS&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>FPB</td>
								</tr>
								<tr>
									<td>Rly & Hgy&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>RI Section</td>
								</tr>

								<tr>
									<td>Motor Transport Section&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>Motor Theft Section</td>
								</tr>

								<tr>
									<td>SCU&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>AHTU</td>
								</tr>

								<tr>
									<td>Homicide&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>CID CR</td>
								</tr>

								<tr>
									<td>QDEB&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DD Bankura</td>	
								</tr>

								<tr>
									<td>MPB Section&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DD Barasat</td>
								</tr>
								<tr>
									<td>SOG Section&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DD Barrackpur</td>
								</tr>
								<tr>
									<td>RO Section&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DD Birbhum</td>
								</tr>

								<tr>
									<td>RO Pension&nbsp;&nbsp;<sup class="new">NEW</sup></td>
									<td>DD Burdwan</td>
								</tr>

								
	
								<tr>
									<td>EOW Section</td>
									<td>DD Coochbehar</td>
						    	</tr>

								<tr>
									<td>Cyber Crime Cell</td>
									<td>DD Durgapur / Asansol</td>
						    	</tr>

								<tr>
									<td>C&F Section</td>
									<td>DD Diamond Harbour</td>
						    	</tr>

								<tr>
									<td>Narcotic Section</td>
									<td>DD Hooghly</td>
						    	</tr>

								<tr>
									<td>Reference Section</td>
									<td>DD Howrah</td>
						    	</tr>

								<tr>
									<td>Crime Section</td>
									<td>DD Jalpaiguri</td>
						    	</tr>

								<tr>
									<td>Despatch Section</td>
									<td>DD Malda</td>
						    	</tr>

								<tr>
									<td>Cyber Patrol Cell</td>
									<td>DD Murshidabad</td>
						    	</tr>

								
								
								
								<tr>
									<td></td>
									<td>DD Nadia</td>
								</tr>
								<tr>
									<td></td>
									<td>DD North Dinajpur</td>
								</tr>
								<tr>
									<td></td>
									<td>DD Purulia</td>
								</tr>
								
								
								<tr>
									<td></td>
									<td>DD Purba MDP</td>
								</tr>
								<tr>
									<td></td>
									<td>DD Paschim MDP</td>
								</tr>
								<tr>
									<td></td>
									<td>DD Salt Lake</td>
								</tr>
								<tr>
									<td></td>
									<td>DD Sadar (Alipore)</td>
								</tr>

								
								<tr>
									<td></td>
									<td>Lock UP</td>
								</tr>
								<tr>
									<td></td>
									<td>Tele-Comm</td>
								</tr>
								<tr>
									<td></td>
									<td>Control Room</td>
								</tr>
								<tr>
									<td></td>
									<td>Armourary Sec</td>
								</tr>
								
								
								<tr>
									<td></td>
									<td>Library Sec</td>
								</tr>
								<tr>
									<td></td>
									<td>Data Base Section</td>
								</tr>
								<tr>
									<td></td>
									<td>DDO</td>
								</tr>
								<tr>
									<td></td>
									<td>Finger Print Bureau</td>
								</tr>

								
								<tr>
									<td></td>
									<td>TRAIL MONITORING</td>
								</tr>
								<tr>
									<td></td>
									<td>ACCOUNTS PAYBILL</td>
								</tr>
								

								
								
								<tr>
									<td></td>
									<td>LEAVE SECTION</td>
								</tr>
								<tr>
									<td></td>
									<td>ACCOUNTS GPF</td>
								</tr>

								
								
								<tr>
									<td></td>
									<td>ACCOUNTS TA</td>
								</tr>
								<tr>
									<td></td>
									<td>ACCOUNTS MEDICAL</td>
								</tr>
								
								

			
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<!--<div class="row">
		
		<?php if($this->session->userdata('user_type')=="super_user"){?>                
			
					<?php if($move_pending[0]!=""){?>
						<div class="col-md-6" height="20" weight="20">
						<div class="panel panel-default">
							<div class="panel-heading">Sectionwise Pending Letters</div>
							<div class="panel-body">
								<div class="canvas-wrapper">
									<canvas class="chart" id="pie-chart2" ></canvas>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
			

					
			
		<?php }  ?>
</div>-->

			

<div class="row">
	<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Administrative File Status in CID- Indexed / Unindexed</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="doughnut-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">File Status in CID- In Almirah / In Circulation</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			
		</div><!--/.row-->
		
		  <input type="hidden" id="base_url" value="<?php echo base_url()?>">
</div>


				<script type="text/javascript">
				function getRandomColor() {
				    var letters = '0123456789ABCDEF';
				    var color = '#';
				    for (var i = 0; i < 6; i++ ) {
				        color += letters[Math.floor(Math.random() * 16)];
				    }
				    return color;
				}
				var doughnutData = [
					{
						value: <?php echo $ind_file;?>,
						color: '#5F6261',
						highlight: '#DFD42C',
						label: "Indexed Files"
					},
					{
						value: <?php echo $unInd_file;?>,
						color: '#B1371E',
						highlight: '#DFD42C',
						label: "Unindexed Files"
					},
					
	
				];
			var pieData = [
					{
						value: <?php echo $file_almira;?>,
						color:'#968fad',
						highlight: '#DFD42C',
						label: "File in Almirah"
					},
					{
						value: <?php echo $file_mov;?>,
						color: '#F49842',
						highlight: '#DFD42C',
						label: "File in Circulation"
					},
					
	
				];
				
			
			window.onload = function(){
				//getRandomColor();
				// var chart1 = document.getElementById("line-chart").getContext("2d");
				// window.myLine = new Chart(chart1).Line(lineChartData, {
				// 	responsive: true
				// });
				
				
				var chart6 = document.getElementById("doughnut-chart").getContext("2d");
				window.myDoughnut = new Chart(chart6).Doughnut(doughnutData, {animation:false,responsive : true
				});

				var chart4 = document.getElementById("pie-chart").getContext("2d");
				window.myPie = new Chart(chart4).Pie(pieData, {animation:false,responsive : true
				});
						
				

			};

			</script>


 <script type="text/javascript">

$(document).on('click', '.pending', function(){	

    var idd='#shpanel'+$(this).attr("id");
	//alert(idd);
      $('.shpanel').not($(idd)).slideUp(800);
		$(idd).slideToggle();
		
		 // $(idd).scrollTo($(idd).right,$(idd).bottom);
        //$('html,body').animate({scrollTop: $(this).offset().top}, 800); 
    
});

$(document).on('click', '.next_date', function(){
      var base_url=$("#base_url").val();
	  var nxt_dt=($("#nxt_dt"+$(this).attr("id")).val());
	 // alert(nxt_dt);
	  var act_name=($("#act_name").val());
     var id=$(this).attr("id");
     //alert(nxt_dt);
      var url=base_url+"Letter_inbox/letter_status_postpond/";
      $.ajax({url:url, 
           type:'post',
           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id,act_name:act_name,nxt_dt:nxt_dt},
           success: function(result){
			$('.shpanel').not($(idd)).slideUp(800);   
         $("#"+id).html(result);
    }});
     
  });


			$(document).on('click', '.status', function(){
			    //$(".status").click(function(){
			    	//alert("okk");
			      var base_url=$("#base_url").val();
			     var id=$(this).attr("id");
			     
			      var url=base_url+"Letter_inbox/letter_action_status/";
			      $.ajax({url:url, 
			           type:'post',
			           data:{ '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
			          // alert(result);
			           success: function(result){
			           	//alert(result);
			         $("#"+id).html(result);
			    }});
			     
			  });
			

			
			
			$(document).on('click', '.accept_status', function(){
			    //$(".accept_status").click(function(){
			 // alert("okk");
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
			  
				var pieData1 = [
				<?php foreach($rec_pending[0] as $k=>$val){ ?>
				<?php if(count($val) > 0){?>
                           {
                           	value: <?php echo $val[0]['count'];?>,
							color:getRandomColor(),
							highlight: getRandomColor(),
							label: "<?php echo  $rec_pending[1][$k]['sec_name'];?>"
						    
						    },
				<?php }else{ ?> 			
					      {
					      	value: 0,
							color:getRandomColor(),
							highlight: getRandomColor(),
							label: "<?php echo  $rec_pending[1][$k]['sec_name'];?>"
						  },
					<?php }} ?>
				       ];
			var pieData2 = [
				<?php foreach($move_pending[0] as $k=>$val){ ?>
				<?php if(count($val) > 0){?>
                           {
                           	value: <?php echo $val[0]['count'];?>,
							color:getRandomColor(),
							highlight: getRandomColor(),
							label: "<?php echo  $move_pending[1][$k]['sec_name'];?>"
						    
						    },
				<?php }else{ ?> 			
					      {
					      	value: 0,
							color:getRandomColor(),
							highlight: getRandomColor(),
							label: "<?php echo  $move_pending[1][$k]['sec_name'];?>"
						  },
					<?php }} ?>
				       ];


			</script>
			