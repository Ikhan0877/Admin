<?php 
    include_once 'confiq.php';
    if(isset($_POST['add']))
    {
        $dept = $_POST['dept'];
        $grad = $_POST['grad'];
        $class = $_POST['class'];
        mysqli_query($conn,"insert into `department` (deptname , graduation, Class) values ('$dept','$grad','$class')");
        // $result = mysqli_query($conn,"select deptid from dept where dept = '$dept' ");
    }

    // include 'inserting/confiq.php';
    if(isset($_POST['del'])){
        $id = $_POST['id'];
        mysqli_query($conn,"delete from `department` where deptid = $id");
        // mysqli_query($conn,"delete from `dept` where deptid = $id");
    }

    if(isset($_POST['showdept'])){
        $sql = "SELECT deptid,deptname, graduation, Class FROM department ";
    $result = mysqli_query($conn, $sql);
        ?> 
        <tr class="table-info">
          
            
            <td>department</td>
           
            <td>Grade</td>
            <td>Class</td>
            
            </tr>
        
        <?php if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
            <tr > 
                <td><?= $row['deptname'] ?></td>
                <td> <?= $row['graduation'] ?></td>
                <td> <?= $row['Class'] ?></td>
                <td> <button class="btn btn-danger delete" value="<?= $row['deptid']?>">DELETE</button> </td>
                <!-- <input type="hidden" name="" id="deptid" value=""> -->
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