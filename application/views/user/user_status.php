			
		
		<div class="row">
			<div class="col-lg-12">
				<h2>User Status</h2>
				
			</div>
		</div><!--/.row-->		
		
		
					
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Active user</a></li>
							<li><a href="#tab2" data-toggle="tab" style="font-color:black">Inactive user</a></li>
							
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1">
								<h4>Active user</h4>
								
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

<tr>
                        <td>WSD1346</td>
                        <td>Soumen Sen</td>
                        <td>Sub-Inspector</td>
                        <td>Police Office</td>
                        <td>21.03.2015</td>
                        <td>Normal</td> 
                        <td>Active</td>
                      </tr>

                  	</tbody>
                  	</table>
</div>
</div>
</div>
								 
							</div>
							<div class="tab-pane fade" id="tab2">
								<h4>Inactive user</h4>
								<p>
								

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
                  	</tbody>
                  	</table>
</div>
</div>
</div>


							    </p>
							</div>
							
						</div>
					</div>
				</div><!--/.panel-->
			</div><!--/.col-->
			
			
			
		</div><!-- /.row -->
		
	</div><!--/.main-->

		
		
	
	
	

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
		
