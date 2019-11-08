<?php 
    session_start();
    include 'includes/classes.php';
    if(isset($_POST['submit']))
    {
        if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['role']))
        {
            $username = $_POST['username'];
            $password =$_POST['password'];
            $role = $_POST['role'];
            $user = new User();
            $valid = $user->Userdet($username,$password,$role);
            if($valid==1){

                if($user->role == 'Staff' && $user->status =='Enable')
                {
                     $_SESSION['userid'] = $user->userid;
                     $deptid = $user->deptid;
                     $_SESSION['deptid'] = $user->deptid;
                     $_SESSION['status'] =$user->status;
                     $_SESSION['role'] = $user->role;
                    header('Location:staff/admin-year.php?deptid='.$deptid);
                    // echo $_SESSION['status'] = $user->status;
                }
                else if($user->role == 'Student' && $user->status == 'Enable')
                {
                     $_SESSION['userid'] = $user->userid;
                     $deptid = $user->deptid;
                     $_SESSION['status'] =$user->status;
                     $_SESSION['deptid'] = $user->deptid;
                     $_SESSION['role'] = $user->role;
   			        header('Location:student/admin-year.php?deptid='.$deptid);
                    // echo $_SESSION['status'] = $user->status;
                }
                else if($user->role == 'Admin' && $user->status =='Enable'){
                     $_SESSION['userid'] = $user->userid;
                     $deptid = $user->deptid;
                    // echo $_SESSION['status'] =$user->status;
                     $_SESSION['deptid'] = $user->deptid;
                     $_SESSION['role'] = $user->role;
                     $_SESSION['status'] = $user->status;
                    header('Location:admin/admin-home.php');
                }else{
                    header('Location:index.php?error=disAbled');
                }

            }
            else{
                // echo 'not valid';
                header('Location:index.php?error=inValid');
            }
        }
    }
?>