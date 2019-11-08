<?php
session_start() ;
session_destroy(); // Is Used To Destroy All Sessions
header('Location:../index.php');
?>