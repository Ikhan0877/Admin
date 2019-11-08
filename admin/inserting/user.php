<?php 
    include_once 'confiq.php';
    if(isset($_POST['add']))
    {
        $username = $_POST['username'];
        // $userid=$_POST['userid'];
        $dept=$_POST['dept'];
        $role=$_POST['role'];
        $pass=$_POST['pass'];
        $status = $_POST['status'];
        mysqli_query($conn,"insert into `login` (userid,username,password,role,deptid , status) values ('$username','$username','$pass','$role','$dept','$status')");
        // $result = mysqli_query($conn,"select yearid from year where year = '$year' ");
        
       
    }

    // include 'inserting/confiq.php';
    if(isset($_POST['del'])){
        $id = $_POST['id'];
        mysqli_query($conn,"delete from `login` where userid = $id");
        // mysqli_query($conn,"delete from `year` where yearid = $id");
    }
    
    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $status =$_POST['status'];
        mysqli_query($conn,"update `login` set `status`='$status' where userid='$id' ");
    }

    
    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $status =$_POST['status'];
        mysqli_query($conn,"update `login` set `status`='$status' where userid=$id ");
    }




    if(isset($_POST['showuser']))
    {

        $sql = "SELECT * FROM login";
        $result = mysqli_query($conn, $sql);
        if(isset($_POST['user'])){
            $role = $_POST['user'];
            $sql = "SELECT * FROM login where userid='$role'";
            $result = mysqli_query($conn, $sql);
        }
        if(isset($_POST['role'])){
            $role = $_POST['role'];
            
            if($role=='all'){
                $sql = "SELECT * FROM login";
                $result = mysqli_query($conn, $sql);
            }else{
                $sql = "SELECT * FROM login where role='$role'";
            $result = mysqli_query($conn, $sql);
            }
        }
        if(isset($_POST['deptid'])){
            $deptid = $_POST['deptid'];
            $sql = "SELECT * FROM login where deptid='$deptid'";
            $result = mysqli_query($conn, $sql);
        }
        ?> 
        <tr class="table-info">
            <td>Name</td>
            <!-- <td>UserId</td> -->
            <td>Password</td>
            <td>Department</td>
            <td>Role</td>
            <td>Status</td>
            <td>Operations</td>
            </tr>
            
        
        <?php if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
            <tr > 
                <td><?= $row['username'] ?></td>
                <td><?= $row['password']?>
                    <button class="btn btn-sm btn-outline-warning pass" value="<?= $row['userid']?>" id="updatepass<?= $row['userid']?>">Reset</button>
                </td>
                <td>
                
                <?php   $deptid=$row['deptid'];
                        $sql = "SELECT deptname,graduation FROM department where deptid= '$deptid' ";
                                $resultdept = mysqli_query($conn, $sql);    
                                if (mysqli_num_rows($resultdept) > 0) {
                                while($rowdept = mysqli_fetch_assoc($resultdept)) { ?>
                               <?= $rowdept['deptname']?>
                               <b>[<?= $rowdept['graduation']?>]</b>
                                <?php }}?>
                </td>
                <td><?= $row['role']?></td>
                <td> <select name="" id="updatestat<?= $row['userid']?>" class="form-control">
                  
                    <?php if($row['status'] == 'Enable'){?>
                        <option value="Enable">Enable</option>
                        <option value="Disable">Disable</option>
                        
                    <?php }else{?>
                        <option value="Disable">Disable</option>
                        <option value="Enable">Enable</option>
                    <?php }?>

                </select> </td>
                <td><button class="btn btn-primary edit" value="<?= $row['userid']?>" id="updatestat<?= $row['userid']?>">Edit</button> <button class="btn btn-danger delete" value="<?= $row['userid']?>">DELETE</button> </td>
                <!-- <input type="hidden" name="" id="yearid" value=""> -->
            </tr>
        <?php 
            }
        }
        else{
            ?>
            <tr>
                <td>No data</td>
                <td></td>
                <td></td>
            
            </tr>
            <?php
        }
        ?>
        
        <?php
    }?>