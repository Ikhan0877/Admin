<?php 
include 'includes/session.php';
if($_SESSION['role'] == 'Admin'){
include 'includes/header.php';
include 'includes/nav-bar.php';
}
else
{
include 'includes/header.php';
include 'includes/nav-bar-staff-student.php';
} 
include 'inserting/confiq.php';
include_once 'inserting/classes.php';

$year = new Year();


	$sql = "SELECT yearid,year,status FROM year ";
	$result = mysqli_query($conn, $sql);
	if(isset($_GET['deptid'])){

		$deptid = $_GET['deptid'];
		$eventcount = $year->countEventsDept($deptid);
		$overall = $year->countOverallsDept($deptid);
		$reasource = $year->countReasourceDept($deptid);
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
							<label style="color:white;">TOTAL REASOURCE </label>
							<span class="d-block bg-white" style="color:black;">
								<?= $reasource ?>
							</span>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="container bg-light p-1">
				<a href="admin-home.php" class="bg-light p-1" style="text-decoration: none; color: black">Home</a>
			</div>

			<div class="container p-3">
				<div class="row">
				<?php if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {?>
					<div class="col-md-6">
						<div class="row mt-1">
						
							<div class="col-md-6 p-0 text-center">
								<div class="card m-0">
									<div class="card-body">
										<h4 class="text-primary mb-5"><?php echo $row['year'] ?></h4>
										<a class="btn btn-success " style="" href="admin-month.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; ?>&amp;yearid=<?php echo $yearid = $row['yearid']?>">View/Add Report </a>
									</div>
									<?php if($_SESSION['role'] == 'Student'){
										?>
										<div class="card-footer p-2 bg-primary" style="height: 50px;">
										</div>
									<?php

									}else
									{?>
			
									<div class="card-footer p-2 bg-primary" style="height: 50px;">
										<a href="" style="color: white; text-decoration: none;">Generate Report</a>
										
									</div>
								<?php }?>

								</div>
								
								
							</div>
							
							<div class="col-md-6 p-0">
								<div class="card m-0">
									<div class="card-header">
										<h5 class="text-primary"><?php echo $row['year'];
										$eventcount = $year->countEventsYear($deptid,$yearid);
										$overall = $year->countOverallsYear($deptid,$yearid);
										$reasource = $year->countReasourceDept($deptid); ?> status</h5>
									</div>
									<div class="card-body">
										<button class="btn btn-primary form-rounded " style="font-size: 10px; margin-bottom: 5px;"> Totak Events <?= $eventcount ?></button><br>
										<button class="btn form-rounded" style="font-size: 10px; margin-bottom: 5px; background-color: #E606FF; color: white;"> Totak Resource person <?= $reasource ?></button><br>
										<button class="btn btn-primary form-rounded" style="font-size: 10px; margin-bottom: 5px;"> Totak Overalls <?= $overall ?></button>
									</div>
								</div>	
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