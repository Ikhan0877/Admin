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

    if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid'])){
         $deptid=test_input($_GET['deptid']);
         $yearid=test_input($_GET['yearid']);
        $monthid=test_input($_GET['monthid']);
        $prgmtype=test_input($_GET['typeofprogramme']);

        $year = new Year();
        $yearname = $year->displayYear($yearid);
        $monthname = $year->displayMonth($monthid,$yearid);
        $monthnum=$year->displayMonthNum($monthid,$yearid);
        $sql1= "select * from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme = '$prgmtype'";
        $result = mysqli_query($conn, $sql1);
    }
    
					
 ?>
  <div class="container mt-4">
    <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Note!</strong> Click on the report to download the event report. <br>
  
    </div>
 </div>
<div class="container mt-4 ">
     <div class="row">
        <div class="col-md-6">
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR 2019</a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>" class="text-info bg-light p-2"> MONTH JANUARY</a> &gt; <a href="" class="text-info bg-light p-2">Experiential PROGRAMME</a>
        </div>
        <div class="col-md-6">
            <a href="list-event-details.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>&amp;monthid=<?= $monthid ?>" class="bg-dark text-light p-2 d-block ml-auto w-25" > << GO BACK</a>
        </div>
     </div>
 </div>
 <section class="container-fluid mt-5">
    <div class="row">
        <!-- PROGRAMME STATS -->
            <div class="col-md-3">
            <?php include 'programmestat.php' ?>
            </div>
        </div>
    
        <!-- Programme Details -->
        <div class="col-md-9">
            <div class="container">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Note!</strong> Sorry Editing Event image is not possible kindly delete the Event and add as a new Event <br>
            </div>
            </div>
            <div class="container">
                    <div class="card">
                        <div class="card-header">
                             <h6>Experiential Programme</h6>
                        </div>
                        <div class="card-body p-0 " style="overflow-x:scroll;">
                            <table class="table table-bordered  table-striped p-0 m-0">
                                <tr class="table-info">
                                    <td>Date</td>
                                    <td>Title</td>
                                    <td>Verified</td>
                                    <td>Resource person</td>
                                    <td>Type of Event</td>
                                    <td class="p-0 text-center pt-2">Total Paricipants
                                        <table class="table mb-0 table-light mt-2">
                                            <tr>
                                                <td>Internal</td>
                                                <td>External</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>Operations</td>
                                    <td>User</td>
                                </tr>
                                   
                                    <?php if (mysqli_num_rows($result) > 0) 
                                                                    {
                                            // output data of each row
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr class="">
                                                        <td><?= $row['fromdate'] ?></td>
                                                        <td><b> <?= $row['natureofevent'] ?></b> <br>
                                                       <q><?= $row['title'] ?></q>
                                                        </td>
                                                        <td><?php if($row['verified']==0){
                                                            echo '<span class=" badge-pill badge-danger">NOT VERFIED</span> <button value="'.$row['prgmid'].'" class="badge-pill bg-success border-0 verify">Verify </button>';
                                                        }else{
                                                            echo '<span class=" badge-pill badge-success">VERFIED</span> <button value="'.$row['prgmid'].'" class="badge-pill bg-danger border-0 verify">Un Verify </button>';
                                                        } ?>
                                                        
                                                        </td>
                                                        <td><?php $id = $row['resourcepersonid'];
                                                            $res_det= "select * from reasource where resourcepersonid = '$id' ";
                                                            $res_det_result = mysqli_query($conn, $res_det);
                                                            if (mysqli_num_rows($res_det_result) > 0) {
                                                                    while($res = mysqli_fetch_assoc($res_det_result)) 
                                                                    {
                                                                        echo $res['name'];
                                                                        echo "<br>".$res['details'];
                                                                    }
                                                                }
                                                        ?></td>
                                                        <td>
                                                                <?= $row['natureofevent'] ?>
                                                        </td>
                                                        <td class="p-0 text-center pt-2 bg-info text-light"> <?= $row['Internalcount']+$row['externalcount'] ?>
                                                            <table class="table mb-0 table-light mt-2">
                                                                <tr>
                                                                    <td><?= $row['Internalcount'] ?></td>
                                                                    <td><?= $row['externalcount'] ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td><div class="btn-group"><a href="inserting/otherprogramme.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;programme=experiential&amp;programmedid=<?= $row['prgmid'] ?>" class="btn btn-sm btn-primary">Edit</a> <button class="btn btn-sm btn-danger delete" value="<?= $row['prgmid'] ?>" > Delete</button> <a href="" class="btn btn-sm btn-success">Report</a> 
                                                             <a href="inserting/viewprogramme.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;programme=experiential&amp;programmedid=<?= $row['prgmid'] ?>" class="btn btn-sm btn-warning">View</a></div></td>
                                                        <td>User</td>
                                                        </tr>
                                                        
                                                <?php
                                                }
                                            } 
                                            else 
                                            {
                                                echo "<tr>0 results</tr>";
                                            }
                                    ?>
                            </table>
                        </div>
                        <div class="card-footer p-0 bg-primary" >
                            <a class="btn d-block w-100 mx-auto text-white" href="inserting/otherprogramme.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;programme=experiential">ADD</a>
                            
                        </div>
                        <!-- -->

                    </div>
                </div>
        </div>
    </div>

    
 </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script>
    $(document).ready(function(){
        
		$(document).on('click','.delete',function(){
            var r = confirm("Are you sure!!! you want to delete???");
            if (r == true) {
                $id=$(this).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/programme.php",
                    data: {
                        id: $id,
                        del: 1,
                    },
                    success: function(){
                        alert("Deleted the year");
                        location.reload();
                    }
                });
            } 

            });

        $(document).on('click','.verify',function(){
            var r = confirm("Are you sure!!! you want to Update???");
            if (r == true) {
                $id=$(this).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/programme.php",
                    data: {
                        id: $id,
                        verify: 1,
                    },
                    success: function(){
                        alert("Success");
                        location.reload();
                    }
                });
            }
        })
        });
 </script>
 
 <?php include 'includes/footer.php' ?>