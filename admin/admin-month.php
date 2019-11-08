<?php 
include 'includes/header.php';
include 'includes/nav-bar.php';
include 'inserting/confiq.php';
include 'inserting/classes.php';

$year = new Year();

if(isset($_GET['yearid'])&&isset($_GET['deptid'])){
	$yearid = $_GET['yearid'];
	$deptid=$_GET['deptid'];
	$eventcount = $year->countEventsYear($deptid,$yearid);
	$overall = $year->countOverallsYear($deptid,$yearid);
	$reasource = $year->countReasourceDept($deptid);
	$sql = "SELECT yearid,monthid, monthname FROM month where yearid = $yearid";
	$result = mysqli_query($conn, $sql);

	$yearnames = mysqli_query($conn, "SELECT * FROM year where yearid = $yearid");
	if (mysqli_num_rows($yearnames) > 0) {
		// output data of each row
		while($yearname = mysqli_fetch_assoc($yearnames)) {
			$year=$yearname['year'];
		}

}
}
if(isset($_GET['deptid'])){
	$deptid = $_GET['deptid'];
	$departments = "SELECT * FROM department where deptId = $deptid";
	$department = mysqli_query($conn, $departments);
	if (mysqli_num_rows($department) > 0) {
		// output data of each row
		while($deptrow = mysqli_fetch_assoc($department)) {
			$deptname=$deptrow['deptname'];
			$deptgad=$deptrow['graduation'];
			$deptclass=$deptrow['Class'];
		}
	} else {
		echo "0 results";
	}

}	
?>
			<h3 class="text-center text-primary mt-2"> <?= $deptname?> [<?= $deptgad ?>]</h3>
			<h2 class="text-center text-primary mt-2"><?= $deptclass ?></h2>
			<div class="container bg-light p-1">
				<p style="">Overall Details</p>
			</div>
			<div class="container mt-4 mb-4">
				<div class="row">
				<div class="col-md-4 text-center">
					<div class="card bg-primary">
						<div class="card-body">
							<label style="color:white;">TOTAL EVENTS </label>
							<span class="d-block bg-white" style="color:black;">
								<?= $eventcount ?>
							</span>
						</div>
					</div>
					
				</div>
				<div class="col-md-4 text-center">
					<div class="card" style="background-color: #E606FF">
						<div class="card-body">
							<label style="color:white;">TOTAL OVERALLS </label>
							<span class="d-block bg-white" style="color:black;">
								<?= $overall ?>
							</span>
						</div>
					</div>	
				</div>
				<div class="col-md-4 text-center">
					<div class="card bg-primary">
						<div class="card-body">
							<label style="color:white;">TOTAL RESOURCE </label>
							<span class="d-block bg-white" style="color:black;">
								<?= $reasource ?>
							</span>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="container bg-light p-1">
				<a href="admin-home.php" class="bg-light p-1" style="text-decoration: none; ">Home</a> &gt;
				<a href="admin-year.php?deptid=<?= $deptid ?>">Year <?= $year ?></a>
				<a href="admin-year.php?deptid=<?= $deptid ?>" class="bg-light p-0" style="text-decoration: none; color:#0D365A; float: right; margin-left: 10px;"  ><span>&lt;BACK</span></a>
		</div><br>
		<div class="container p-3 bg-light">
			<div class="bg-white text-center" style="width: 40%; margin-left: 300px;">
					<label style="font-size: 13PX; color: blue;">SELECT THE MONTHTO ADD/VIEW THE MONTHLY AND INDIVDUAL REPORT</label>
			</div>
			<div class="row text-center">
			<?php if (mysqli_num_rows($result) > 0) {
    			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) {?>

				
				<div class="col-md-3 p-5">
					<div class="card m-0">
						<div class="card-body">

							<h4 class="text-primary"><?php echo $row['monthname'] ?></h4><br>
							<a class="anchor_design btn btn-success" style="text-decoration: none; color: black;" href="list-event-details.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?= $row['monthid']?>">View/Add Report </a><br><br>
							<!-- <h4 class="text-primary"><?php echo $row['monthname'] ?> </h4><br>
							<a class="anchor_design btn btn-success" style="text-decoration: none; color: black;" href="list-event-details.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>">View/Add Report </a><br><br> -->

						</div>
						<div class="card-footer p-2 bg-primary" style="height: 50px;">
							<a href="text1.php?monthid=<?= $row['monthid']?>&amp;yearid=<?=$_GET['yearid']?>&amp;deptid=<?= $_GET['deptid'] ?>" style="color: white; text-decoration: none;">Generate Report</a>
										
						</div>

					</div>
				</div>
				<?php		
				}
			}?>
			</div>
		</div>

		
	</body>
</html>