<?php 
include 'includes/session.php';
include 'includes/sessionadmin.php';
if($_SESSION['role'] == 'Admin'){
include 'includes/header.php';
include 'includes/nav-bar.php';
}
else
{
include 'includes/header.php';
include 'includes/nav-bar-staff-student.php';
} 
include_once 'inserting/confiq.php';
include 'inserting/classes.php';

    $sql1= "select * from department ";
    $result = mysqli_query($conn, $sql1);

    $year = new Year();
    $staff = $year->staffCount();
    $student = $year->studentCount();
    $department = $year->departmentCount();
 ?>
 <div class="container mt-4">
    <h1 class="d-inline">Welcome,</h1><p class="d-inline">Admin</p>
 </div>
 <div class="container mt-4">
     <p class="text-info bg-light p-2" style="border-radius:30px;">OVERALL USERS DETAILS</p>
 </div>
 <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card " style="border-radius:50px;background: #473DD9;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            ">
                <div class="card-body text-center p-0" style="border-radius:50px;">
                    <h5 class="text-white mt-3">STAFF</h5>
                    <h2 class="text-info"><?= $staff ?></h2>
                </div>
                <a class="card-footer bg-white text-primary shadow-sm text-center" href="admin-add-user.php" style="border-radius:30px;position:relative;top:20px;">
                    ADD / VIEW 
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card " style="border-radius:50px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                <div class="card-body text-center p-0" style="border-radius:50px;">
                    <h5 class="text-white mt-3">STUDENTS</h5>
                    <h2 class="text-info"><?= $student ?></h2>
                </div>
                <a class="card-footer bg-white text-primary shadow-sm text-center" href="admin-add-user.php" style="border-radius:30px;position:relative;top:20px;">
                    ADD / VIEW 
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card " style="border-radius:50px;background: #473DD9;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            ">
                <div class="card-body text-center p-0" style="border-radius:50px;">
                    <h5 class="text-white mt-3">DEPARTMENTS</h5>
                    <h2 class="text-info"><?= $department ?></h2>
                </div>
                <a class="card-footer bg-white text-primary shadow-sm text-center" href="admin-add-dept.php" style="border-radius:30px;position:relative;top:20px;">
                    ADD / VIEW 
                </a>
            </div>
        </div>
    </div>
 </div>


 <div class="container mt-5">
     <p class="text-info bg-light p-2" style="border-radius:30px;">ALL DEPARTMENTS</p>
 </div>
 <div class="container mt-4">
    <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Note!</strong> YOU CAN CLICK ON THE DEPARTMENT TO VIEW THEIR REPORT'S INDIVIDUALLY
    </div>
 </div>
 <div class="container my-5">
    <div class="row">
    <?php 
        if (mysqli_num_rows($result) > 0) 
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="col-md-4 mt-5">
            <div class="card " style="border-radius:50px;background: #D43DD9;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to top, #004e92, ##D43DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            ">
            <!-- Coding for displaying the department details -->
           
                <div class="card-body text-center p-0" style="border-radius:50px;">
                    <h5 class="text-white mt-3 p-2"><?= $row['deptname']?> [<?= $row['graduation'] ?>] <?= $row['Class'] ?></h5>
                    <h2 class="text-info"><?= $eventcount = $year->countEventsDept($row['deptId']); ?></h2>
                </div>
                <div class="card-footer bg-white text-primary shadow-lg text-center" style="border-radius:30px;position:relative;top:20px;">
                    <a href="admin-year.php?deptid=<?= $row['deptId'] ?>"> ADD / VIEW </a>  
                </div>
            </div>
        </div>
            <?php }
            }
            else
            {
                echo '<div class="alert alert-warning">NO RECORDS YET</div>';
            }
            ?>

     </div>  
 </div>