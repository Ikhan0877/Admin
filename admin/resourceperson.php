<?php 
include 'includes/session.php';
include 'includes/sessionadmin.php';
include_once 'inserting/confiq.php';
include 'inserting/classes.php';

    $sql1= "select a.resourcepersonid,a.name,a.details,a.contact,a.emailid from reasource a left outer join programmes b on a.resourcepersonid=b.resourcepersonid where b.resourcepersonid is null";
    $result = mysqli_query($conn, $sql1);

    $year = new Year();
    $staff = $year->staffCount();
    $student = $year->studentCount();
    $department = $year->departmentCount();
    if(isset($_GET['delete'])){
        $deleteid=$_GET['delete'];
        mysqli_query($conn,"delete from reasource where resourcepersonid=$deleteid");
        header("Location:resourceperson.php");
    }
 ?>
 <?php

if($_SESSION['role'] == 'Admin'){
include 'includes/header.php';
include 'includes/nav-bar.php';
}
else
{
include 'includes/header.php';
include 'includes/nav-bar-staff-student.php';
} 
 ?>
 <div class="container mt-4">
    <!-- <h1 class="d-inline">Welcome,</h1><p class="d-inline">Admin</p> -->
 </div>
 <div class="container mt-4">
     <p class="text-light bg-danger px-5 py-2" style="border-radius:30px;"> RESOURCE PERSON DETAILS WHICH ARE NOT IN ANY CONDUCTED PROGRAMMES</p>

 </div>
 <div class="container">
    <table class="table table-bordered table-hover">
    <tr>
        <th>Name</th>
        <th>Details</th>
        <th>Contact</th>
        <th>Email id</th>
        <th>Operations</th>
    </tr>
    <?php 
        if (mysqli_num_rows($result) > 0) 
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['details'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td><?= $row['emailid'] ?></td>
                <td><a href="resourceperson.php?delete=<?= $row['resourcepersonid']?>" class="btn btn-danger">DELETE</a></td>
        </tr>
            <?php }
            }else{
                echo "<tr> <td colspan='4'>NO RECORDS<td> </tr>";
            }
             ?>
    </table>
 </div>
