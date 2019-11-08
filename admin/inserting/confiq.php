<?php
    $server="localhost";
    $username="root";
    $password="";
    $dbname="reports";
    $conn = mysqli_connect($server,$username,$password,$dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // previous
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) 
    {
        $previous = $_SERVER['HTTP_REFERER'];
	}
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

