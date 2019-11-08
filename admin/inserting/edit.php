<?php
include_once 'confiq.php';
if(isset($_POST['edit']))  
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

	$query=mysqli_query($conn,"UPDATE `achievements` SET `ach_name`=`$achprogramtitle`,`ach_days`=`$achtndays`,`ach_from`=`$achfrom`,`ach_to`=`$achto`,`participantname`=`$achpname`,`ach_type`=`$achby`,`ach_info`=`$achpapertitle`,`ach_venue`=`$achvenue`,`natureofpart`=`$achparticipant`,`monthid`=`$monthid`,`yearid`=`$yearid` WHERE `achievementid` = `$id`");


	
}
?>