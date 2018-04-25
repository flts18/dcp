<script src="<?php echo base_url(); ?>style/js/lumino.glyphs.js"></script>

	<style>
	.large {
    font-size: 20px;
}
	</style>
	
	<div class="col-lg-12  main">			
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->

<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $my_recive;?></div>
							<div class="text-muted" style="color:#CC0000"><b>Received Letters</b></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $my_sent ;?></div>
							<div class="text-muted" style="color:#0033CC"><b>Sent Letters</b></div>
						</div>
					</div>
				</div>
			</div>
			<?php if($this->session->userdata('user_type')=="super_user"){?>
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-red panel-widget">
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
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $total_user ;?></div>
							<div class="text-muted" style="color:#C67171"><b>Total Users</b></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-emerald panel-widget ">
					<div class="row no-padding"><a href="<?php echo base_url().'letter_inbox' ?>">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
						</div></a>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $active_user ;?></div>
							<div class="text-muted small" style="color:#CC0000"><b>Active User</b></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-2">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked clock"><use xlink:href="#stroked-clock"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="medium" style="color:#996600"><b><?php echo date("h:i:s a", strtotime($login_time ));?></b></div>
							<div class="text-muted"><div class="medium" style="color:#00C78C"><b>Login Time</b></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	
	<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Bar Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="bar-chart1"></canvas>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div> 
<script>
var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	
var barChartData = {
			labels : ["1","February","March","April","May","June","July"],
			datasets : [
				 {
				 	fillColor : "rgba(220,220,220,0.5)",
				 	strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
				 	data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				 },
				{
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 0.8)",
					highlightFill : "rgba(48, 164, 255, 0.75)",
					highlightStroke : "rgba(48, 164, 255, 1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]
	
		}

window.onload = function(){
	//getRandomColor();
	// var chart1 = document.getElementById("line-chart").getContext("2d");
	// window.myLine = new Chart(chart1).Line(lineChartData, {
	// 	responsive: true
	// });
	

	var chart6 = document.getElementById("bar-chart1").getContext("2d");
	window.myBar = new Chart(chart6).Bar(barChartData, {
		responsive : true
	});

	// var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	// window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	// });
	var chart4 = document.getElementById("pie-chart1").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData1, {responsive : true
	});
	
	var chart5 = document.getElementById("pie-chart2").getContext("2d");
	window.myPie = new Chart(chart5).Pie(pieData2, {responsive : true
	});
	


};
		</script>
		