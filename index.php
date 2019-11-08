<?php 
include 'includes/header.php';
include 'includes/nav-bar.php';
 ?>
    
<section class="container">
    <div class="card" style="width:50%;margin: 10vh  auto;">
        <div class="label" style="position:relative;bottom:10px;">
            <p class="bg-primary text-white text-center w-75 mx-auto p-2 shadow-sm" style="border-radius:30px;">Login</p>
        </div>
        <div class="card-body">
                <div class="row mt-2">
                    <?php if(isset($_GET['sessionNo'])){?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p class="m-0">Session Expired <br> Please Enter userid and password.</p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($_GET['error'])&&$_GET['error']=='inValid'){?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p class="m-0">INVALID USER* <br> Please check userid and password.</p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($_GET['error'])&&$_GET['error']=='disAbled'){?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p class="m-0">  You have been disabled by Admin*</p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-6 text-primary"> 
                    <form action="session.php" method="post"> 
                        <label for="usr">UserId:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr">Password:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr">Role</label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="role" required>
                            <option>Staff</option>
                            <option>Student</option>
                            <option>Admin</option>
                            
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 ">  
                        <input type="submit" name="submit" class="btn-sm btn-primary text-white w-50 mx-auto d-block" value="Login" />
                    </div>
                </div>
                </form>
        </div>
    </div>
</section>