<?php
include '../includes/session.php';
 include_once 'confiq.php';
 include_once 'classes.php';

 $year = new Year();
 

if(isset($_POST['delstudent'])){
	
	$id=$_POST['id'];
		mysqli_query($conn,"delete from `achievements` where achievementid='$id'");
}

if(isset($_POST['verifystudent'])){
	
	$id=$_POST['id'];
		mysqli_query($conn,"UPDATE `achievements` SET `verified`='1' WHERE `achievementid` = '$id'");
}
?>
<?php
include_once 'confiq.php';
if(isset($_POST['editstudent']))  
{  
	$id=$_POST['id'];
	$achtndays=$_POST['achtndays'];
	$achfrom=$_POST['achfrom'];
	$achto=$_POST['achto'];
	$achpname=$_POST['achpname'];
	$achduration=$_POST['achduration'];
	$achvenue=$_POST['achvenue'];
	$achby=$_POST['achby'];
	$achprogramtitle=$_POST['achprogramtitle'];
	$achpapertitle=$_POST['achpapertitle'];
	$achparticipant=$_POST['achparticipant'];
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$deptid = $_POST['deptid'];
	$query=mysqli_query($conn,"UPDATE `achievements` SET `ach_name`='$achprogramtitle',`ach_days`='$achtndays',`ach_from`='$achfrom',`ach_to`='$achto',`participantname`='$achpname',`ach_type`='$achby',`ach_info`='$achpapertitle',`ach_venue`='$achvenue',`natureofpart`='$achparticipant',`monthid`='$monthid',`yearid`='$yearid' WHERE `achievementid` = '$id'");
	
}


include_once 'confiq.php';


if(isset($_POST['addr']))  
{  
	$rtitle=$_POST['rtitle'];
	$rpi=$_POST['rpi'];
	$rfa=$_POST['rfa'];
	$ras=$_POST['ras'];
	$rfrom=$_POST['rfrom'];
	$rend=$_POST['rend'];
	$rstatus=$_POST['rstatus'];
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$deptid=$_POST['deptid'];
	$sql="INSERT INTO `researchproject`(`title`, `participantsname`, `fundingagency`, `fromtodate`,`todate`, `amount`, `status`, `monthid`, `yearid`, `deptid`, `userid`, `verfied`) VALUES ('$rtitle','$rpi','$rfa','$rfrom','$rend','$ras','$rstatus','$monthid','$yearid','$deptid','$userid','0')";
	if(!mysqli_query($conn,$sql));{
	    echo("Error description: " . mysqli_error($conn));
	}

}
if(isset($_POST['showresearch'])){
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$sql1 = "SELECT * FROM `researchproject` where `yearid`='$yearid' and `monthid`='$monthid'";
    $result1 = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result1) > 0) {
?>
 <tr class="table-info">
                                    <td>Title</td>
                                    <td>Participant Name</td>
                                    <td>Funding Agency</td>
                                    <td>Verified</td>
                                    <td class="p-0 text-center pt-2 text-lowercase">Amount Sanctioned
                                    </td>
                                
                                    <td>Operations</td>
                                    
                                    <td>User</td>
                                    </tr>
									<?php

                         
                            while($row = mysqli_fetch_assoc($result1)) {?>
                                    <tr >
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['participantsname'] ?></td>
                                    <td><?php echo $row['fundingagency'] ?></td>
                                    <td><?php
									if($row['verfied']== "0"){?>
										<span class="badge badge-danger">Unverified</span><?php
									}else{?>
									<span class="badge badge-success">verified</span>
									<?php
								}?></td>
                                    <td class=" text-center "><?php echo $row['amount'] ?>
                                    </td>
                                    <td><div class="btn-group"> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editres<?php echo $row['projid']; ?>"><span class = "glyphicon glyphicon-pencil"></span>Edit</button> <button class="btn btn-sm btn-danger deleteresearch" value="<?= $row['projid']?>">Delete</button>  </div>
									
									<?php
include_once 'confiq.php';
   $result2=mysqli_query($conn,"SELECT * FROM `researchproject` WHERE projid='".$row['projid']."'");
   $row1=mysqli_fetch_array($result2); {
	   
	$yearid=$row1['yearid'];
	$monthid=$row['monthid'];
	$sqlpp = "SELECT y.yearid, y.year, m.monthid, m.monthname FROM month m, year y where y.yearid = $yearid and m.monthid =  $monthid and m.yearid = y.yearid";
	   $mm = mysqli_query($conn, $sqlpp); 
	   $my = mysqli_fetch_assoc($mm); 
	   $temp=$my['monthname'];
if($temp=="Jan"){
   
   $temp="01";
}elseif($temp=="Feb"){
   $temp="02";
}elseif($temp=="Mar"){
   $temp="03";
}elseif($temp=="Apr"){
   $temp="04";
}elseif($temp=="May"){
   $temp="05";
}elseif($temp=="Jun"){
   $temp="06";
}elseif($temp=="Jul"){
   $temp="07";
}elseif($temp=="Aug"){
   $temp="08";
}elseif($temp=="Sep"){
   $temp="09";
}elseif($temp=="Oct"){
   $temp="10";
}elseif($temp=="Nov"){
   $temp="11";
}elseif($temp=="Dec"){
   $temp="12";
}
 

	 
	 ?>
   <div class="modal fade mod" id="editres<?php echo $row['projid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-xl"  role="document" >
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">STATUS OF RESEARCH PROJECT</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
		<div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">TITLE </label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['title']; ?>" name="" id="ertitle<?php echo $row['projid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">PARTICIPANT NAME</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control"value="<?php echo $row1['participantsname']; ?>" name="" id="erpi<?php echo $row['projid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">FUNDING AGENCY</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" value="<?php echo $row1['fundingagency']; ?>" name="" id="erfa<?php echo $row['projid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">AMOUNT SANCTIONED</label>
						</div>
						<div class="col-md-6 mt-4">
				
							
							<input type="text" class="form-control" value="<?php echo $row1['amount']; ?>" name="" id="eras<?php echo $row['projid']; ?>">
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">FROM - TO</label>
						</div>
						<div class="col-md-6 mt-4">
							<input type="text" class="form-control" name="" value="<?= $row1['fromtodate'] ?>" id="efrom<?php echo $row['projid']; ?>" readonly="readonly">
							<!-- <input type="date"  min="<?php echo $my['year']; ?>-<?php echo $temp; ?>-01"  max="<?php echo $my['year']; ?>-<?php echo $temp; ?>-31" class="form-control" name="" id="efrom"> -->
						</div>
					</div>
				</div>
				
               
                <div class="col-md-6">
					<div class="row">
						<div class="col-md-6 mt-4">
							<label class="form-label">STATUS</label>
						</div>
						<div class="col-md-6 mt-4">
							<select name="" id="erstatus<?php echo $row['projid']; ?>" class="form-control">
								<option value="Completed">Completed</option>
								<option value="Ongoing">Ongoing</option>
								<option value="Applied">Applied</option>
							</select>
						</div>
					</div>
                </div>
              
            </div>
           

		</div>
		
		<div class="container card-2 mb-5">
		<button type="button" class="btn mx-2 w-30 my-4 p-2" data-dismiss="modal" style="float: right;background-color: red; width: 10%; color: white;">CANCLE</button>
			<button type="submit" class="btn mx-2 w-30 my-4 editresearch" style="float: right;background-color: #26CFE9; width: 10%; color: white;" value="<?php echo $row1['projid'] ?>" id="">update</button>
			<button type="submit" class="btn mx-2 w-30 my-4" style="float: right;background-color: lightgreen; width: 10%; color: white;" value="<?php echo $row1['projid'] ?>" id="resourceverify">VERIFY</button>

		    </div>
      
</div>
</div>
</div>
								   
<?php
    }


?>							   
</td>
<td><?= $row['userid']?></td>
                               	<?php
									}?>
                                    </tr><?php
								
	}
	else{
	    echo "NO RESULTS";
	}
}

?>


<?php
include_once 'confiq.php';
if(isset($_POST['delres'])){
	
	$id=$_POST['id'];
		mysqli_query($conn,"delete from `researchproject` where projid='$id'");
}

if(isset($_POST['verifyresearch'])){
	
	$id=$_POST['id'];
		mysqli_query($conn,"UPDATE `researchproject` SET `verfied`='1' WHERE `projid` = '$id'");
}


if(isset($_POST['editr']))  
{  
	$id=$_POST['id'];
	$rtitle=$_POST['rtitle'];
	$rpi=$_POST['rpi'];
	$rfa=$_POST['rfa'];
	$ras=$_POST['ras'];
	// $rfrom=$_POST['rfrom'];
	// $rend=$_POST['rend'];

	$rstatus=$_POST['rstatus'];
	

	$query=mysqli_query($conn,"UPDATE `researchproject` SET `title`='$rtitle',`participantsname`='$rpi',`fundingagency`='$rfa',`amount`='$ras',`status`='$rstatus' WHERE `projid`='$id'");

}
?>


<?php
include_once 'confiq.php';


if(isset($_POST['addpub']))  
{  
	$pubname=$_POST['rname'];
	$title=$_POST['title'];
	$detail=$_POST['detail'];
	$type=$_POST['type'];
	$date=$_POST['date'];
	$ugc=$_POST['ugc'];
	$biblo=$_POST['biblo'];
	$isbn=$_POST['isbn'];
	$venue=$_POST['venue'];
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$deptid=$_POST['deptid'];
	$sql1 ="INSERT INTO `publication`(`publicationname`, `pubtype`, `venue`, `title`, `details`, `isbn`, `biblimeteric`, `ugc`, `date`, `deptid`, `userid`, `verified`, `monthid`, `yearid`) VALUES ('$pubname','$type','$venue','$title','$detail','$isbn','$biblo','$ugc','$date','$deptid','$userid','0','$monthid','$yearid')";
	// $query=mysqli_query($conn,$sql1);
	if (mysqli_query($conn, $sql1)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
	}
}

if(isset($_POST['showpub'])){
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];
	$deptid=$_POST['deptid'];
	$sql1 = "SELECT * FROM `publication` where `yearid`='$yearid' and `monthid`='$monthid' and `deptid`='$deptid'";
    $result1 = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result1) > 0) {
	?>
 	<tr class="table-info">
		<td>Date</td>
		<td>Name </td>
		<td>Verified</td>
		<td>Type of publication</td>
		<td class="p-0 text-center pt-2 text-lowercase">Month /Year /ISBN no
		</td>
	
		<td>Operations</td>
		
		<td>User</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result1)) {?>
		<tr >
			<td><?php echo $row['date'] ?></td>
			<td><?php echo $row['title'] ?></td>
			<td><?php
			if($row['verified']== "0"){?>
				<span class="badge badge-danger">Unverified</span><?php
			}else{?>
			<span class="badge badge-success">verified</span>
			<?php
			}?>
			</td>
			<td><?php echo $row['pubtype'] ?></td>
			<td class=" text-center ">
			<?= $year->displayMonth($row['monthid'],$row['yearid']); ?>
			<?= $year->displayYear($row['yearid']);?>
			<b><?= $row['isbn'] ?></b>
			</td>
			<td> <div class="btn-group"><button href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editpub<?php echo $row['publicationid']; ?>">Edit</button> <button class="btn btn-sm btn-danger Deletepub" value="<?= $row['publicationid']?>">Delete</button> </div>
			<div class="modal fade mod" id="editpub<?php echo $row['publicationid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

			<?php
			$result2=mysqli_query($conn,"SELECT * FROM `publication` WHERE `publicationid`='".$row['publicationid']."'");
			$row1=mysqli_fetch_array($result2); {
			$yearid=$row1['yearid'];
			$monthid=$row['monthid'];
			$yearname = $year->displayYear($yearid);
    		$monthname = $year->displayMonth($monthid,$yearid);
    		$monthnum=$year->displayMonthNum($monthid,$yearid);
			// $temp= $year->displayMonthNum($monthid,$yearid);
			$sqlpp = "SELECT y.yearid, y.year, m.monthid, m.monthname FROM month m, year y where y.yearid = $yearid and m.monthid =  $monthid and m.yearid = y.yearid";
			$mm = mysqli_query($conn, $sqlpp); 
			$my = mysqli_fetch_assoc($mm); 
			$temp=$my['monthname'];
			if($temp=="Jan"){

			$temp="01";
			}elseif($temp=="Feb"){
			$temp="02";
			}elseif($temp=="Mar"){
			$temp="03";
			}elseif($temp=="Apr"){
			$temp="04";
			}elseif($temp=="May"){
			$temp="05";
			}elseif($temp=="Jun"){
			$temp="06";
			}elseif($temp=="Jul"){
			$temp="07";
			}elseif($temp=="Aug"){
			$temp="08";
			}elseif($temp=="Sep"){
			$temp="09";
			}elseif($temp=="Oct"){
			$temp="10";
			}elseif($temp=="Nov"){
			$temp="11";
			}elseif($temp=="Dec"){
			$temp="12";
			}  
	 		?>

   <div class="modal-dialog modal-xl"  role="document" >
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">BOOK / ARTICLE / CHAPTER / PAPER PUBLICATION</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
		<div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">TITLE OF PUBLISH</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" value="<?php echo $row1['title']; ?>" name="" id="title<?=$row['publicationid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">DETAILS OF PUBLISHER</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" value="<?php echo $row1['publicationname']; ?>" name="" id="detail<?=$row['publicationid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6  mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">TYPE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<!-- <input type="text" class="form-control" name=""> -->
							<select class="form-control" id="type<?=$row['publicationid']; ?>">
                                <option value="BOOK">BOOK</option>
                                <option value="CHAPTER">CHAPTER</option>
                                <option value="PAPER">PAPER</option>
                                <option value="ARTICLE">ARTICLE</option>
                            </select>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">DATE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
						<div class="input-group">
						
							<input type="text" class="form-control"  value="<?= $row['date']?>" readonly="readonly" id="date<?=$row['publicationid']; ?>">
						</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">UGC APPROVAL</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<!-- <input type="text" class="form-control w-100" name=""> -->
							<select name="" id="ugc<?=$row['publicationid']; ?>" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								<!-- <option value="Applied">Applied</option> -->
							</select>
						</div>
					</div>
				</div>
                <div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">BIBLIOGRAPHY</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" value="<?php echo $row1['biblimeteric']; ?>" name="" id="biblo<?=$row['publicationid']; ?>">
						</div>
					</div>
                </div>
                <div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 ">
							<label class="form-label pl-2">ISBN NO.</label>
						</div>
						<div class="col-md-6 p-0 ">
						<input type="hidden"  class="form-control" value="<?php echo $row1['yearid']; ?>" name="adyearid" id="yearid<?=$row['publicationid']; ?>">
							<input type="hidden"  class="form-control" value="<?php echo $row1['monthid']; ?>" name="admonthid" id="monthid<?=$row['publicationid']; ?>">
					
							<input type="text" class="form-control w-100" name="" value="<?php echo $row1['isbn']; ?>" id="isbn<?=$row['publicationid']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">VENUE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" value="<?php echo $row1['venue']; ?>" name="" id="venue<?=$row['publicationid']; ?>">
						</div>
					</div>
                </div>
         
</div>
		</div>
		
		<div class="container card-2 mb-5">
			<div class="btn-group float-right">
			<button class="btn btn-sm btn-success updatepub"  value="<?php echo $row1['publicationid'] ?>" id="">Update</button>
			<button type="submit" class="btn btn-warning"  value="<?php echo $row1['publicationid'] ?>" id="pubverify">VERIFY</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal" >CANCLE</button>										
			</div>
			
		</div>
        
</div>
</div>
</div>
<?php
    }


?>		
									
									
									</td>
                                    <td><?= $row['userid']?></td>
                               
									<?php
									}?>
                                    </tr><?php
								
	}
	else{
		echo "<tr> <td> No records </td></tr>";
	}
}
// delte the publication details.
if(isset($_POST['delpub'])){
	$id=$_POST['id'];
	mysqli_query($conn,"delete from `publication` where `publicationid`='$id'");
}
// verify the publicaton details.
if(isset($_POST['verifypub'])){
	
	$id=$_POST['id'];
		mysqli_query($conn,"UPDATE `publication` SET `verified`='1' WHERE `publicationid` = '$id'");
}
// update the publication details.
if(isset($_POST['updatepub']))  
{  
	$id=$_POST['id'];
	$title=$_POST['title'];
	$detail=$_POST['detail'];
	$type=$_POST['type'];
	$date=$_POST['date'];
	$ugc=$_POST['ugc'];
	$biblo=$_POST['biblo'];
	$isbn=$_POST['isbn'];
	$venue=$_POST['venue'];
	$yearid=$_POST['yearid'];
	$monthid=$_POST['monthid'];

	$query=mysqli_query($conn,"UPDATE `publication` SET `publicationname`='$detail',`pubtype`='$type',`venue`='$venue',`title`='$title',`details`='$detail',`isbn`='$isbn',`biblimeteric`='$biblo',`ugc`='$ugc',`date`='$date' WHERE `publicationid`='$id'");

}
?>