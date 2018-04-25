<div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Userwise Activity/ Inactivity Summary
		</div>
		<div class="panel-body dasboard_tab_act_inct">
			<ul class="nav nav-tabs" style="background-color: rgba(1, 7, 12, 0.04);">
				<li class="active">
					<a data-toggle="tab" href="#active_summary">Active User</a>
				</li>
				<li>
					<a data-toggle="tab" href="#inactive_summary">Inactive User</a>
				</li>
			</ul>
			
			<style>
			.dasboard_tab_act_inct > ul > li > a { color: #111; }
			.dasboard_tab_act_inct > ul > li > a:hover, a:focus { color: #fff; }
			.dasboard_tab_th_wk > ul > li > a { color: #111; }
			.dasboard_tab_th_wk > ul > li > a:hover, a:focus { color: #fff; }
			</style>
			<div class="tab-content">
			  <div id="active_summary" class="tab-pane fade in active dasboard_tab_th_wk">
					<ul class="nav nav-tabs" style="background-color: rgba(7, 84, 20, 0.11);">
						<li class="active"><a data-toggle="tab" href="#today">Today</a></li>
						<li><a data-toggle="tab" href="#this_week">Last 7 days</a></li>
						<li><a data-toggle="tab" href="#this_month">Last 30 days</a></li>
					</ul>
					<div class="tab-content">
						<div id="today" class="tab-pane fade in active">
							<?php //if(isset($activeRecords['todayResults'])) { ?>
							
								<div class="row">
								
									<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
									<label class="control-label">Files</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['todayResults']['files']) 
												&& count($activeRecords['todayResults']['files'])) { ?>
											<?php foreach($activeRecords['todayResults']['files'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="2">
													<span style="color: red;">None of user(s) worked on file.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
										<label class="control-label">Letters</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['todayResults']['letters']) 
												&& count($activeRecords['todayResults']['letters'])) { ?>
											<?php foreach($activeRecords['todayResults']['letters'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="2">
													<span style="color: red;">None of user(s) worked on letter.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
									<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
										<label class="control-label">POI Added</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['todayResults']['poi']) 
												&& count($activeRecords['todayResults']['poi'])) { ?>
											<?php foreach($activeRecords['todayResults']['poi'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="2">
													<span style="color: red;">None of user(s) added POI.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
								</div>
							
							<?php //} ?>
						</div>
						<div id="this_week" class="tab-pane fade">
							<?php //if(isset($activeRecords['sevenDaysResults'])) { ?>
							
								<div class="row">
								
									<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
									<label class="control-label">Files</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['sevenDaysResults']['files']) 
												&& count($activeRecords['sevenDaysResults']['files'])) { ?>
											<?php foreach($activeRecords['sevenDaysResults']['files'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) worked on file.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
										<label class="control-label">Letters</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['sevenDaysResults']['letters']) 
												&& count($activeRecords['sevenDaysResults']['letters'])) { ?>
											<?php foreach($activeRecords['sevenDaysResults']['letters'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) worked on letter.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
									<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
										<label class="control-label">POI</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['sevenDaysResults']['poi']) 
												&& count($activeRecords['sevenDaysResults']['poi'])) { ?>
											<?php foreach($activeRecords['sevenDaysResults']['poi'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) added POI.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
								</div>
							
							<?php //} ?>
						</div>
						<div id="this_month" class="tab-pane fade">
							<?php //if(isset($activeRecords['lastMonthResults'])) { ?>
							
								<div class="row">
								
									<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
									<label class="control-label">Files</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['lastMonthResults']['files']) 
												&& count($activeRecords['lastMonthResults']['files'])) { ?>
											<?php foreach($activeRecords['lastMonthResults']['files'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) worked on file.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
										<label class="control-label">Letters</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['lastMonthResults']['letters']) 
												&& count($activeRecords['lastMonthResults']['letters'])) { ?>
											<?php foreach($activeRecords['lastMonthResults']['letters'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) worked on letter.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
									<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
										<label class="control-label">POI</label>
									<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
										<div class="table-responsive">
										<table class="table table-actions-bar">
											<thead>
												<tr>
													<th>Users</th>
													<th>Total working files</th>
													<th>Last working date</th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($activeRecords['lastMonthResults']['poi']) 
												&& count($activeRecords['lastMonthResults']['poi'])) { ?>
											<?php foreach($activeRecords['lastMonthResults']['poi'] as $record) { ?>
												<tr>
													<td><?php echo $record['name']; ?></td>
													<td><?php echo $record['totalFiles']; ?></td>
													<td><?php echo date('d/m/Y',strtotime($record['lastdate'])); ?></td>
												</tr>
											<?php } } else {?>
											<tr>
												<td colspan="3">
													<span style="color: red;">None of user(s) added POI.</span>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
										</div>
										</div>
									</div>
								
								</div>
							
							<?php //} ?>
						</div>
					</div>
				</div>
				<div id="inactive_summary" class="tab-pane fade dasboard_tab_th_wk">
					<ul class="nav nav-tabs" style="background-color: rgba(7, 84, 20, 0.11);">
						<li class="active"><a data-toggle="tab" href="#inac_today">Today</a></li>
						<li><a data-toggle="tab" href="#inac_this_week">Last 7 days</a></li>
						<li><a data-toggle="tab" href="#inac_this_month">Last 30 days</a></li>
					</ul>
					<div class="tab-content">
					<div id="inac_today" class="tab-pane fade in active">
						<?php if(isset($inactiveRecords['todayResults'])) { ?>
							<div class="row">
							
								<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
								<label class="control-label">Files</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['todayResults']['files']) 
											&& count($inactiveRecords['todayResults']['files'])) { ?>
										<?php foreach($inactiveRecords['todayResults']['files'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } else {?>
											<tr>
												<td colspan="1">
													<span style="color: green;">Congrats! all users are working.</span>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
									<label class="control-label">Letters</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['todayResults']['letters']) 
											&& count($inactiveRecords['todayResults']['letters'])) { ?>
										<?php foreach($inactiveRecords['todayResults']['letters'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } else {?>
											<tr>
												<td colspan="1">
													<span style="color: green;">Congrats! all users are working.</span>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
								<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
									<label class="control-label">POI</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['todayResults']['poi']) 
											&& count($inactiveRecords['todayResults']['poi'])) { ?>
										<?php foreach($inactiveRecords['todayResults']['poi'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } else {?>
											<tr>
												<td colspan="1">
													<span style="color: green;">Congrats! all users are working.</span>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
							</div>
						
						<?php } ?>
					</div>
					<div id="inac_this_week" class="tab-pane fade">
						<?php if(isset($inactiveRecords['sevenDaysResults'])) { ?>
							<div class="row">
							
								<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
								<label class="control-label">Files</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['sevenDaysResults']['files']) 
											&& count($inactiveRecords['sevenDaysResults']['files'])) { ?>
										<?php foreach($inactiveRecords['sevenDaysResults']['files'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
									<label class="control-label">Letters</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['sevenDaysResults']['letters']) 
											&& count($inactiveRecords['sevenDaysResults']['letters'])) { ?>
										<?php foreach($inactiveRecords['sevenDaysResults']['letters'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
								<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
									<label class="control-label">POI</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['sevenDaysResults']['poi']) 
											&& count($inactiveRecords['sevenDaysResults']['poi'])) { ?>
										<?php foreach($inactiveRecords['sevenDaysResults']['poi'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
							</div>
						
						<?php } ?>
					</div>
					<div id="inac_this_month" class="tab-pane fade">
						<?php if(isset($inactiveRecords['lastMonthResults'])) { ?>
							<div class="row">
							
								<div class="col-xs-12 col-sm-4" style="background-color:lavender;">
								<label class="control-label">Files</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['lastMonthResults']['files']) 
											&& count($inactiveRecords['lastMonthResults']['files'])) { ?>
										<?php foreach($inactiveRecords['lastMonthResults']['files'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4" style="background-color:lavenderblush;">
									<label class="control-label">Letters</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['lastMonthResults']['letters']) 
											&& count($inactiveRecords['lastMonthResults']['letters'])) { ?>
										<?php foreach($inactiveRecords['lastMonthResults']['letters'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
								<div class="col-xs-12 col-sm-4" style="background-color:lightcyan;">
									<label class="control-label">POI</label>
								<div style="margin-bottom:40px;max-height:315px;overflow-y:scroll;overflow-x:hidden;">
									<div class="table-responsive">
									<table class="table table-actions-bar">
										<thead>
											<tr>
												<th>Users</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($inactiveRecords['lastMonthResults']['poi']) 
											&& count($inactiveRecords['lastMonthResults']['poi'])) { ?>
										<?php foreach($inactiveRecords['lastMonthResults']['poi'] as $record) { ?>
											<tr>
												<td><?php echo $record; ?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
									</div>
								</div>
							
							</div>
						
						<?php } ?>
					</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>