<?php 
include 'includes/session.php';
include 'inserting/confiq.php';
include 'inserting/classes.php';

if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid'])){
      $deptid=test_input($_GET['deptid']);
      $yearid=test_input($_GET['yearid']);
     $monthid=test_input($_GET['monthid']);
    
    $year = new Year();
    $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum=$year->displayMonthNum($monthid,$yearid);
    
     $sql1= "select * from fest where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid'";
     $result = mysqli_query($conn, $sql1);

     if(isset($_GET['deleteid']))
     {
                    $deleteid = $_GET['deleteid'];
                    $sql1="delete from `festdet` where festid='$deleteid'";
                    mysqli_query($conn,$sql1);
                    $sql1= "DELETE FROM `fest` WHERE festid='$deleteid'";
                    $result = mysqli_query($conn, $sql1);
                    header("Location:intercollfest.php?deptid=$deptid&yearid=$yearid&monthid=$monthid"); 
     }

 }?>
 <?php
include 'includes/header.php';
include 'includes/nav-bar.php';
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
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR <?= $yearname ?></a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>" class="text-info bg-light p-2"> MONTH <?= $monthname ?></a> &gt; <a href="" class="text-info bg-light p-2">INTERCOLLEGIATE FEST</a>
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
                
            </div>
            <div class="container">
                    <div class="card ">
                        <div class="card-header">
                             <h6>Intercollegiate Fest</h6>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-bordered  table-striped p-0 m-0">
                                    <tr class="table-info">
                                        <td>Date</td>
                                        <td>Title of fest</td>
                                        <td>Host Institude/venue</td>
                                        <td>Name of competition</td>
                                        <td class="p-0 text-center pt-2 text-lowercase">No of participants
                                        </td>
                                        <td>prices won</td>
                                    
                                        <td>Total no.of.participants</td>
                                        <td>Overall Position</td>
                                        <td>Operations</td>
                                        <td>User</td>
                                    </tr>
                                    <?php if (mysqli_num_rows($result) > 0) 
                                                                    {
                                            // output data of each row
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                    <tr >
                                        <td><?= $row['fromdate'] ?></td>
                                        <td><?= $row['title']?></td>
                                        <td><b> <?= $row['hostinstitude'] ?></b>,<?= $row['venue'] ?><span class="badge badge-danger">Unverified</span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?=$row['prize'] ?></td>
                                        <td> <a href="intercollfest.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;deleteid=<?= $row['festid'] ?>" class="btn btn-danger d-block w-100 mx-auto">Delete</a> </td>
                                        <td><?= $row['userid']?></td>
                                    </tr>
                                    
                                        <?php 
                                                $festid=  $row['festid'];
                                            $sql2= "select * from festdet where festid = '$festid' ";
                                            $result2 = mysqli_query($conn, $sql2);
                                            if (mysqli_num_rows($result2) > 0) 
                                                                    {
                                            // output data of each row
                                                    while($row1 = mysqli_fetch_assoc($result2)) {
                                        ?>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> <?= $row1['eventname'] ?></td>
                                        <td class=" text-center ">
                                        <?= $row1['participantsname'] ?>
                                        </td>
                                        <td> <?= $row1['position'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>

                                                    <?php }
                                                    } ?>
                                       
                               
                                    </tr>
                                                    <?php }?>
                                    <?php }else{?>
                                        <td colspan="10">Norecords</td>
                                    <?php }?>
                            </table>
                        </div>
                        <div class="card-footer p-0 bg-primary">
                            <a href="inserting/insertfest.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>" class="btn d-block w-100 mx-auto">ADD</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
 </section>