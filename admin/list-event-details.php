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
 include 'inserting/classes.php';

$year = new Year();

if(isset($_GET['yearid']) and isset($_GET['monthid']) and isset($_GET['deptid'])){
    $yearid = $_GET['yearid'];
    $monthid = $_GET['monthid'];
    $deptid = $_GET['deptid'];
    $eventcount = $year->countEventsMonth($deptid,$yearid,$monthid);
	$overall = $year->countOverallsMonth($deptid,$yearid,$monthid);
    $reasource = $year->countReasourceDept($deptid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $sql = "SELECT y.yearid, y.year, m.monthid, m.monthname FROM month m, year y where y.yearid = $yearid and m.monthid =  $monthid and m.yearid = y.yearid";
$result = mysqli_query($conn, $sql);

}
$row = mysqli_fetch_assoc($result);
?>
 <div class="container mt-4">
    <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Note!</strong> Your Viewing the Report of year <?php echo $row['year']; ?> and Month <?php echo $row['monthname']; ?>. <br>
    *click on the Generate report to download the report. <br>
    *click on the view overall report to view all the reports <br>
    </div>
 </div>
 <!-- overall monthly report -->
 <div class="container mt-4">
     <p class="text-info bg-light p-2">OVERALL MONTHLY REPORTS</p>
 </div>
 <div class="container">
     <div class="row">
        <div class="col-md-4 text-center">
            <div class="card text-white p-2 border-0" style="background-color:#4717F6;">Total Events <span class="bg-white text-dark mt-2" style="font-size:20px;"><?= $eventcount ?></span></div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card text-white p-2 border-0" style="background-color:#E606FF;">Total Resource person <span class="bg-white text-dark mt-2" style="font-size:20px;"><?= $reasource ?></span></div>
        </div>
        <div class="col-md-4 text-center">
        <div class="card text-white p-2 border-0" style="background-color:#177FF6;">Total Overall <span class="bg-white text-dark mt-2" style="font-size:20px;"><?= $overall ?></span></div>
        </div>
     </div>
 </div>
 <!-- Breadcrumps -->
 <div class="container mt-4 ">
     <div class="row">
        <div class="col-md-6">
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR <?php echo $row['year']; ?></a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>&amp;monthid=<?= $monthid ?>" class="text-info bg-light p-2"> MONTH <?php echo $row['monthname']; ?></a>
        </div>
        <div class="col-md-6">
            <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>&amp;monthid=<?= $monthid ?>" class="bg-dark text-light p-2 d-block ml-auto w-25" > << GO BACK</a>
        </div>
     </div>
 </div>
 
 <div class="container-fluid mt-4 mb-4">
 <div class="row">
 
    <div class="col-md-3">
        <?php include 'programmestat.php'; ?>
    </div>
    </div>
    
    <?php 
    if($_SESSION['role'] == 'Student'){
    
    include 'inserting/list_student.php';
    }else{
    include 'inserting/list_admin_staff.php';
    }?>
    </div>
 </div>