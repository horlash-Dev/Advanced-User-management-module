<?php 
require 'admin-header.php'; 
session_start();
if (!isset($_SESSION['admin_connected'])) {
	header("location: ../index.php");
	exit();
}
 require_once '../../vendor/autoload.php';
 use admin\php\control as admincontrol;
$command= new admincontrol();
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for  Charts is loaded.
      google.charts.setOnLoadCallback(Genders);

      // Draw the pie chart for  Charts is loaded.
      google.charts.setOnLoadCallback(usersAuth);

      // Callback that draws the pie chart for gender
      function Genders() {

        // Create the data table for gender
        var data = new google.visualization.arrayToDataTable([
        	['gender', 'number'],
        	<?php $gender= $command->Gender(); 
				foreach ($gender as $key) {
    			 echo '["'.$key['gender'].'", '.$key['total'].'],';}?>
        ]);

        // Set options for gendr
        var options = {title:'users gender statictis',
                       width:400,
                       height:300,
                       is3D: true
                      };

        // Instantiate and draw the chart for gender
        var chart = new google.visualization.PieChart(document.getElementById('genderStat'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for verify
      function usersAuth() {

        // Create the data table for verify
        var data = new google.visualization.arrayToDataTable([
        	['verified', 'number'],
    	<?php $verification = $command->emailStatics(); 
    						foreach ($verification as $key) {
    							if ($key['verified'] != '1') {
    							 $key['verified'] = 'unverified';
    							}else{ $key['verified'] = "verified";}
    							echo '["'.$key['verified'].'",'.$key['total'].'],';}?>
     ]);
        // Set options for 
        var options = {title:'users verification statictis',
                       width:400,
                       height:300,
                       pieHole: 0.5};
        // Instantiate and draw the chart 
        var chart = new google.visualization.PieChart(document.getElementById('emailStat'));
        chart.draw(data, options);
      }
    </script>

 </head>
 <body>
 	
    <div class="container">
    	<div class="row m-2">
    	<div class="col-md-12">
    		
    			<div class="card-deck">
    				<div class="card text-center">
    					<h3 class="card-header">total user</h3>
    					<div class="card-body">
    						<h6><?= $command->adminData(); ?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">verified user</h3>
    					<div class="card-body">
    						<h6><?= $command->Verification(true);?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">unverify user</h3>
    					<div class="card-body">
    						<h6><?= $command->Verification(false);?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">total post</h3>
    					<div class="card-body">
    						<h6><?= $command->totalInfos('usertimeline'); ?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">total feedback</h3>
    					<div class="card-body">
    						<h6><?= $command->totalInfos('feedback'); ?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">total notifications</h3>
    					<div class="card-body">
    						<h6><?= $command->totalInfos('admin_notification'); ?></h6>
    					</div>
    				</div>
    			</div>

    				<div class="card-deck">
    				<div class="card text-center">
    					<h3 class="card-header">website hits</h3>
    					<div class="card-body">
    						<h6><?= $command->total_hits() ?></h6>
    					</div>
    				</div>
    				<div class="card text-center">
    					<h3 class="card-header">visitors hits</h3>
    					<div class="card-body">
    						<h6><?= $command->visitor(); ?></h6>
    					</div>
    				</div>
    			</div>

    		</div>
    	</div>

    	<div class="row m-3">
    		<div class="col-md-6">
    			<h4>users gender statictis</h4>
    			<div class="card">
    				<div class="card-body card-light">
    					 <div id="genderStat"></div>
    				</div>
    			</div>
    		</div>
    		<div class="col-md-6">
    			<h4>email statictis</h4>
    			<div class="card">
    				<div class="card-body card-light">
    					<div id="emailStat">
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

    </div>
	
 </body>
 </html>

<?php require 'admin-footer.php'; ?>

<?php
    					// $gender= $command->Gender(); 
    					// 	foreach ($gender as $key) {
    					// 		echo $key['gender'];
    					// 		echo $key['total'];
    					// 	}
    					// $data= [];
    					// while ($cn= $data) {
    					// 	echo $data['total'];
 //    					// }
 //    						?>
	 <?php 
 //$verification = $command->emailStatics(); 
 //    						foreach ($verification as $key) {
 //    							if ($key['verified'] !== '1') {
 //    							 $key['verified'] = 'unverified';
 //    							}else{ $key['verified'] = "verified";}
 //    							echo '['.$key['verified'].','.$key['total'].']';
 //    						}
    						?>