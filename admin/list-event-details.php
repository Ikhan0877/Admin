<?php 
include 'includes/session.php';
include 'includes/header.php';
include 'includes/nav-bar.php';

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
    
    <div class="col-md-9">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-primary text-center font-weight-light">INTERACTIVE PROGRAMME</h2>
                    <p class="text-danger">*Please add event details which come undet this category!!</p>
                    <p class="text-info">CONFERENCE / SEMINAR / WORKSHOP / FDP / GUEST LECTURE / MDP / PANEL DISCUSSION </p>
                    
                </div>
                <div class="card-footer p-0">
                    <a class="btn btn-primary w-100 text-white" href="interactive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=Interactive">ADD / VIEW REPORT</a>
                </div> 
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card ">
                <div class="card-body">
                    <h2 class="text-primary text-center font-weight-light">CONSTRUCTIVE PROGRAMME</h2>
                    <p class="text-danger">*Please add event details which come undet this category!!</p>
                    <p class="text-info">ACADEMIC / CO-CURRICULAR ACTIVITIES / EXHIBITION / CLUB PROGRAMME </p>
                    <br/>
                </div>
                <div class="card-footer p-0">
                    <a class="btn btn-primary w-100 text-white" href="constructive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=constructive">ADD / VIEW REPORT</a>
                </div> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
                        <h3 class="text-primary text-center font-weight-light">EXPERIENTIAL LEARNING
                        PROGRAMME</h3>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info text-uppercase">(Details of Industrial Visits / Field visits /Internship / Project / any other Students’ Experiential Learning Activities organized): </p>
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="constructive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=experiential">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">add-on course's / 
                            training courses offered</h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">ACADEMIC / CO-CURRICULAR ACTIVITIES / EXHIBITION / CLUB PROGRAMME </p>
                        <br />
                        <br />
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="addoncourses.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=addoncourse">ADD / VIEW REPORT</a>
                    </div> 
                </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">STUDENT'S ACADEMIC
                                ACHIEVEMENT'S </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">PAPER PRESENTATION / POSTER PRESENTATION / BUSINESS PLAN / SOFTWARE DEV COMPLETION OF NET / OTHER ACHIEVEMENT'S </p>
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="acheivements.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $_GET['deptid'] ?>&amp;type=Student">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">FACULTY
                                ACHIEVEMENT'S <br> </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">PAPER PRESENTATION / OTHER ACHIEVEMENT'S  </p>
                        <br/>
                        <br/>
                        <br/>
                        <br />
                        <!-- <br/> -->
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="acheivements.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $_GET['deptid'] ?>&amp;type=Faculty">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">Intercollegiate fest <br> </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="intercollfest.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">Research <br> projects </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="researchproj.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $deptid ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body text-center">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">PUBLICATION'S BY FACULTY MEMBERS </h2>
                        <p class="text-danger">*Please add event details which come undet this category!! <br> Book published/Chapter published//Article publshed</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="publishment.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $deptid ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
    </div>
    </div>
    </div>
 </div>