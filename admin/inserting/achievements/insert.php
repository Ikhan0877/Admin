<?php
include '../../includes/session.php';
include_once '../confiq.php';
if(isset($_POST['add']))  
{  
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
	$query="INSERT INTO `achievements`(`ach_name`, `ach_days`, `ach_from`, `ach_to`, `participantname`, `ach_type`, `ach_info`, `ach_venue`, `natureofpart`, `monthid`, `yearid`,`userid`,`verified`,`deptid`) VALUES ('$achprogramtitle','$achtndays','$achfrom','$achto','$achpname','$achby','$achpapertitle','$achvenue','$achparticipant','$monthid','$yearid','$userid','0','$deptid')";
	if (!mysqli_query($conn,$query))
	{
		echo("Error description: " . mysqli_error($conn));
	}
}