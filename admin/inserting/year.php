<?php 
    include_once 'confiq.php';
    if(isset($_POST['add']))
    {
        $year = $_POST['year'];
        $status = $_POST['status'];
        mysqli_query($conn,"insert into `year` (year , status) values ('$year','$status')");
        $result = mysqli_query($conn,"select yearid from year where year = '$year' ");
        while($row = mysqli_fetch_assoc($result)) {
            $yearid = $row['yearid'];
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Jan','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Feb','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Mar','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Apr','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','May','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Jun','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Jul','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Aug','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Sep','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Oct','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Nov','$status')");
            mysqli_query($conn,"insert into `month` (yearid,monthname,status) values ('$yearid','Dec','$status')");
        }
       
    }

    // include 'inserting/confiq.php';
    if(isset($_POST['del'])){
        $id = $_POST['id'];
        mysqli_query($conn,"delete from `month` where yearid = $id");
        mysqli_query($conn,"delete from `year` where yearid = $id");
    }
    
    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $status =$_POST['status'];
        mysqli_query($conn,"update `year` set `status`='$status' where yearid=$id ");
    }





    if(isset($_POST['showyear'])){
        $sql = "SELECT yearid,year, status FROM year ";
    $result = mysqli_query($conn, $sql);
        ?> 
        <tr class="table-info">
            <td>Si.No.</td>
            
            <td>Year</td>
           
            <td>Operations</td>
            
            </tr>
        
        <?php if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
            <tr > 
                <td><?= $row['year'] ?></td>
                <td> <select name="" id="updatestat<?= $row['yearid']?>" class="form-control">
                  
                    <?php if($row['status'] == 'Enable'){?>
                        <option value="Enable">Enable</option>
                        <option value="Disable">Disable</option>
                        
                    <?php }else{?>
                        <option value="Disable">Disable</option>
                        <option value="Enable">Enable</option>
                    <?php }?>

                </select> </td>
                <td><button class="btn btn-primary edit" value="<?= $row['yearid']?>">Edit</button> <button class="btn btn-danger delete" value="<?= $row['yearid']?>">DELETE</button> </td>
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