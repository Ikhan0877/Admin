<?php
// include '../../includes/session.php';
include_once '../confiq.php';
include_once '../classes.php';
session_start();
 $year = new Year();
if(isset($_POST['showstudent']))
{
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$deptid=$_POST['deptid'];
	$type=$_POST['type'];
	$sql1 = "SELECT * FROM `achievements` where  `yearid`='$yearid' and `monthid`='$monthid' and deptid='$deptid'  and `ach_type`='$type'";
    $result1 = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result1) > 0) {
		?>
	<tr class="table-info">
		<td>Date</td>
		<td>Name of Student</td>
		<td>Verified</td>
		<td>Title of the programme/venue</td>
		<td class="p-0 text-center pt-2 text-lowercase">TITLE OF THE PRESENTED /	PUBLISHED/ANYOTHER
		</td>
		<td>Operations</td>
		<td>User</td>
	</tr>
	<?php
	while($row = mysqli_fetch_assoc($result1)) {?>
	<tr >
	<td><?php echo $row['ach_from'] ?> to <?php echo $row['ach_to'] ?></h4></h4></td>
	<td><?php echo $row['participantname'] ?></h4></td>
	<td><?php
	if($row['verified']== "0"){?>
	<span class="badge badge-danger">Unverified</span><?php
	}else{?>
	<span class="badge badge-success">verified</span>
	<?php
	}?>

	<td><?php echo $row['ach_name'] ?></h4></td>
	<td class=" text-center "><?php echo $row['ach_info'] ?></h4>

	</td>
	<td> <?php

				 if($_SESSION['role'] == 'Student'){?>
		<div class="btn-group">
			<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editstudent<?php echo $row['achievementid']; ?>">
			<span class = "glyphicon glyphicon-pencil"></span> Edit</button> 
			<button class="btn btn-sm btn-danger Deletestudent" id="" value="<?= $row['achievementid']?>">Delete</button>
			

			
		</div>


									
<?php

   $result2=mysqli_query($conn,"SELECT * FROM `achievements` WHERE achievementid='".$row['achievementid']."'");
   $row1=mysqli_fetch_array($result2); {
    $yearid=$row1['yearid'];
	 $monthid=$row['monthid'];
	 $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum=$year->displayMonthNum($monthid,$yearid);
	 
?>
   <div class="modal fade mod" id="editstudent<?php echo $row['achievementid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-xl" id="edmodal" role="document" >
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">STUDENTS/ FACULTY ACHIVEMENTS</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
    
    <div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TOTAL NO.OF.DAYS</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control"  value="<?php echo $row1['ach_days'] ?>" id="uachtndays<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">FROM</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" id="uachfrom<?=$row['achievementid']; ?>"  value="<?= $row['ach_from']?>" readonly="readonly">
						<!-- <input type="date" min="<?php echo $my['year']; ?>-<?php echo $temp; ?>-01"  max="<?php echo $my['year']; ?>-<?php echo $temp; ?>-31" class="form-control" value="<?php echo $row1['ach_from'] ?>" name="uachfrom" id="achfrom"> -->

						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TO</label>
						</div>
						<div class="col-md-6 mt-4">
						
							<input type="text"  class="form-control" value="<?php echo $row1['ach_to'] ?>" name="uachto" id="uachto<?=$row['achievementid']; ?>" readonly="readonly">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">DURATION</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_days'] ?>" name="uachduration" id="uachduration<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">VENUE</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_venue'] ?>" name="uachvenue" id="uachvenue<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">PARTICIPANT NAME</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" name="uachpname" value="<?php echo $row1['participantname'] ?>" id="uachpname<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<input type="hidden" id="uachby<?=$row['achievementid']; ?>" value="<?= $type ?>">
				<!-- <div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<label class="form-label">ACHIEVMENT BY</label>
						</div>
						<div class="col-md-6 mt-2">
							<select name="uachby" class="form-control" id="uachby<?=$row['achievementid']; ?>">
								<option value="Student">Student</option>
								<option value="Faculty">Faculty</option>
							</select>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="container card-2 py-3 my-2 px-5">
			<h4 class="text-primary mb-4">ABOUT THE ACHIEVMENT</h4>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TITLE OF THE PROGRAM</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_name'] ?>" name="uachprogramtitle" id="uachprogramtitle<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TITLE OF PAPER ACHIEVMENT</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_info'] ?>" name="uachpapertitle" id="uachpapertitle<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">NATURE OF PARTICIPANT</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" name="uachparticipant" value="<?php echo $row1['natureofpart'] ?>" id="uachparticipant<?=$row['achievementid']; ?>">
							<input type="text" hidden class="form-control" value="<?php echo $row1['yearid']; ?>"  id="uyearid<?=$row['achievementid']; ?>">
							<input type="text" hidden class="form-control" value="<?php echo $row1['monthid']; ?>"  id="umonthid<?=$row['achievementid']; ?>">
							<input type="hidden"  id="udeptid<?=$row['achievementid']; ?>" value="<?= $row1['deptId']?>" >
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>

		<div class="container card-2 mb-5">
			<button type="button" class="btn mx-2 w-30 my-4 p-2" data-dismiss="modal" style="float: right;background-color: red; width: 10%; color: white;">CANCLE</button>
			<button type="submit" class="btn mx-2 w-30 my-4 updateacheiment" style="float: right;background-color: #26CFE9; width: 10%; color: white;" value="<?php echo $row1['achievementid'] ?>" >UPDATE</button>
			<button type="submit" class="btn mx-2 w-30 my-4" style="float: right;background-color: lightgreen; width: 10%; color: white;" value="<?php echo $row1['achievementid'] ?>" id="verifyacheiment">VERIFY</button>
		</div>
	</div>
	</div>
</div>
</div>
   
</div>
<?php
    }


}
else{?>
	<div class="btn-group">
			<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editstudent<?php echo $row['achievementid']; ?>">
			<span class = "glyphicon glyphicon-pencil"></span> Edit</button> 
			<button class="btn btn-sm btn-danger Deletestudent" id="" value="<?= $row['achievementid']?>">Delete</button>
			

			<a href="" class="btn btn-sm btn-success">Report</a>
		</div>


									
<?php

   $result2=mysqli_query($conn,"SELECT * FROM `achievements` WHERE achievementid='".$row['achievementid']."'");
   $row1=mysqli_fetch_array($result2); {
    $yearid=$row1['yearid'];
	 $monthid=$row['monthid'];
	 $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum=$year->displayMonthNum($monthid,$yearid);
	 
?>
   <div class="modal fade mod" id="editstudent<?php echo $row['achievementid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-xl" id="edmodal" role="document" >
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">STUDENTS/ FACULTY ACHIVEMENTS</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
    
    <div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TOTAL NO.OF.DAYS</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control"  value="<?php echo $row1['ach_days'] ?>" id="uachtndays<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">FROM</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" id="uachfrom<?=$row['achievementid']; ?>"  value="<?= $row['ach_from']?>" readonly="readonly">
						<!-- <input type="date" min="<?php echo $my['year']; ?>-<?php echo $temp; ?>-01"  max="<?php echo $my['year']; ?>-<?php echo $temp; ?>-31" class="form-control" value="<?php echo $row1['ach_from'] ?>" name="uachfrom" id="achfrom"> -->

						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TO</label>
						</div>
						<div class="col-md-6 mt-4">
						
							<input type="text"  class="form-control" value="<?php echo $row1['ach_to'] ?>" name="uachto" id="uachto<?=$row['achievementid']; ?>" readonly="readonly">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">DURATION</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_days'] ?>" name="uachduration" id="uachduration<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">VENUE</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_venue'] ?>" name="uachvenue" id="uachvenue<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">PARTICIPANT NAME</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" name="uachpname" value="<?php echo $row1['participantname'] ?>" id="uachpname<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<input type="hidden" id="uachby<?=$row['achievementid']; ?>" value="<?= $type ?>">
				<!-- <div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<label class="form-label">ACHIEVMENT BY</label>
						</div>
						<div class="col-md-6 mt-2">
							<select name="uachby" class="form-control" id="uachby<?=$row['achievementid']; ?>">
								<option value="Student">Student</option>
								<option value="Faculty">Faculty</option>
							</select>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="container card-2 py-3 my-2 px-5">
			<h4 class="text-primary mb-4">ABOUT THE ACHIEVMENT</h4>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TITLE OF THE PROGRAM</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_name'] ?>" name="uachprogramtitle" id="uachprogramtitle<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TITLE OF PAPER ACHIEVMENT</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['ach_info'] ?>" name="uachpapertitle" id="uachpapertitle<?=$row['achievementid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">NATURE OF PARTICIPANT</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" name="uachparticipant" value="<?php echo $row1['natureofpart'] ?>" id="uachparticipant<?=$row['achievementid']; ?>">
							<input type="text" hidden class="form-control" value="<?php echo $row1['yearid']; ?>"  id="uyearid<?=$row['achievementid']; ?>">
							<input type="text" hidden class="form-control" value="<?php echo $row1['monthid']; ?>"  id="umonthid<?=$row['achievementid']; ?>">
							<input type="hidden"  id="udeptid<?=$row['achievementid']; ?>" value="<?= $row1['deptId']?>" >
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>

		<div class="container card-2 mb-5">
			<button type="button" class="btn mx-2 w-30 my-4 p-2" data-dismiss="modal" style="float: right;background-color: red; width: 10%; color: white;">CANCLE</button>
			<button type="submit" class="btn mx-2 w-30 my-4 updateacheiment" style="float: right;background-color: #26CFE9; width: 10%; color: white;" value="<?php echo $row1['achievementid'] ?>" >UPDATE</button>
			<button type="submit" class="btn mx-2 w-30 my-4" style="float: right;background-color: lightgreen; width: 10%; color: white;" value="<?php echo $row1['achievementid'] ?>" id="verifyacheiment">VERIFY</button>
		</div>
	</div>
	</div>
</div>
</div>
   
</div>
<?php
    }


}
?>

									
									
									 </td>
                                    <td><?php echo $row['userid'] ?></h4></td>
                                
                                    </tr>
                                    <?php       
                                }
                            }
}