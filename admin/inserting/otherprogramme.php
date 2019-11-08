<?php 
include '../includes/session.php';
include 'confiq.php';
include 'classes.php';

		$year = new Year();
        
// include 'functions.php';
?>
<?php 
// to get the resource person details
// code to verify the document details
	if(isset($_POST['verify'])){
		$id = $_POST['id'];
		$sql1= "select * from programmes where prgmid = '$id' ";
		$result = mysqli_query($conn, $sql1);
		if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row['verified']==0){
						$updateprgm="UPDATE `programmes` SET `verified`= 1 WHERE prgmid = '$id'";
						mysqli_query($conn, $updateprgm);
					}
					else{
						$updateprgm="UPDATE `programmes` SET `verified`= 0 WHERE prgmid = '$id'";
						mysqli_query($conn, $updateprgm);
					}
				}
			}
	}

// code to delete the programme details
		if(isset($_POST['del'])&&isset($_POST['id']))
		{
			$id = $_POST['id'];
			
			// mysqli_query($conn,"delete from image where progammedid = $id");
			mysqli_query($conn,"delete from `programmes` where prgmid = $id");
		}		

	
		if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid'])&&isset($_GET['programme']))
		{
			
			 $deptid = test_input($_GET['deptid']);
			 $yearid = test_input($_GET['yearid']);
			 $monthid=test_input($_GET['monthid']);
			 $userid = $_SESSION['userid'];
			 $typeofprogramme = test_input($_GET['programme']);
			 $yearname = $year->displayYear($yearid);
			$monthname = $year->displayMonth($monthid,$yearid);
			$monthnum=$year->displayMonthNum($monthid,$yearid);

		  if(isset($_GET['programmedid'])){
			$programmeid = test_input($_GET['programmedid']);
			$sql1= "select * from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and prgmid = '$programmeid' ";
			$result = mysqli_query($conn, $sql1);

			if (mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					// $deptid = $row['deptid'];
					$yearid = $_GET['yearid'];
					$monthid= $_GET['monthid'];
					$typeofprogramme = $row['typeofprogramme'];
					$days = $row['days'];
					$from = $row['fromdate'];
					$to = $row['todate'];
					$time = $row['duration'];
					$duration = $row['duration'];
					$title =  $row['title'];
					$natureoevent = $row['natureofevent'];
					$typeofevent = $row['type'];
					$venue = $row['venue'];
					$purpose = $row['purpose'];
					
					$intpart = $row['Internalcount'];
					$extpart=	$row['externalcount'];
					$noofpart = $intpart + $extpart;
					$partdet =	$row['partcipantsdetails'];

					$resourceid = $row['resourcepersonid'];
					$resource= "select * from reasource where resourcepersonid = '$resourceid'";
					$resourceresult = mysqli_query($conn, $resource);

					if (mysqli_num_rows($resourceresult) > 0) 
					{
						while($rowresource = mysqli_fetch_assoc($resourceresult)) 
						{
							$resourcename =	$rowresource['name'];
							$emailid =	$rowresource['emailid'];
							$persondetails = $rowresource['details'];
							$phoneno=  $rowresource['contact'];

						}
					}
						$objective = $row['objective'];
						$breif = $row['brief'];
						$learningoutcome= $row['outcome'];
						$typeofprogramme = $row['typeofprogramme'];
					// $fileone = $_FILES['file1'];
				}
		  	}
		}
	}

		// getting and setting details on editing  the form
		
		// getting details on submitting the interactive form
	if(isset($_POST['submit']) || isset($_POST['update']))
	{

	// echo "<script type='text/javascript'>alert('Success');</script>";
		$programmeid = test_input($_POST['prgmid']);
		$deptid = test_input($_POST['deptid']);
		$yearid = test_input($_POST['yearid']);
		$userid=test_input($_POST['userid']);
		$monthid=test_input($_POST['monthid']);
    	$typeofprogramme = test_input($_POST['typeofprogramme']);
		$days = test_input($_POST['days']);
		if(isset($_POST['submit'])){
			$from = test_input($_POST['fdateyear']).'-'.test_input($_POST['fdatemonth']).'-'.test_input($_POST['fdateday']);
			$to = test_input($_POST['tdateyear']).'-'.test_input($_POST['tdatemonth']).'-'.test_input($_POST['tdateday']);
		    
		}
		else if(isset($_POST['update'])){
		    $from = $_POST['from'];
		    $to = $_POST['to'];
		}
		$time = test_input($_POST['time']);
		$duration = test_input($_POST['duration']);
		$title =  test_input($_POST['title']);
	 	$natureoevent = test_input($_POST['natofeve']);
		$typeofevent = test_input($_POST['typeofeve']);
		$venue = test_input($_POST['venue']);
		$purpose = test_input($_POST['purpose']);
		$noofpart = test_input($_POST['noofpart']);
	 	$intpart = test_input($_POST['intpar']);
	 	$extpart=	test_input($_POST['extpart']);
		$partdet =	test_input($_POST['partdet']);
		// check if it is a add on course details then get the resource person details.
		if($typeofprogramme=='addoncourse')
		{
			$resourceid = test_input($_POST['resourceid']);
			$resourceid1= test_input($_POST['resourceid']);
			$resourcename =	test_input($_POST['resourcename']);
			$emailid =	test_input($_POST['emailid']);
			$persondetails =	test_input($_POST['persondetails']);
			$phoneno=  test_input($_POST['phoneno']);
		}
		$objective = test_input($_POST['objective']);
		$breif = test_input($_POST['breif']);
		$learningoutcome= test_input($_POST['learningoutcome']);
		$typeofprogramme = test_input($_POST['typeofprogramme']);
	
		if(isset($_POST['update']))
		{
					$deptid = $_POST['deptid'];
					$feedbackid = 10;
					// $userid = 7;
					$verified = '0';
					$updatereasource="UPDATE `reasource` SET name='$resourcename',details='$persondetails',contact='$phoneno',emailid='$emailid',departmentid='$deptid' WHERE resourcepersonid = '$resourceid' ";
					if (mysqli_query($conn, $updatereasource)) 
					{
						$resourceid = mysqli_insert_id($conn);
						
					} else 
					{
						echo "Error: " . $updatereasource . "<br>" . mysqli_error($conn);
					}
					$updateprgm="UPDATE `programmes` SET `days`='$days',`fromdate`= '$from',`todate`='$to',`natureofevent`='$natureoevent',`resourcepersonid`='$resourceid1',`objective`='$objective',`brief`='$breif',`outcome`='$learningoutcome',`feedbackid`='$feedbackid',`monthid`='$monthid',`yearid`='$yearid',`type`='$typeofevent',`userid`='$userid',`verified`='$verified',`title`='$title',`deptId`='$deptid',`Internalcount`='$intpart',`externalcount`='$extpart',`partcipantsdetails`='$partdet',`typeofprogramme`='$typeofprogramme',`Time`='$time',`duration`='$duration',`venue`='$venue',`purpose`='$purpose' WHERE prgmid = '$programmeid'";
					if (mysqli_query($conn, $updateprgm)) 
					{
						$programmeid = mysqli_insert_id($conn);
						header("location:../addoncourses.php?deptid=$deptid&yearid=$yearid&monthid=$monthid&typeofprogramme=addoncourse");
						
					} 
					else 
					{
						echo "Error: " . $updateprgm . "<br>" . mysqli_error($conn);
					}

		}

				
						
					
		if(isset($_POST['submit']))
		{
			// Validating the text box
    		if(empty($days)||empty($from)||empty($to)){
    			$dayserror = 'Some Fields Are Missing Kindly Fill it';
    		}
    		else if(empty($title)||empty($natureoevent)||empty($typeofevent)||empty($venue)||empty($purpose)){
    			$abterror = 'Some Fields Are Missing Kindly Fill it';
    		}
    		else if(empty($noofpart)||empty($intpart)||empty($partdet)){
    			$parterror = 'Some Fields Are Missing Kindly Fill it';
    		}
    		else{
					// check if resource person alredy exists
					if(empty($_POST['resid']))
					{
						// add the resource person details if it is a add on course and resource person details is not available.
						if($typeofprogramme=='addoncourse')
						{
							$stmt1 = "INSERT INTO reasource (name,details,contact,emailid,departmentid) values ('$resourcename','$persondetails',$phoneno,'$emailid',$deptid)";
							
							if (mysqli_query($conn, $stmt1)) 
							{
								$resourceid = mysqli_insert_id($conn);
								
							} else 
							{
								echo "Error: " . $stmt1 . "<br>" . mysqli_error($conn);
							}
						}
						// if the resid is empty then store dummy value
					
					}
					else
					{	
						// if resource person exists get his person id.
						$resourceid =  $_POST['resid'];	
					}
					$feedbackid = 10;
				
					$verified = 0;
					// Inserting into the programme  table
					if($typeofprogramme=='addoncourse'){
						$sql2="INSERT INTO programmes (days, fromdate, todate,natureofevent,resourcepersonid,objective,brief,outcome,feedbackid,monthid,yearid,type,userid,verified,title,deptid,internalcount,externalcount,partcipantsdetails,typeofprogramme,time,duration,venue,purpose) VALUES ('$days', '$from', '$to','$natureoevent','$resourceid','$objective','$breif','$learningoutcome','$feedbackid','$monthid','$yearid','$typeofevent','$userid','$verified','$title','$deptid','$intpart','$extpart','$partdet','$typeofprogramme','$time','$duration','$venue','$purpose')";

					}
					else{
						$sql2="INSERT INTO programmes (days, fromdate, todate,natureofevent,resourcepersonid,objective,brief,outcome,feedbackid,monthid,yearid,type,userid,verified,title,deptid,internalcount,externalcount,partcipantsdetails,typeofprogramme,time,duration,venue,purpose) VALUES ('$days', '$from', '$to','$natureoevent',NULL,'$objective','$breif','$learningoutcome','$feedbackid','$monthid','$yearid','$typeofevent','$userid','$verified','$title','$deptid','$intpart','$extpart','$partdet','$typeofprogramme','$time','$duration','$venue','$purpose')";

					}
					
					if (mysqli_query($conn, $sql2)) 
					{
						$programmeid = mysqli_insert_id($conn);
						
						if($typeofprogramme=='addoncourse'){
						    header("location:../addoncourses.php?deptid=$deptid&yearid=$yearid&monthid=$monthid&typeofprogramme=addoncourse");
						}else if($typeofprogramme =='constructive'){
							header("Location:../constructive.php?deptid=$deptid&yearid=$yearid&monthid=$monthid&typeofprogramme=constructive");
						}else if($typeofprogramme=='experiential'){
							header("Location:../constructive.php?deptid=$deptid&yearid=$yearid&monthid=$monthid&typeofprogramme=experiential");							
						}
						// header("location:../addoncourses.php?deptid=$deptid&yearid=$yearid&monthid=$monthid&typeofprogramme=addoncourse");
					} else 
					{
						echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
					}
					
		}	
	}	  
						
	}
	
?>
<?php 
include '../includes/header.php';
include '../includes/nav-bar.php';
?>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"  enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="deptid" value="<?= $deptid?>">
					<input type="hidden" name="yearid" value="<?= $yearid?>">
					<input type="hidden" name="monthid" value="<?= $monthid?>">
					<input type="hidden" name="prgmid" value="<?= $programmeid?>">
					<input type="hidden" name="typeofprogramme" value="<?= $typeofprogramme?>">
					<input type="hidden" name="userid" value="<?= $userid ?>">
					<input type="hidden" name="resourceid" value="<?= $resourceid ?>" />
									<div class="container card-2 py-3 my-2 px-5">
										<h4 style="color: #06367E; text-transform:uppercase;"><?= $typeofprogramme?> </h4>
										<?php if(isset($dayserror)) {?>
										<div class="alert alert-danger">
											<?php echo $dayserror; ?>
										</div>
										<?php }?>
										<div class="row">
											<div class="col-md-6">
													<div class="row">
														<div class="col-md-6 p-2">
																	<label class="form-label">TOTAL NO.OF.DAYS</label>
														</div>
														<div class="col-md-6 p-2">
															<input type="number" class="form-control" name="days" value="<?php echo (isset($_POST['days'])?$_POST['days']:""); if(isset($days)) echo $days;?>" required>
														</div>
													</div>
											</div>
											
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">FROM</label>
													</div>
													<div class="col-md-6 p-2">
														<?php if(empty($programmeid)) {?>
															
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

														<?php } else { ?>
															<input type="text" class="form-control" name="from" value ="<?=$from ?>" readonly="true">
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2">
														<label class="form-label">TO</label>
													</div>
													<div class="col-md-6 p-2">
														<?php if(empty($programmeid)) {?>
															<div class="input-group">
																<select name="tdateday" id="" class="form-control">
																	<?php 
																		for($i=1;$i<=31;$i++){
																			echo "<option value='$i'>$i</option>";
																		}
																	?>
																</select>
																<input type="text" name="tdatemonth" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
																<input type="text" name="tdateyear" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
															</div>
															<!-- <input type="date" class="form-control" name="to"  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"> -->
														<?php } else { ?>
															<input type="text" class="form-control" name="to" value ="<?=$to ?>" readonly="true">
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">Time</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="time" value="<?php echo (isset($_POST['time'])?$_POST['time']:""); if(isset($time)) echo $time;?>" placeholder="10:00 AM" >
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">Duration</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="duration" value="<?php echo (isset($_POST['duration'])?$_POST['duration']:"");if(isset($duration)) echo $duration; ?>"  placeholder="40 hours">
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">

										<h4 class="text-primary mb-4">ABOUT THE EVENT</h4>
										<?php if(isset($abterror)) {?>
										<div class="alert alert-danger">
											<?php echo $abterror; ?>
										</div>
										<?php }?>
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">TITLE</label>
														<p class="text-danger">*Enter the title of the Event</p>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="title" value="<?php echo (isset($_POST['title'])?$_POST['title']:""); if(isset($title)) echo $title; ?>" placeholder="Enter the Title" required>
														<input type="hidden" name="typeofprogramme" value="<?= $typeofprogramme?>">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">NATURE OF EVENT</label>
														<p class="text-danger">*Enter the Nature of the Event like Workshop on, TechTalk etc..</p>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="natofeve" value="<?php echo (isset($_POST['natofeve'])?$_POST['natofeve']:""); if(isset($natureoevent)) echo $natureoevent; ?>" placeholder="Enter the Nature of Event" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">TYPE OF EVENT</label>
													</div>
													<div class="col-md-6 p-2 ">
														<!-- <input type="text" class="form-control" name="typofeve" required> -->
														<select name="typeofeve" id="" class="form-control" required>
															<option value="Intra">Intra</option>
															<option value="Inter">Inter</option>
															<option value="National">National</option>
															<option value="State">State</option>
															<option value="Regional"></option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">VENUE</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="venue" value="<?php echo (isset($_POST['venue'])?$_POST['venue']:""); if(isset($venue)) echo $venue; ?>" placeholder="Ex: KJC, Bangalore" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PURPOSE</label>
														<p class="text-danger">
														*employability/ entrepreneurship/skill development/ Curriculum Enrichment</p>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" value="<?php echo (isset($_POST['purpose'])?$_POST['purpose']:""); if(isset($purpose)) echo $purpose; ?>" name="purpose" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">
									
										<h4 class="text-primary mb-4">PARTICIPANTS DETAILS</h4>
										<?php if(isset($parterror)) {?>
										<div class="alert alert-danger">
											<?php echo $parterror; ?>
										</div>
										<?php }?>
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">NO.OF.PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="number" class="form-control" name="noofpart" value="<?php echo (isset($_POST['noofpart'])?$_POST['noofpart']:""); if(isset($noofpart)) echo $noofpart; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">INTERNAL PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="number" class="form-control" name="intpar" value="<?php echo (isset($_POST['intpar'])?$_POST['intpar']:""); if(isset($intpart)) echo $intpart; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">EXTERNAL PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="number" class="form-control" name="extpart" value="<?php echo (isset($_POST['extpart'])?$_POST['extpart']:""); if(isset($extpart)) echo $extpart; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PARTICIPANTS DETAILS</label>
														<p class="text-danger">
															You can enter the participants details. <br>
															1.  Name - Class , ...... <br>
															or <br>
															2. sem-class-count , ....
														</p>
													</div>
													<div class="col-md-6 p-2 ">
														<textarea class="form-control" name="partdet" placeholder="Ex : Ajith - V MCA  / III SEM-MCA-46" required> <?php if(isset($partdet)) echo $partdet; ?></textarea>
													</div>
												</div>
											</div>
											
										</div>
									</div>
									<?php if($_GET['programme'] !='constructive' && $_GET['programme'] != 'experiential' )  {?>
									<div class="container card-2 py-3 my-2 px-5">
										<h4 class="text-primary mb-4">RESOURCE PERSON DETAILS</h4>
										<?php if(isset($reserror)) {?>
										<div class="alert alert-danger">
											<?php echo $reserror; ?>
										</div>
										<?php }?>
										<div class="row">
										<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label text-danger">Enter the Resource pesron name to check the details</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="hidden" id="resid" name="resid">
														<input list="resourcename" id="resourcename" class="form-control" name="resourcename" value="<?php echo (isset($_POST['resourcename'])?$_POST['resourcename']:""); if(isset($resourcename)) echo $resourcename; ?>" required>
													</div>
													
												</div>
											</div>
											<div class="col-md-6">
													<div id="resourcedet" class="text-danger">
														
														</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PERSON NAME</label>
														
													</div>
													<div class="col-md-6 p-2 ">
														<input list="resourcename" id="newreasourcename" class="form-control" name="resourcename" value="<?php echo (isset($_POST['resourcename'])?$_POST['resourcename']:""); if(isset($resourcename)) echo $resourcename; ?>" required>
														
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">EMAIL ID</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="text" class="form-control" name="emailid" id="emailid" value="<?php echo (isset($_POST['emailid'])?$_POST['emailid']:""); if(isset($emailid)) echo $emailid; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
											<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PHONE NUMBER</label>
													</div>
													<div class="col-md-6 p-2 ">
														<input type="number" class="form-control" name="phoneno" id="phoneno" value="<?php echo (isset($_POST['phoneno'])?$_POST['phoneno']:""); if(isset($phoneno)) echo $phoneno; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">RESOURCE PERSON DETAILS</label>
													</div>
													<div class="col-md-6 p-2 ">
														<textarea id="persondetails" rows="4" cols="30" class="form-control" value="" placeholder="Ex:   Professor, Faculty of Computing & IT,
																	King Abdul Aziz University,
																	Saudi Arabia.
															" name="persondetails" required><?php echo (isset($_POST['persondetails'])?$_POST['persondetails']:"");  if(isset($persondetails)) echo $persondetails;?></textarea>
													</div>
												</div>
											</div>
											
											
										</div>
									</div>
										<?php } ?>
									<div class="container card-2 py-3 my-2 px-5">	
										<h4 class="text-primary mb-4">ABOUNT THE EVENT</h4>
										<div class="row">
											<div class="col-lg-4">
												
												
														<label class="form-label">Objective</label>
													
											</div>
											<div class="col-lg-8">
												
														<input type="text" class="form-control w-100" name="objective" value="<?php echo (isset($_POST['objective'])?$_POST['objective']:""); if(isset($objective)) echo $objective; ?>" required>
													
											</div>
											<div class="col-md-4 my-3">
												
														<label class="form-label">BREF WRITE ABOUT THE SESSION</label>
													
											</div>
											<div class="col-md-8 my-3">
												
													<textarea rows="20" cols="30" class="form-control w-100" name="breif"  required><?php echo (isset($_POST['breif'])?$_POST['breif']:""); if(isset($breif)) echo $breif; ?></textarea>
													
											</div>
											<div class="col-md-4 ">
												
														<label class="form-label">LEARNING OUTCOME</label>
													
											</div>
											<div class="col-md-8">
												
													<textarea rows="8" cols="30" class="form-control w-100" name="learningoutcome"  required><?php echo (isset($_POST['learningoutcome'])?$_POST['learningoutcome']:""); if(isset($learningoutcome)) echo $learningoutcome; ?></textarea>
													
											</div>
											
											
										</div>
									</div>
									
								<?php	$previous = "javascript:history.go(-1)";
								if(isset($_SERVER['HTTP_REFERER'])) {
									$previous = $_SERVER['HTTP_REFERER'];
								}?>
									<div class="container card-2 mb-5">
										<!-- <input type="button"  value="CANCEL" style="float: right;  " name=""> -->
										<a href="<?=  $previous ?>" class="btn btn-danger btn-lg w-50 pr-2 float-right">Cancel</a>
										<?php if(isset($programmeid)){?>
											<input type="submit" name="update" value="UPDATE" class="btn-lg btn btn-success w-50 float-right">									    
										 <?php
										}else {?>
											<input type="submit" name="submit" value="ADD" class="btn-lg btn btn-success w-50 float-right">
										<?php } ?>
									</div>
								</div>	

							</div>
						</div>
					</div>
					
				</form>
<script src="../css/js/jquery-3.4.1.js"></script>
<script>
	$(document).ready(function(){
		
		$("#resourcename").keyup(function(){
			$str = $(this).val();
			// // console.log($str);
			if($str==""){
				// document.getElementById("resoucedet").innerHTML ="Result Not found";
				$('#newreasourcename').val('');
				$('#emailid').val('');
				$('#persondetails').val('');
				$('#phoneno').val('');
				$('#resourcedet').html("");
				$('#resid').val('');
			}
			else{
				$.ajax({
						type:'POST',
						url:'functions.php',
						dataType: "json",
						data:{str:$str},
						success:function(data)
						{
								if(data.status== 'ok')
								{
									console.log(data.result.name);
														
									$('#newreasourcename').val(data.result.name);
									$('#emailid').val(data.result.emailid);
									$('#persondetails').val(data.result.details);
									$('#phoneno').val(data.result.contact);
									$('#resid').val(data.result.resourcepersonid);
									$("#newreasourcename").attr('readonly','true');
									$("#emailid").attr('readonly','true');
									$("#persondetails").attr('readonly','true');
									$("#phoneno").attr('readonly','true');
									$('#resourcedet').html("");
								}
								else if(data.status == 'error')
								{

									$('#newreasourcename').val('');
									$('#emailid').val('');
									$('#persondetails').val('');
									$('#phoneno').val('');
									// $('#resourcedet').html("");
									$('#resourcedet').html("Not found");
									$("#newreasourcename").removeAttr('readonly');
									$("#emailid").removeAttr('readonly');
									$("#persondetails").removeAttr('readonly');
									$("#phoneno").removeAttr('readonly');
									$('#resid').val('');
								}
						}
					});
			}
		});

	});
</script>
<?php include '../includes/footer.php' ?>