<?php 
include '../includes/header.php';
include '../includes/nav-bar.php';
include 'confiq.php';
// include 'functions.php';
?>
<?php 
		$targetDir = "../../uploads/";
		$allowTypes = array('jpg','png','jpeg','gif');
        if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid'])&&isset($_GET['programme']))
        {
			echo $deptid = test_input($_GET['deptid']);
			echo $yearid = test_input($_GET['yearid']);
		    echo $monthid=test_input($_GET['monthid']);
		    echo $typeofprogramme = test_input($_GET['programme']);

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
				
	
	
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"  enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="deptid" value="<?= $deptid?>">
					<input type="hidden" name="yearid" value="<?= $yearid?>">
					<input type="hidden" name="monthid" value="<?= $monthid?>">
					<input type="hidden" name="prgmid" value="<?= $programmeid?>">
					<input type="hidden" name="typeofprogramme" value="<?= $typeofprogramme?>">
					<input type="hidden" name="resourceid" value="<?= $resourceid ?>" />
									<div class="container card-2 py-3 my-2 px-5">
										<h4 style="color: #06367E;">INTERACTIVE PROGRAMME</h4>
										<?php if(isset($dayserror)) {?>
										<div class="alert alert-danger">
											<?php echo $dayserror; ?>
										</div>
										<?php }?>
										<div class="row">
											<div class="col-md-6">
													<div class="row">
														<div class="col-md-6 p-2">
																	<label class="form-label text-success">TOTAL NO.OF.DAYS</label>
														</div>
														<div class="col-md-6 p-2">
                                                            <span><?php if(isset($days)) echo $days; ?></span>
														</div>
													</div>
											</div>
											
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label text-success">FROM</label>
													</div>
													<div class="col-md-6 p-2">
                                                        <span><?php if(isset($from)) echo $from; ?></span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2">
														<label class="form-label text-success">TO</label>
													</div>
													<div class="col-md-6 p-2">
                                                        <span><?php if(isset($to)) echo $to; ?></span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label text-success">Time</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                        <span><?php if(isset($time)) echo $time; ?></span>
														<!-- <input type="text" class="form-control" name="time" value="<?php echo (isset($_POST['time'])?$_POST['time']:""); if(isset($time)) echo $time;?>" placeholder="10:00 AM" > -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label text-success">Duration</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($duration)) echo $duration; ?></span>
														<!-- <input type="text" class="form-control" name="duration" value="<?php echo (isset($_POST['duration'])?$_POST['duration']:"");if(isset($duration)) echo $duration; ?>"  placeholder="40 hours"> -->
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">

										<h4 class="text-primary mb-4">ABOUT THE EVENT</h4>
										
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">TITLE</label>
														<!-- <p class="text-danger">*Enter the title of the Event</p> -->
													</div>
													<div class="col-md-6 p-2 ">
                                                        <span><?php if(isset($title)) echo $title; ?></span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">NATURE OF EVENT</label>
														<!-- <p class="text-danger">*Enter the Nature of the Event like Workshop on, TechTalk etc..</p> -->
													</div>
													<div class="col-md-6 p-2 ">
                                                        <span><?php if(isset($natureoevent)) echo $natureoevent; ?></span>
														<!-- <input type="text" class="form-control" name="natofeve" value="<?php echo (isset($_POST['natofeve'])?$_POST['natofeve']:""); if(isset($natureoevent)) echo $natureoevent; ?>" placeholder="Enter the Nature of Event" required> -->
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
														<span><?php if(isset($typeofevent)) echo $typeofevent; ?></span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">VENUE</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($venue)) echo $venue; ?></span>
														<!-- <input type="text" class="form-control" name="venue" value="<?php echo (isset($_POST['venue'])?$_POST['venue']:""); if(isset($venue)) echo $venue; ?>" placeholder="Ex: KJC, Bangalore" required> -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PURPOSE</label>
                                            
													</div>
													<div class="col-md-6 p-2 ">
                                                        <span><?php if(isset($purpose)) echo $purpose; ?></span>
														<!-- <input type="text" class="form-control" value="<?php echo (isset($_POST['purpose'])?$_POST['purpose']:""); if(isset($purpose)) echo $purpose; ?>" name="purpose" required> -->
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">
									
										<h4 class="text-primary mb-4">PARTICIPANTS DETAILS</h4>
										
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">NO.OF.PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($noofpart)) echo $noofpart; ?></span>
														<!-- <input type="number" class="form-control" name="noofpart" value="<?php echo (isset($_POST['noofpart'])?$_POST['noofpart']:""); if(isset($noofpart)) echo $noofpart; ?>" required> -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">INTERNAL PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($intpart)) echo $intpart; ?></span>
														<!-- <input type="number" class="form-control" name="intpar" value="<?php echo (isset($_POST['intpar'])?$_POST['intpar']:""); if(isset($intpart)) echo $intpart; ?>" required> -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">EXTERNAL PARTICIPANTS</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($extpart)) echo $extpart; ?></span>
														<!-- <input type="number" class="form-control" name="extpart" value="<?php echo (isset($_POST['extpart'])?$_POST['extpart']:""); if(isset($extpart)) echo $extpart; ?>" required> -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PARTICIPANTS DETAILS</label>
														
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($partdet)) echo $partdet; ?></span>
														<!-- <textarea class="form-control" name="partdet" placeholder="Ex : Ajith - V MCA  / III SEM-MCA-46" required> <?php if(isset($partdet)) echo $partdet; ?></textarea> -->
													</div>
												</div>
											</div>
											
										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">
										<h4 class="text-primary mb-4">RESOURCE PERSON DETAILS</h4>
										
										<div class="row">
										
											
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PERSON NAME</label>
														
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($resourcename)) echo $resourcename; ?></span>
														
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">EMAIL ID</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($emailid)) echo $emailid; ?></span>
														
													</div>
												</div>
											</div>
											<div class="col-md-6">
											<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">PHONE NUMBER</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                    <span><?php if(isset($phoneno)) echo $phoneno; ?></span>
														<!-- <input type="number" class="form-control" name="phoneno" id="phoneno" value="<?php echo (isset($_POST['phoneno'])?$_POST['phoneno']:""); if(isset($phoneno)) echo $phoneno; ?>" required> -->
													</div>
												</div>
											</div>
											<div class="col-md-6">
												
												<div class="row">
													<div class="col-md-6 p-2 ">
														<label class="form-label">RESOURCE PERSON DETAILS</label>
													</div>
													<div class="col-md-6 p-2 ">
                                                        <span><?php if(isset($persondetails)) echo $persondetails; ?></span>
													</div>
												</div>
											</div>
											
											
										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">
										<h4 class="text-primary mb-4">ABOUNT THE EVENT</h4>
										<div class="row">
											<div class="col-lg-4">
												
												
														<label class="form-label">Objective</label>
													
											</div>
											<div class="col-lg-8">
                                            <span><?php if(isset($objective)) echo $objective; ?></span>
														<!-- <input type="text" class="form-control w-100" name="objective" value="<?php echo (isset($_POST['objective'])?$_POST['objective']:""); if(isset($objective)) echo $objective; ?>" required> -->
													
											</div>
											<div class="col-md-4 my-3">
												
														<label class="form-label">BREF WRITE ABOUT THE SESSION</label>
													
											</div>
											<div class="col-md-8 my-3">
                                            <span><?php if(isset($breif)) echo $breif; ?></span>
													<!-- <textarea rows="20" cols="30" class="form-control w-100" name="breif"  required><?php echo (isset($_POST['breif'])?$_POST['breif']:""); if(isset($breif)) echo $breif; ?></textarea> -->
													
											</div>
											<div class="col-md-4 ">
												
														<label class="form-label">LEARNING OUTCOME</label>
													
											</div>
											<div class="col-md-8">
                                            <span><?php if(isset($learningoutcome)) echo $learningoutcome; ?></span>
													<!-- <textarea rows="8" cols="30" class="form-control w-100" name="learningoutcome"  required><?php echo (isset($_POST['learningoutcome'])?$_POST['learningoutcome']:""); if(isset($learningoutcome)) echo $learningoutcome; ?></textarea> -->
													
											</div>
											
											
										</div>
									</div>
									
									<div class="container card-2 py-3 my-2 px-5">
									<h4 class="text-primary mb-4">EVENT IMAGES</h4>
                                    
										<div class="row">
											<div class="col-md-6 pl-5">
												<div class="row">
													<div class="col-md-6 p-2 text-center ">
                                                    <?php  
                                                            $img= "select * from image where progammedid = '$programmeid'";
                                                            $imgresult = mysqli_query($conn, $img);

                                                            if (mysqli_num_rows($imgresult) > 0) 
                                                            {
                                                                while($images = mysqli_fetch_assoc($imgresult)) 
                                                                {
                                                                    $imgloc=$images['img_location'];
																	$imgname=$images['imagename'];
																	$type=$images['type'];
																	if($type=='image'){
																		echo "<img src='../../uploads/$imgloc' height='100' width='100'>";
																		echo "<p class='text-center'>$imgname</p>";
																  
																	}
                                                               }
                                                            } 
                                                            ?>
													</div>
												
												</div>
											</div>
										</div>
									</div>
									<div class="container card-2 py-3 my-2 px-5">
										<h4 class="text-primary mb-4">ATTENDANCE PDF</h4>
										<div class="row">
											<div class="col-md-6 pl-5">
												<div class="row">
													<div class="col-md-6 p-2 ">
														<!-- <a href="uploads/"> --><?php  
                                                            $img= "select * from image where progammedid = '$programmeid'";
                                                            $imgresult = mysqli_query($conn, $img);

                                                            if (mysqli_num_rows($imgresult) > 0) 
                                                            {
                                                                while($images = mysqli_fetch_assoc($imgresult)) 
                                                                {
                                                                    $imgloc=$images['img_location'];
																	$imgname=$images['imagename'];
																	$type=$images['type'];
																	if($type=='pdf'){
																		echo "<a href='../../uploads/$imgloc' target='_blank' > Click here to view the attendence</a>";
																		// echo "<p class='text-center'>$imgname</p>";
																  
																	}
                                                               }
                                                            } 
                                                            ?>
													</div>
												</div>
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
										
									</div>
								</div>	

							</div>
						</div>
					</div>
					
				</form>

<?php include '../includes/footer.php' ?>