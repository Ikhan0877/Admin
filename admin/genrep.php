<?php
include 'includes/session.php';
include 'includes/header.php';
include 'includes/nav-bar.php';

 include 'inserting/confiq.php';
 include 'inserting/classes.php';

$year = new Year();

if(isset($_GET['deptid'])){
    // $yearid = $_GET['yearid'];
    // $monthid = $_GET['monthid'];
    // $deptid = $_GET['deptid'];
    // $eventcount = $year->countEventsMonth($deptid,$yearid,$monthid);
	// $overall = $year->countOverallsMonth($deptid,$yearid,$monthid);
	// $reasource = $year->countReasourceDept($deptid);
    $sql = "select * from year";
    $result = mysqli_query($conn, $sql);
?>
<div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">GENERATE CONSOLIDATED REPORTS</p>
 </div>
 <div class="container mt-4">
    <div class="row">
    
        <div class="col-md-6">
        <form action="all.php">
            <div class="form-group">
                <label for="">From Year</label>
                <input type="hidden" name="deptid" value="<?= $_GET['deptid']?>">
                <select name="fromyear" id="" class="form-control">
                <?php if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {?>
                    <option value="<?= $row['year'] ?>"><?= $row['year'] ?></option>
                            <?php 
                            }}
                             ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">To Year</label>
                <select name="toyear" id="" class="form-control">
                <?php $sql = "select * from year";
    $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {?>
                    <option value="<?= $row['year'] ?>"><?= $row['year'] ?></option>
                            <?php }
                            }
                             ?>
                </select>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <label for="">From Month</label>
                <select name="frommonth" id="" class="form-control">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">To Month</label>
                <select name="tomonth" id="" class="form-control">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Event</label>
                <select name="event" id="" class="form-control">
                    <option value="all">All</option>
                    <option value="Interactive">Interactive</option>
                    <option value="constructive">Constructive</option>
                    <option value="experiential">experiential</option>
                    <option value="addoncourse">Add on Course</option>
                    <option value="fest">Intercollegiate fest</option>
                    <option value="research">Research Projects</option>
                    <option value="publication">Publication</option>
                    <option value="student">Student Achievements</option>
                    <option value="faculty">Faculty Achievements</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success mx-auto d-block w-50 mt-4">GENERATE REPORT</button>
            </form>
        </div>
        
    </div>
 </div>
<?php
}
else{
     echo "<div class='alert alert-warning'>Please select the department.</div>";
}
 ?>
 
