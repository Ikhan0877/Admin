<?php 
include '../includes/session.php';
include 'classes.php';
include 'confiq.php';
$year = new Year();

if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid']))
{
      $deptid=test_input($_GET['deptid']);
      $yearid=test_input($_GET['yearid']);
     $monthid=test_input($_GET['monthid']);
     $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum=$year->displayMonthNum($monthid,$yearid);
    //  $sql1= "select * from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid'";
    //  $result = mysqli_query($conn, $sql1);
 }
 if(isset($_POST['add']))
 {
    $deptid=test_input($_POST['deptid']);
    $yearid=test_input($_POST['yearid']);
    $monthid=test_input($_POST['monthid']);
    $noofdays = test_input($_POST['noofdays']);
    $from = test_input($_POST['fdateday']).'-'.test_input($_POST['fdatemonth']).'-'.test_input($_POST['fdateyear']);
    $to = test_input($_POST['tdateday']).'-'.test_input($_POST['tdatemonth']).'-'.test_input($_POST['tdateyear']);
    $title = test_input($_POST['title']);
    $institude = test_input($_POST['institude']);
    $venue = test_input($_POST['venue']);
    $totalparticipants = test_input($_POST['totalparticipants']);
    $price = test_input($_POST['price']);
    $totalevents = test_input($_POST['totalevents']);
    if(empty($deptid)||empty($yearid)||empty($monthid)||empty($noofdays)||empty($from)||empty($to)||empty($title)||empty($institude)||empty($venue)||empty($totalparticipants)||empty($totalevents)){
        $error="<div class='alert alert-danger'>Some fields are missing</div>";
    }
    else{
                    // $userid= 7;
                    $verified = 0;
                    // $stmt1 = $conn->prepare("INSERT INTO fest (days,fromdate,todate,hostinstitude,venue,eventname,price,monthid,yearid,deptid,userid,verified) values (?,?,?,?,?,?,?,?,?,?,?,?)");
				  	// //$deptid =2;
					// $stmt1->bind_param("iissssssiiiii",$noofdays,$from,$to,$institude,$venue,$eventname,$price,$monthid,$yearid,$deptid,$userid,$verified);
                    // if($stmt1->execute()){
                    //     $programmeid = mysqli_insert_id($conn);
                    // }
                    // $stmt1->close();

                    $sql2="INSERT INTO fest (days,fromdate,todate,hostinstitude,venue,prize,monthid,yearid,deptid,userid,verified,title,totalevents,totalparticipants) values ('$noofdays','$from','$to','$institude','$venue','$price','$monthid','$yearid','$deptid','$userid','$verified','$title','$totalevents','$totalparticipants')";
				
					if (mysqli_query($conn, $sql2)) 
					{
						$festid = mysqli_insert_id($conn);
					
					} else 
					{
						echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
					}
    
    for($i=1;$i<=$totalevents;$i++)
    {
        // $totalevents.$i = test_input($_POST['']);
        $eventname = $_POST["eventname$i"];
        $eventparticipant=$_POST["eventparticipant$i"];
        $eventprice=$_POST["eventprice$i"];
        $sql2="INSERT INTO festdet (festid,eventname,participantsname,position) values ('$festid','$eventname','$eventparticipant','$eventprice')";
				
        if (mysqli_query($conn, $sql2)) 
        {
             $i;
           
        } else 
        {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }
    }
    header("Location:../intercollfest.php?deptid=$deptid&yearid=$yearid&monthid=$monthid");
 }
}

 ?>
<?php include '../includes/header.php';
include '../includes/nav-bar.php';
?>
 <div class="container mb-4  text-center text-primary text-uppercase mt-4">
    <h2>Inter Collegiate Fest</h2>
 </div>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    if(isset($error)){
        echo $error;
    }
?>
 <div class="row">
    <div class="col-md-6">
        <label for="" class="" >No.of.Days</label>
        <input type="text" class="form-control" name="noofdays" required />
        <input type="hidden" name="deptid" value="<?= $deptid?>">
        <input type="hidden" name="yearid" value="<?= $yearid?>">
        <input type="hidden" name="monthid" value="<?= $monthid?>">
    </div>
    <div class="col-md-6">
        <label for="" class="" >from</label>

        <div class="input-group">
																<select name="fdateday" id="" class="form-control">
																	<?php 
																		for($i=1;$i<=31;$i++){
																			echo "<option value='$i'>$i</option>";
																		}
																	?>
																</select>
																<input type="text" name="fdatemonth" id="" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
																<input type="text" name="fdateyear" id="" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
															</div>
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >To</label>
        <div class="input-group">
																<select name="tdateday" id="" class="form-control">
																	<?php 
																		for($i=1;$i<=31;$i++){
																			echo "<option value='$i'>$i</option>";
																		}
																	?>
																</select>
																<input type="text" name="tdatemonth" id="" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
																<input type="text" name="tdateyear" id="" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
															</div>
        <!-- <input type="date" class="form-control" name="to" required /> -->
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >Title</label>
        <input type="text" class="form-control" name="title" required />
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >Host Instittude</label>
        <input type="text" class="form-control" name="institude" required />
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >Venue</label>
        <input type="text" class="form-control" name="venue" required />
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >Total Participants</label>
        <input type="text" class="form-control" name="totalparticipants" required />
    </div>
    
    <div class="col-md-6 mt-2">
        <label for="" class="" >Prize <span class="badge badge-pill badge-primary border border-light">i</span></label>
        <select name="price" class="form-control" id="">
            <option value="Winners">Winners</option>
            <option value="Runners">Runners</option>
            <option value="Second-Runners">Second Runners</option>
        </select>
        <!-- <input type="text" class="form-control" name="price" required /> -->
    </div>
    <div class="col-md-6 mt-2">
        <label for="" class="" >Total Events</label>
        <input type="text" class="form-control" id="totalevents" name="totalevents" required />
    </div>
 </div>
 <div class="container mt-5">
    <div class="row" id="eventdetails">

    </div>
 </div>
 <div class="container mt-5 mb-5">
    <input type="submit" name="add" value="Add" class=" float-left btn btn-primary w-50">
    <a href="../intercollfest.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>" class="btn btn-danger float-left  w-50 mx-auto">Cancel</a>
 </div>
 </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#totalevents").keyup(function(){
              $totalevents = $('#totalevents').val();
              if($totalevents==''){
                $("#eventdetails").html('');
              }
              for($i=1;$i<=$totalevents;$i++)
              {
                  $eventname = "eventname"+$i;
                  $eventparticipant = "eventparticipant"+$i;
                  $eventprice = "eventprice"+$i; 
                  $template = " <div class='col-md-4'><label for='' class='' >"+$i+" Event Name</label ><input type='text' name='"+$eventname+"' class='form-control' id='' required />  </div> ";
                  $template += " <div class='col-md-4'><label for='' class='' >participants Name<span title='ex: Studentname - V MCA or Studentname -V MCA, Studentname -V MCA' class='badge badge-pill badge-primary border border-light info'>i</span></label ><textarea  name='"+$eventparticipant+"' class='form-control' required ></textarea> </div>";
                  $template += " <div class='col-md-4'><label for='' class='' >Price</label ><input type='text'  name='"+$eventprice+"' class='form-control' id='' required />  </div> ";
                $("#eventdetails").append($template);
              }
        });
    });
</script>
<?php include '../includes/footer.php';?>
