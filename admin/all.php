<?php
require_once 'vendor/autoload.php';
include 'inserting/confiq.php';

 $phpWord = new \PhpOffice\PhpWord\PhpWord();
// use PhpOffice\PhpWord\SimpleType\VerticalJc;
if(isset($_GET['deptid'])){
    // department id
    $deptid = $_GET['deptid'];
    // from year
    $fromyear=$_GET['fromyear'];
    // to year
    $toyear=$_GET['toyear'];
    // from month
    $frommonth=$_GET['frommonth'];
    // to month
    $tomonth=$_GET['tomonth'];
    // event
    $event=$_GET['event'];

    if($event=="all")
    {
        header("Location:gen/all.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid);
    }
    else if($event=="Interactive")
    {
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    else if($event=="constructive"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    else if($event=="experiential"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    else if($event=="addoncourse"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    elseif($event=="fest"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    else if($event=="publication"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);

    }
    elseif($event=="student"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }
    elseif($event=="faculty"){
        header("Location:gen/programme.php?fromyear=".$fromyear."&toyear=".$toyear."&frommonth=".$frommonth."&tomonth=".$tomonth."&deptid=".$deptid."&programme=".$event);
    }

}