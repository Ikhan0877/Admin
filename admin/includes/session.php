<?php 
    session_start();
    if(empty($_SESSION['userid'])||empty($_SESSION['role'])||empty($_SESSION['deptid'])||empty($_SESSION['status'])){
        header('Location:../index.php?sessionNo');
    }
    else if($_SESSION['role'] != 'Admin')
    {
        header('Location:../index.php?sessionNo');
    }
    else if($_SESSION['status'] != 'Enable'){
            header('Location:../index.php?sessionNo');
    }
    else if(!empty($_SESSION['userid']))
    {
        $userid = $_SESSION['userid'];
    }?>